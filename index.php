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

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = $_FILES['foto']['name'];

    // Diretório onde a foto será armazenada
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);

    // Mover a foto para o diretório especificado
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

    // Inserir dados na tabela produtos
    $sql = "INSERT INTO produtos (nome, descricao, preco, foto)
    VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $nome, $descricao, $preco, $foto);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar produto: " . $stmt->error;
    }

    // Fechar statement
    $stmt->close();
}
// Fechar conexão
$conn->close();
?>

<?php
include "header.php";
?>


<div class="container">
	<header class="header">
		<h1 id="title" class="text-center">Cadastro de Produtos</h1>
		<p id="description" class="text-center">
			Formulário utilizado para cadastrar produtos
		</p>
	</header>
	<div class="form-wrap">	
		<form action="" id="survey-form" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label id="name-label" for="name">Nome</label>
						<input type="text" name="nome" id="nome" placeholder="Nome do produto" class="form-control" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="email-label" for="email">Descrição</label>
						<input type="text" name="descricao" id="descricao" placeholder="Informe a descrição do produto" class="form-control" required>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label id="number-label" for="number">Preço</label>
						<input type="text" name="preco" id="preco" class="form-control" placeholder="Preço do Produto" >
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label id="number-label" for="number">Imagem do Produto</label>
						<input type="file" name="foto" id="foto" class="form-control" placeholder="Foto do Produto" >
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<button type="submit" id="submit" class="btn btn-primary btn-block">Cadastrar</button>
				</div>
			</div>
		</form>

		<br><br>
		<a href="produtos.php"><button class="btn btn-primary btn-block">PRODUTOS CADASTRADOS</button></a>
	</div>	
</div>



<?php
include "footer.php";
?>