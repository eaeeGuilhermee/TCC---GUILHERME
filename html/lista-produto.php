<?php
// Include configuration file (assuming it contains database details)
include_once('conexao.php');

// Create the query to retrieve reservoir data
$sql = "SELECT id, tipo, tamanho, descricao, preco, quantidade, imagem FROM produto";

// Execute the query and check for success
$result = $conn->query($sql);
if (!$result) {
    die("Failed to execute query: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Produtos</title>

    <style>
        body {
            background: url(peixe.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            color: black 0.6;
            text-align: center;
        }

        .nav{
            display: flex;
            justify-content: center;
            background-color: whitesmoke;
            height: 15vh;
        }

        .nav h1{
            margin-top: 7px;
            color: #3e3e3e;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ;
        }

        .table-bg {
            background-color: #3e3e3e;
        }

        .d-flex{
            display: flex;
            margin-right: 5%;
            margin-top: 10px;
            justify-content: right;
        }

        .button{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #3e3e3e;
            text-decoration: none;
            height: 7vh;
            width: 4vw;
            color: white;
            border-radius: 10px;
            transition: all ease 0.4s;
        }

        .button:hover{
            background-color: orange;
            color: #3e3e3e;
        }

    </style>
</head>
<body>
<div class="nav">
            <h1>Produtos</h1>


            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        
    </div>

    <div class="d-flex">
        <a href="sair.php" class="button">Voltar</a>
    </div>
<br>



<br>

<div class="box-search">
    
    </div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">tipo</th>
                    <th scope="col">tamanho</th>
                    <th scope="col">descricao </th>
                    <th scope="col">preco</th>
                    <th scope="col">quantidade</th>
                    <th scope="col">imagem</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['tipo']."</td>";
                        echo "<td>".$user_data['tamanho']."</td>";
                        echo "<td>".$user_data['descricao']."</td>";
                        echo "<td>".$user_data['preco']."</td>";
                        echo "<td>".$user_data['quantidade']."</td>";
                        echo "<td>".$user_data['imagem']."</td>";
                        echo "<td>
                        <a class='btn btn-sm btn-primary' href='edit1.php?id=$user_data[id]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.20 7 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                            </a> 
                            <a class='btn btn-sm btn-danger' href='delete1.php?id=$user_data[id]' title='Deletar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>