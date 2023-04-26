<?php
include_once './bd/AutorDAO.php';
include_once './classes/Autor.php';
$autorDAO = new AutorDAO ();
$id = $_GET ['idAutor'];
$umAutor = $autorDAO->pesquisarAutorPorCodigo ( $id );

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Autor: <?php echo "{$umAutor->getNome()}"?> </title>
<link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1 style="margin:auto;  width: 20%; padding-top: 80px">Dados do Autor</h1>
	<div  class="sub-header" style="text-align: center; padding-bottom: 40px">
		<label for="nome">Nome: </label> <?php echo "{$umAutor->getNome()}"?>
			<p></p>
		<label for="email">E-mail: </label>  <?php echo "{$umAutor->getEmail()}"?>
			<p></p>
		<label for="website">Website: </label> <?php echo "{$umAutor->getWebsite()}"?>
			<p></p>
		<button name="voltar" onClick="window.history.back();"
			type="button" class="btn btn-primary">Voltar</button>
	</div>
</body>
</html>
