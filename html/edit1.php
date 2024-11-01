<?php
include_once('conexao.php');

// Verifica se o parâmetro 'email' foi enviado via GET
if (isset($_GET['email'])) {
    // Sanitiza o email para evitar injeção de SQL
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Prepara a consulta SQL utilizando prepared statements
    $sql = "SELECT * FROM produto WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    // Executa a consulta
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Obtém os dados do usuário
            $user_data = $result->fetch_assoc();

            // Atribui os valores aos campos do formulário
            $nome = $user_data['nome'];
            $email = $user_data['email'];
            // ... outros campos ...
        } else {
            echo "Usuário não encontrado.";
            exit;
        }
    } else {
        echo "Erro ao executar a consulta: " . $stmt->error;
        exit;
    }

    // Fecha o statement
    $stmt->close();
} else {
    header('Location: edit1.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Cadastro de Cliente</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background-size: 600px;
             background-repeat: no-repeat;
             background-position-x: center;
        }
        h1{
            text-align: center;
        }
        header{
            background-color: palevioletred;
             padding: 10px 0;
            text-align: center;
            }
        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #45e05f;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #435dd1;
        }
        header{
            background-color: white;
            padding: 10px 0;
            text-align: center;
        }

        nav ul{
            list-style: none;

        }

        nav ul li{
            display: inline;
            margin-right: 20px;
        }
        nav ul li a{
            text-decoration: none;
            color: #151414;
            font-weight: bold;
        }

        .voltar a{
            text-decoration: none;
            color: black;
            margin-left: 10pc;
        }

    </style>
</head>
<body>
    <header>
        <h1>TRUTH</h1>
        <nav>
        </nav>
       
    </header>
    <h1>Cadastro de Cliente</h1>
    <body>

        
        <div class="voltar">
    <a href="cliente.php">Voltar</a>
        </div>

    <div class="box">
    <form>
  <label for="productName">Product Name:</label>
  <input type="text" id="productName" name="productName" value=""><br><br>

  <label for="productDescription">Product Description:</label>
  <textarea id="productDescription" name="productDescription"></textarea><br><br>

  <label for="price">Price:</label>
  <input type="number" id="price" name="price" value=""><br><br>

  <label for="stock">Stock:</label>
  <input type="number" id="stock" name="stock" value=""><br><br>

  <label for="category">Category:</label>
  <select id="category" name="category">
    <option value="">Select a category</option>
    <option value="electronics">Electronics</option>
    <option value="clothing">Clothing</option>
    <option value="home goods">Home Goods</option>
  </select><br><br>

  <input type="submit" value="Save Changes">
</form>
    </div>

</html>