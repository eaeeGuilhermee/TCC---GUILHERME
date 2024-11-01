<?php
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Função para upload de imagem (com tratamento de erros)
    function uploadImagem($imagem) {
        $target_dir = "imagem/";
        $target_file = $target_dir . basename($imagem["name"]);

        if (move_uploaded_file($imagem["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "Erro ao fazer upload da imagem.";
            return null;
        }
    }

    // Recebendo os dados do formulário
    $tipo = $_POST["tipo"];
    $tamanho = $_POST["tamanho"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $quantidade = $_POST["quantidade"];
    $imagem = $_FILES["imagem"];
    
    
    

    // Upload da imagem
    $imagem_path = null;
    if (isset($imagem) && $imagem["error"] === 0) {
        $imagem_path = uploadImagem($imagem);
        if (!$imagem_path) {
            $erros[] = "Erro ao enviar a imagem.";
        }
    }

    // Verifica se o upload da imagem foi bem-sucedido
    if ($imagem_path) {
        // Preparando a query SQL com parâmetros para evitar injeção de SQL
        $stmt = $conn->prepare("INSERT INTO produto (tipo, tamanho, descricao, preco, quantidade, imagem ) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $tipo, $tamanho, $descricao, $preco, $quantidade, $imagem_path );

        // Executando a query
        if ($stmt->execute()) {
            echo "Novos registros inseridos com sucesso";
        } else {
            echo "Erro ao inserir registros: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
  <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/produto.css">
        <title>Cadastrar Produto</title>
    </head>
        <body>

        <div class="nav-bar">
        
                <div class="voltar">
                    <a href="admin.php">
                    <img src="image/icon/back.png" alt="icon">
                    </a>
                </div>
                    <div class="truth">
                    <a href="index.php"><h1>TRUTH</h1></a>
                    </div>
        </div>

                


          <div class="top">
          <form action="produto.php" method="post" enctype="multipart/form-data">
              <label for="tipo">Tipo:</label>
              <select id="tipo" name="tipo">
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Infantil">Infantil</option>
                <option value="Unissex">Unissex</option>
              </select><br><br>

              <label for="tamanho">Tamanho:</label>
              <select id="tamanho" name="tamanho">
                <option value="PP">PP</option>
                <option value="P">P</option>
                <option value="M">M</option>
                <option value="G">G</option>
                <option value="GG">GG</option>
                <option value="XG">XG</option>
              </select><br><br>

                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" placeholder="Descrição da roupa"><br><br>

                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco" placeholder="Preço da roupa"><br><br>

                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" placeholder="Quantidade da roupa"><br><br>

                <label for="imagem">Imagem do Produto:</label>
                <input type="file" id="imagem" name="imagem" accept="imagem/*">

              <input type="submit" value="Cadastrar">
            </form>
            </div>
        </body>
</html>