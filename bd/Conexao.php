<?php
class Conexao {
	protected $conn;
	function __construct() {
		$this->conn = new PDO ( "mysql:host=localhost;dbname=estante", "root", "" );
	}
	public function obterConexao() {
		return $this->conn;
	}
}
?>
