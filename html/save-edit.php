<?php
include_once('conexao.php');

if (isset($_POST['update'])) {
    // Sanitiza os dados utilizando prepared statements
    $nome = $_POST['nome'];
    $email_novo = $_POST['email']; // Use um nome diferente para o novo email
    $senha = $_POST['senha']; // Hash da senha
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $tipo = $_POST['tipo'];
    $email_atual = $_POST['email']; // Email original para comparação

    // Prepara a consulta SQL para atualização
    $sql = "UPDATE cadastro SET nome=?, email=?, senha=?, telefone=?, endereco=?, tipo=? WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nome, $email_novo, $senha, $telefone, $endereco, $tipo, $email_atual);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
        header('Location: cliente.php');
        exit;
    } else {
        echo "Erro ao atualizar dados: " . $stmt->error;
    }

    $stmt->close();
}
?>