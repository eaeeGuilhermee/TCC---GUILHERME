<?php
include_once('conexao.php');

// Sanitize the email using prepared statements
$email = mysqli_real_escape_string($conn, $_GET['email']);

// Prepare the SQL statement with placeholders
$sql = "SELECT * FROM cadastro WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

// Execute the statement and handle errors
if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}

// Get the result set
$result = $stmt->get_result();

// Check if a user was found
if ($result->num_rows > 0) {
    // Fetch the user data
    $user_data = $result->fetch_assoc();

    // Assign values to form fields
    $nome = $user_data['nome'];
    $email = $user_data['email'];
    $senha = $user_data['senha'];
    $telefone = $user_data['telefone'];
    $endereco = $user_data['endereco']; 
    $tipo = $user_data['tipo'];
} else {
    echo "Usuário não encontrado.";
    exit;
}

// Close the statement
$stmt->close();
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
    <form action="save-edit.php" method="POST" onsubmit="return validateForm();">
        
            <fieldset>
                <legend><b>Editar Cliente</b></legend>
                <br>
          <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>

        <label for="tipo">tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="" disabled selected>Selecione o tipo</option>
            <option value="0">0</option>
            <option value="1">1</option>
           
        </select>

        <br><br>
				<input type="hidden" name="email" value=<?php echo $email;?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>

</html>