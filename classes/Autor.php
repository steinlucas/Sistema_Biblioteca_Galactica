<?php
class Autor {
	private $codigo;
	private $nome;
	private $email;
	private $website;
	public function setCodigo($novoCodigo) {
		$this->codigo = $novoCodigo;
	}
	public function setNome($novoNome) {
		$this->nome = $novoNome;
	}
	public function setEmail($novoEmail) {
		$this->email = $novoEmail;
	}
	public function setWebsite($novoWebsite) {
		$this->website = $novoWebsite;
	}
	public function getCodigo() {
		return $this->codigo;
	}
	public function getNome() {
		return $this->nome;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getWebsite() {
		return $this->website;
	}
}
?>
