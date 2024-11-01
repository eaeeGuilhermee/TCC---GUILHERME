<?php
include_once('conexao.php');

if (!empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Prepare the SELECT query
    $sqlSelect = "SELECT * FROM produto WHERE id=?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("s", $id);

    // Execute the SELECT query
    if ($stmtSelect->execute()) {
        $result = $stmtSelect->get_result();

        if ($result->num_rows > 0) {
            // Prepare the DELETE query
            $sqlDelete = "DELETE FROM produto WHERE id=?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("s", $id);

            // Execute the DELETE query
            if ($stmtDelete->execute()) {
                echo "Produto deletado com sucesso!";
            } else {
                echo "Erro ao deletar produto: " . $stmtDelete->error;
            }
        } else {
            echo "produto não encontrado.";
        }
    } else {
        echo "Erro ao executar a consulta SELECT: " . $stmtSelect->error;
    }

    // Close statements
    $stmtSelect->close();
    $stmtDelete->close();
}

header('Location: lista-produto.php');
?>