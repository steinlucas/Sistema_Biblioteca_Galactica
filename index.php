<?php
include_once 'classes/Editora.php';
include_once 'classes/Livro.php';
include_once 'classes/Autor.php';
include_once 'bd/LivrosDAO.php';
include_once 'bd/AutorDAO.php';
include_once 'bd/EditoraDAO.php';
$livrosDAO = new LivrosDAO ();
$listaLivros = $livrosDAO->recuperarTodosLivros ();

$mensagem = "";
if(isset($_GET['erro'])){
	if($_GET['erro'] == 'salvar'){
		$mensagem = 'Erro ao salvar novo livro';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Atividade EAD</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


</head>
<body>
	
	<h1 style="text-align: center; padding: 50px;">Listagem de Livros</h1>
	<br>
	<p style="color:red"><?php echo $mensagem; ?></p>
	<div class="table-responsive" id="listagem" style="padding: 20px;">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nome Livro</th>
					<th>Nome Autor</th>
					<th>Nome Editora</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			
			for($i = 0; $i < count ( $listaLivros ); $i ++) {
				$livro = $listaLivros [$i];
				$editora = $livro->getEditora ();
				$autor = $livro->getAutor ();
				

				
				?>
				<tr>
					<td><?=$livro->getTitulo()?></td>
					<td><?php if($autor != null) {echo $autor->getNome();} ?></td>
					<td><a
						href="VisualizarDadosEditora.php?id=<?=$editora->getCodigo()?>"><?=$editora->getNome()?></a></td>
					<td><a href="VisualizarDados.php?id=<?=$livro->getCodigo()?>"><span
							class='btn btn-info btn-sm rounded-pill py-0 deleteLink' title='Visualizar'>View</span></a>
						<button type="button" onclick="window.location='form/FormEditarLivro.php?id=<?=$livro->getCodigo()?>'" class="btn btn-default btn-lg">
							
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
								  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
								  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
								</svg>
							
						</button>
						<button type="button" data-id="<?=$livro->getCodigo()?>"  data-bs-toggle="modal" id="btnExcluir" name="btnExcluir" data-bs-target="#exampleModal" class="btn btn-default btn-lg">
						
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
						 
						</button>

							</td>
				</tr>
					
				<?php
			}
			?>
			</tbody>
		</table>
		<div style="text-align: left; padding: 30px;">
		<button name="Novo" type="button" class="btn btn-primary"
			onClick="window.location='./form/FormInserirLivro.php';">Novo Livro</button>
		</div>
	</div>
	
	
<script>
 onclick="window.location='dados/ExcluirLivro.php?id=<?=$livro->getCodigo()?>'"
 $(document).on("click", "#btnExcluir", function () {
     var id = $(this).data('id');
     $("#btnYes").click(function(){
     	window.location='dados/ExcluirLivro.php?id='+id
     });
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>	
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Exclusão de Livro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir o livro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <button type="button" id="btnYes" name="btnYes" class="btn btn-primary">Sim</button>
      </div>
    </div>
  </div>
</div>
