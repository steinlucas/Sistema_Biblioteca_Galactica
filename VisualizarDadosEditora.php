<?php
include_once './bd/EditoraDAO.php';
@include_once './classes/Editora.php';
$editoraDAO = new EditoraDAO ();
$id = $_GET ['id'];
$editora = $editoraDAO->pesquisarEditoraPorCodigo ( $id );

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Editora: <?php echo "{$editora->getNome()}"?> </title>
<link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<h1  style="margin:auto;  width: 20%; padding-top: 80px">Dados da Editora</h1>
	<div  class="sub-header" style="text-align: center; padding-bottom: 40px">
		<label for="nome">Nome: </label><?php echo "{$editora->getNome()}"?> 
			<p></p>
		<label for="email">E-mail: </label> <?php echo "{$editora->getEmail()}"?> 
			<p></p>
		<label for="website">Website: </label><?php echo "{$editora->getWebsite()}"?> 
			<p></p>
		<label for="fone">Telefone: </label><?php echo "{$editora->getTelefone()}"?> 
		<p></p>
		<label for="cidade">Cidade: </label><?php echo "{$editora->getCidade()}"?> 
		<p></p>
		<button name="voltar" onclick="window.history.back();"
			type="button" class="btn btn-primary">Voltar</button>
	</div>

</body>
</html>
