<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="imagemreser.css">
    <title>Document</title>
</head>
<body>
<body>
<header>
        <div class="nav-bar">
            
                    <a href="index.php"><h1>TRUTH</h1></a>
                <div class="nav-item">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="contact.php">Contato</a></li>
                </div>
    </header>
 

    <title>Formulário e Exibição de Mensagens</title>
    <style>
     /* cards.css */

* {
    margin: 0;
    padding: 0;
}

.nav-bar{
    background-color: white;
    display: flex;
    height: 15pc;
    width: 100%;
    align-items: center;
    overflow: hidden;
    transition: top 0.3s;
}

.nav-bar h1{
    color: black;
    margin-top: 5%;
    font-size: 50px;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ;
    margin-left: 10pc;
    padding: 0px;
    flex-direction: column;
}


.nav-bar a{
    text-decoration: none;
}

.nav-item{
    margin-top: 10px;
    margin-left: 5%;
}

.nav-bar li{
    display: flex;
    justify-content: center;
    font-style: none;
    list-style: none;
    margin-left: 4pc;
    font-size: 25px;
    font-family: Arial, Helvetica, sans-serif;
    float: left;
}

.nav-bar li a{
    text-decoration: none;
    color: rgb(95, 95, 95);
    transition: all ease 0.3s;
}

.nav-bar li a:hover{
    color: rgb(209, 190, 83);
}

.card {
  /* Estilos para todos os cards */
  border: 1px solid #ccc;
  padding: 20px;
  margin: 10px;
  background-color: #f9f9f9;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
 
  
}
.card {
  /* Estilos para todos os cards */
  border: 1px solid #ccc;
  padding: 20px;
  margin: 10px;
  background-color: #f9f9f9;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
 
  
}

.card-header {
  /* Estilos para o cabeçalho do card */
  font-weight: bold;
  margin-bottom: 10px;
}

section {
  /* Estilos para a seção de conteúdo */
  display: flex;
  flex-wrap: wrap;
}

img {
  /* Estilos para a imagem */
  max-width: 200px;
  height: auto;
  margin-right: 10px;
}
.certo{
  display: grid;
  grid-template-columns: auto auto auto auto;
  margin-inline: center;
  flex-wrap: wrap;
}
    </style>
</head>
<body>
<div class="certo">
<?php
include_once('conexao.php');


// Preparando a query SQL para selecionar os dados
$sql = "SELECT id, tipo, tamanho, descricao, preco, quantidade, imagem FROM produto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Saída dos dados de cada linha
    while($row = $result->fetch_assoc()) {
      
      echo "<div class='card'>";
      echo "<div class='card-header'> Categoria : " . $row["tipo"] . "</div>";
      echo "<div class='p'> Tamanho : " . $row["tamanho"]. "</div>";
      echo "<div class='p'> Descrição : " . $row["descricao"]. "</div>"; 
      echo "<div class='p'> Preço : " . $row["preco"]. "</div>";
      echo "<div class='p'> Quantidade : " . $row["quantidade"]. "</div>";
      echo "<div class='p'> <img src='" . $row["imagem"] . "' alt='Imagem'><br>" . "</div>";  
      echo "</div>";  
        
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
</div>
</body>