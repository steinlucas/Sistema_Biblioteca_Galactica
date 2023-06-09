<?php
include_once '../bd/EditoraDAO.php';
include_once '../bd/LivrosDAO.php';
$autorDAO = new AutorDAO ();
$listaAutores = $autorDAO->recuperarTodosAutores();

$editoraDAO = new EditoraDAO ();
$listaEditoras = $editoraDAO->recuperarTodasEditoras ();
$livrosDAO = new LivrosDAO ();
$id = $_GET ['id'];
$livro = $livrosDAO->pesquisarLivroPorCodigo ( $id );
$editora = $livro->getEditora ();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Editar Livro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>
		<br>
	<h1 align="center">Alterar o Livro</h1>
	<br>
	<div class="container d-flex justify-content-center">
	<form class="row gy-2 gx-3 align-items-center" method="POST" action="../dados/AtualizarLivro.php" id="formEditarLivro">
					<input type="hidden" id="codigo" name="codigo" value="<?php echo $livro->getCodigo();?>"/>
			<div class="row g-3">
				<div class="col">
				    <label for="titulo">Título</label>
					<input type="text" class="form-control" name="titulo" id="titulo" maxLength="150" placeholder="* Título: " required value="<?=$livro->getTitulo()?>">
				</div>
			</div>

			<div class="row g-3">
				<div class="col">
					<label for="isbn">ISBN</label>
					<input type="text" class="form-control" name="isbn" id="isbn" maxLength="45" placeholder="* ISBN: " required value="<?=$livro->getIsbn()?>">
				</div>
				<div class="col">
					<label for="nPaginas">N. Páginas</label>
					<input type="text" class="form-control" name="nPaginas" id="nPaginas"  onkeypress="return isNumber(event)"
						minlength="2" maxLength="11" placeholder="* Núm. Páginas:" value="<?=$livro->getNPaginas()?>" required>
				</div>
				<div class="col">
					<label for="numEdicao">N. Edição</label>
					<input type="text" class="form-control" name="numEdicao"  id="numEdicao"  onkeypress="return isNumber(event)"
						minlength="1" maxLength="11" placeholder="* Núm. Edição:" value="<?=$livro->getNumEdicao()?>" required>
				</div>
			</div>
			<div class="row g-3">
				<div class="col-sm-2">
					<label for="anoPublicacao">Ano de publicação</label>
					<input type="text" class="form-control" name="anoPublicacao"  id="anoPublicacao"  onkeypress="return isNumber(event)"
						maxLength="4" minlength="4" placeholder="* Ano Publicação:" value="<?=$livro->getAnoPublicacao()?>" required>
				</div>
				<div class="col">
					<label for="EditoraEdicao">N. Edição</label>
					<select class="form-control form-select" name="editora" id="editora" >
						<?php
							for($i = 0; $i < count ( $listaEditoras ); $i ++) {
								$editora_checked = "";
								$umaEditora = $listaEditoras [$i];
								if($umaEditora->getCodigo() == $livro->getEditora()->getCodigo()){
									$editora_checked = 'selected';
								}
							?><option value="<?=$umaEditora->getCodigo()?>" <?=$editora_checked?>><?=$umaEditora->getNome()?></option>
						<?php
							}
						?>
					</select>
				</div>
			</div>

			<div class="row g-3">
				<label for="divAutores">Autor</label>
				<div class="input-group-text">
					<select id="autor" name="autor" class="select2" multiple>
						<?php
						foreach($listaAutores as $autor){
							$selected = "";
							if($livro->getAutor() != null){
								if($autor->getCodigo() == $livro->getAutor()->getCodigo()){
									$selected = "selected";
								}
							}
						?>
						  <option value="<?php echo $autor->getCodigo(); ?>" <?php echo $selected;?>><?php echo $autor->getNome();?></option>
						  <?php } ?>
					</select>
  					<button id="addautor" style="float: left" type="button" class="btn btn-outline-secondary">Add</button>
				</div>
			</div>

			<table id="tabelaAutores">
				<thead>
					<tr>
						<th>Editar</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>

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


<script>

  //// Adicionar na lista ////

  $('.select2').select2();

  $('#addautor').click(function() {
  // Obter os valores selecionados do Select2
  var selectedValues = $('.select2').val();

  // Adicionar cada valor selecionado à tabela HTML
  $.each(selectedValues, function(index, value) {
    $('#tabelaAutores tbody').append('<tr><td>' + value + '</td><td><a class="btn-delete" data-id="'+value+'">Excluir</a></td></tr>');
  });

  // Limpar o Select2 após a seleção
  $('.select2').val(null).trigger('change');

  // Enviar os valores selecionados para o servidor usando AJAX
  $.ajax({
    type: 'POST',
    data: { values: selectedValues },
    success: function(data) {
      console.log('Valores enviados com sucesso!');
    },
    error: function() {
      console.log('Erro ao enviar valores!');
    }
  });
});


//// Remover da lista ////

$('#tabelaAutores').on('click', '.btn-delete', function() {
  var row = $(this).closest('tr');
  var id = $(this).data('id');

  // Enviar o ID para o servidor usando AJAX
  $.ajax({
    type: 'POST',
    data: { id: id },
    success: function() {
      // Remover a linha da tabela HTML
      row.remove();
    },
    error: function() {
      console.log('Erro ao remover linha!');
    }
  });
});

</script>