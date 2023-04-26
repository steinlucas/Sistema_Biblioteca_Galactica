<?php
class Editora {
	private $codigo;
	private $nome;
	private $telefone;
	private $email;
	private $website;
	private $cidade;
	public function setCodigo($novoCodigo) {
		$this->codigo = $novoCodigo;
	}
	public function setNome($novoNome) {
		$this->nome = $novoNome;
	}
	public function setTelefone($novoTelefone) {
		$this->telefone = $novoTelefone;
	}
	public function setEmail($novoEmail) {
		$this->email = $novoEmail;
	}
	public function setWebsite($novoWebsite) {
		$this->website = $novoWebsite;
	}
	public function setCidade($novoCidade) {
		$this->cidade = $novoCidade;
	}
	public function getCodigo() {
		return $this->codigo;
	}
	public function getNome() {
		return $this->nome;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getWebsite() {
		return $this->website;
	}
	public function getCidade() {
		return $this->cidade;
	}
}

?>