<?php
include_once('conexao.php');

if (!empty($_GET['email'])) {
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Prepare the SELECT query
    $sqlSelect = "SELECT * FROM cadastro WHERE email=?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("s", $email);

    // Execute the SELECT query
    if ($stmtSelect->execute()) {
        $result = $stmtSelect->get_result();

        if ($result->num_rows > 0) {
            // Prepare the DELETE query
            $sqlDelete = "DELETE FROM cadastro WHERE email=?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("s", $email);

            // Execute the DELETE query
            if ($stmtDelete->execute()) {
                echo "Cliente deletado com sucesso!";
            } else {
                echo "Erro ao deletar cliente: " . $stmtDelete->error;
            }
        } else {
            echo "Cliente não encontrado.";
        }
    } else {
        echo "Erro ao executar a consulta SELECT: " . $stmtSelect->error;
    }

    // Close statements
    $stmtSelect->close();
    $stmtDelete->close();
}

header('Location: cliente.php');
?>