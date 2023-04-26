<?php
include_once 'Autor.php';
include_once 'Editora.php';
class Livro {
	private $codigo;
	private $titulo;
	private $isbn;
	private $nPaginas;
	private $anoPublicacao;
	private $numEdicao;
	private $autor;
	private $editora;
	public function setCodigo($novoCodigo) {
		$this->codigo = $novoCodigo;
	}
	public function setTitulo($novoTitulo) {
		$this->titulo = $novoTitulo;
	}
	public function setIsbn($novoIsbn) {
		$this->isbn = $novoIsbn;
	}
	public function setNPaginas($novoNPaginas) {
		$this->nPaginas = $novoNPaginas;
	}
	public function setAnoPublicacao($novoAnoPublicacao) {
		$this->anoPublicacao = $novoAnoPublicacao;
	}
	public function setNumEdicao($novoNumEdicao) {
		$this->numEdicao = $novoNumEdicao;
	}
	public function setAutor($novoAutor) {
		$this->autor = $novoAutor;
	}
	public function setEditora($novoEditora) {
		$this->editora = $novoEditora;
	}
	public function getCodigo() {
		return $this->codigo;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	public function getIsbn() {
		return $this->isbn;
	}
	public function getNPaginas() {
		return $this->nPaginas;
	}
	public function getAnoPublicacao() {
		return $this->anoPublicacao;
	}
	public function getNumEdicao() {
		return $this->numEdicao;
	}
	public function getAutor() {
		return $this->autor;
	}
	public function getEditora() {
		return $this->editora;
	}
}
?>
