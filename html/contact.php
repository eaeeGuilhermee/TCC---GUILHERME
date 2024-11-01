<?php

include_once("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
$nome=($_POST['nome']);
$email=($_POST['email']);
$senha=($_POST['senha']);
$telefone=($_POST['telefone']);
$endereco=($_POST['endereco']);


$sql = "INSERT INTO cadastro (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $nome, $email, $senha, $telefone, $endereco);
if ($stmt->execute()) {
    echo "Cliente cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar cliente: " . $stmt->error;
}

$stmt->close();
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style-contact.css">
    

    <title>TRUTH</title>
</head>

<body>
        <div class="nav-bar">
                    <a href="index.php"><h1>TRUTH</h1></a>
                <div class="nav-item">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="contact.php">Contato</a></li>
                </div>

                <!-- <div class="carrinho">
                    <img src="image/icon/compra.png" alt="icon">
                </div> -->
        </div>

        <div class="bar2">
            <h1>Cadastre-se para receber novidades!</h1>
        </div>


        <div class="cadastro">

            <form action="contact.php" method="post">

            <label for="nome"></label><br>
            <input type="text" id="nome" placeholder="nome" name="nome" required><br>   

            <label for="email"></label><br>
            <input type="email" id="email" placeholder="e-mail" name="email" required><br>

            <label for="senha"></label><br>
            <input type="password" id="senha" placeholder="senha" name="senha" required><br>
                
            <label for="telefone"></label><br>
            <input type="tel" id="telefone" placeholder="telefone" name="telefone" required><br>

            <label for="endereco"></label><br>
            <input type="search" id="cidade" placeholder="Cidade" name="endereco"><br>

        <div class="submit">
            <input type="submit" name="submit" value="Cadastrar">
        </div>
            </form>
        </div>

        <div class="footer">
            <footer>
                <li>&copy;Guilherme</li>
            </footer>
        </div>
    </div>

        <div class="footer2">
            <footer>
                <ul>
                    
                    <a href="https://www.instagram.com/guilhermeoliveira.ink/"><li>Instagram</li></a>
                    
                    <li>WhatsApp</li>
                    
                </ul>
            </footer>
        </div>

</body>
</html>
