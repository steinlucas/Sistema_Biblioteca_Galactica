<?php
include_once './bd/LivrosDAO.php';
include_once './classes/Livro.php';
$livrosDAO = new LivrosDAO ();
$id = $_GET ['id'];
$livro = $livrosDAO->pesquisarLivroPorCodigo ( $id );
$editora = $livro->getEditora ();
$autor = $livro->getAutor ();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Livro: <?php echo "{$livro->getTitulo()}"?> </title>
<link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<h1 style="margin:auto;  width: 20%; padding-top: 80px">Dados do Livro</h1>
	<div class="sub-header" style="text-align: center; padding-bottom: 40px" id="dadosLivro">
		<label>ISBN: </label><?php echo "{$livro->getIsbn()}"?>
		<p></p>
		<label>Título: </label><?php echo "{$livro->getTitulo()}"?>
		<p></p>
		<label>Num. Páginas: </label><?php echo "{$livro->getNPaginas()}"?>
		<p></p>
		<label>Edição: </label><?php echo "{$livro->getNumEdicao()}"?>
		<p></p>
		<label>Editora: </label><a
			href="VisualizarDadosEditora.php?id=<?=$editora->getCodigo()?>"><?=$editora->getNome()?></a>
		<p></p>

		<label>Autor:</label><?php
		for($i = 0; $i < count ( $autor ); $i ++) {
			$umAutor = $autor [$i];
			
			?><a
			href="VisualizarAutor.php?id=<?=$id?>&idAutor=<?=$umAutor->getCodigo()?>"><?=$umAutor->getNome()?></a>
				<?php
		}
		?>
		<p></p>

		<label>Ano: </label><?php echo "{$livro->getAnoPublicacao()}"?>
		<p></p>
		<button name="voltar" onClick="window.history.back();"
			type="button" class="btn btn-primary">Voltar</button>
	</div>
</body>
</html>
