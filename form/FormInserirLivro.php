<?php
include_once '../bd/EditoraDAO.php';
include_once '../bd/AutorDAO.php';
$editoraDAO = new EditoraDAO ();
$autorDAO = new AutorDAO ();
$listaEditoras = $editoraDAO->recuperarTodasEditoras ();
$listaAutores = $autorDAO->recuperarTodosAutores();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Novo Livro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<body>
	<br>
	<h1 align="center">Cadastro de Livros</h1>
	<br>
	<div class="container d-flex justify-content-center">
		<form class="row gy-2 gx-3 align-items-center" method="POST" action="../dados/SalvarLivro.php" id="formInserirLivro">

			<div class="row g-3">
				<div class="col">
				    <label for="titulo">Título</label>
					<input type="text" class="form-control" name="titulo" id="titulo" maxLength="150" placeholder="* Título: " required>
				</div>
			</div>

			<div class="row g-3">
				<div class="col">
					<label for="isbn">ISBN</label>
					<input type="text" class="form-control" name="isbn" id="isbn" maxLength="45" placeholder="* ISBN: " required>
				</div>
				<div class="col">
					<label for="nPaginas">N. Páginas</label>
					<input type="text" class="form-control" name="nPaginas" id="nPaginas"  onkeypress="return isNumber(event)"
						minlength="2" maxLength="11" placeholder="* Núm. Páginas:" required>
				</div>
				<div class="col">
					<label for="numEdicao">N. Edição</label>
					<input type="text" class="form-control" name="numEdicao"  id="numEdicao"  onkeypress="return isNumber(event)"
						minlength="1" maxLength="2" placeholder="* Núm. Edição:" required>
				</div>
			</div>
			<div class="row g-3">
				<div class="col-sm-2">
					<label for="anoPublicacao">Ano de publicação</label>
					<input type="text" class="form-control" name="anoPublicacao"  id="anoPublicacao"  onkeypress="return isNumber(event)"
						maxLength="4" minlength="4" placeholder="* Ano Publicação:" required>
				</div>
				<div class="col">
					<label for="EditoraEdicao">N. Edição</label>
					<select class="form-control form-select" name="editora" id="editora">
						<?php
							for($i = 0; $i < count ( $listaEditoras ); $i ++) {
								$umaEditora = $listaEditoras [$i];
							?><option value="<?=$umaEditora->getCodigo()?>"><?=$umaEditora->getNome()?></option>
						<?php
							}
						?>
					</select>
				</div>
			</div>

			<div class="row g-3">
				<label for="divAutores">Autor</label>
				<div class="input-group-text">
					<select id="autor" name="autor"  class="form-control form-select">
						<?php
						foreach($listaAutores as $autor){
						
						?>
						  <option value="<?php echo $autor->getCodigo(); ?>"><?php echo $autor->getNome();?></option>
						  <?php } ?>
					</select>
  				</div>
			</div>
			
			<div class="container bg-light">
        		<div class="col-md-12 text-center">
					<input type="submit" value="Salvar" class="btn btn-primary">
					<button name="cancelar" onClick="JavaScript: window.history.back();" type="button" class="btn btn-primary">Cancelar</button>
				</div>
			</div>
		</form>
	</div>


	
</body>
</html>
