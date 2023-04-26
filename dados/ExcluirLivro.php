<?php
include_once '../bd/LivrosDAO.php';
$livrosDAO = new LivrosDAO ();
$id = $_GET ['id'];
$livrosDAO->excluirLivro ( $id );
header ( "Location: ../index.php" )?>