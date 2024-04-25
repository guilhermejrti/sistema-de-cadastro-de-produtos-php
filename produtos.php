<?php
// Informações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'sistema';
$username = 'root';
$password = '';

// Criar conexão
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Selecionar todos os produtos da tabela produtos
$sql = "SELECT nome, descricao, preco, foto, id FROM produtos";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="editar.css">
    <title>Produtos cadastrados</title>
</head>
<body>
<div class="containerG">
<a href="index.php"><input type="submit" value="VOLTAR"></a>
  <div class="row">

<?php

// Exibir os produtos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

<div class="col-sm">
        <div class="card" style="width: 18rem;">
        <img src="uploads/<?php echo $row['foto'];?>" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title"><?php echo $row['nome'];?></h5>
            <p class="card-text"><?php echo $row['descricao'];?></p>
            <p class="card-text"><?php echo $row['preco'];?></p>
            <p class="card-text"><?php echo $row['id'];?></p>
            </div>
                <div class="card-body">
                <a href="editar_produto.php?id=<?php echo $row['id'];?>"><input type="submit" value="Editar"></a>
                <a href="excluir_produto.php?id=<?php echo $row['id'];?>"><input type="submit" value="Excluir"></a>
                
                </div>
            </div><br>

           
        </div>


   <?php }
} else {
    echo "Nenhum produto cadastrado.";
}

// Fechar conexão
$conn->close();
?>







</body>
</html>