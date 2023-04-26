<?php
include_once '../bd/LivrosDAO.php';
include_once '../classes/Livro.php';
include_once '../classes/Autor.php';
$livrosDAO = new LivrosDAO ();
$livro = new Livro ();
$livro->setTitulo ( $_POST ['titulo'] );
$livro->setNumEdicao ( $_POST ['numEdicao'] );
$livro->setNPaginas ( $_POST ['nPaginas'] );
$livro->setIsbn ( $_POST ['isbn'] );
$livro->setAnoPublicacao ( $_POST ['anoPublicacao'] );
$livro->setEditora ( $_POST ['editora'] );


$id = $_POST['autor'];
$autor = new Autor();
$autor->setCodigo($id);
$livro->setAutor($autor);
$resultado = $livrosDAO->inserirLivro ( $livro );
if($resultado == True){
    header ( "Location: ../index.php" );
} else{
    header ( "Location: ../index.php?erro=salvar" );

}



?>
	
