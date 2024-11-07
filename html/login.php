<?php
include_once('conexao.php');

// Verifica se houve um envio de formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação básica (adicione mais validações conforme necessário)
    if (empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Prepare a consulta SQL para evitar injeção
        $stmt = $conn->prepare("SELECT * FROM cadastro WHERE email=? AND senha=?");
        $stmt->bind_param("ss", $email, $senha); // Assumindo que email e senha são strings

        // Executa a consulta
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Verifica o tipo de usuário
                if ($row['tipo'] == 1) {
                    // Login válido para administrador, redireciona para admin.php
                    header("Location: admin.php");
                } else {
                    // Login válido para outro tipo de usuário, redireciona para home
                    header("Location: index.php");
                }
            } else {
                echo "Email ou senha inválidos.";
            }
        } else {
            // Trata erros na execução da consulta
            echo "Erro ao realizar a consulta: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style-login.css">
    

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
            <h1>Não possui uma conta? Clique <a href="contact.php">aqui!</a></h1>
        </div>


        <div class="login">

            <form action="login.php" method="post">   

            <label for="email"></label><br>
            <input type="email" id="email" placeholder="e-mail" name="email" required><br>

            <label for="senha"></label><br>
            <input type="password" id="senha" placeholder="senha" name="senha" required><br>
                

        <div class="submit">
            <input type="submit" value="Entrar">
        </div>
            </form>
        </div>

        <footer>
  <div class="footer-content">

    <div class="newsletter">
      <h3>TRUTH</h3>
    </div>

            <div class="footer-links">
            <ul>
                <li><a href="#">Cookies</a></li>
                <li><a href="#">Política de Privacidade</a></li>
                <li><a href="#">Termos e Condições de Uso</a></li>
            </ul>
            <ul>
                <li><a href="#">Regulamento das Promoções</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">welcometotruth.com.br</a></li>
            </ul>
            </div>

            <div class="social-media">
            <a href="#"><li>Instagram</li></a>
            <a href="#"><li>WhatsApp</li></a>
            <a href="#"><li>Facebook</li></a>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 The TRUTH will set you free Company. Todos os direitos reservados.</p>
        </div>

</body>
</html>
