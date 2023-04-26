<?php
class Conexao {
	protected $conn;
	function __construct() {
		$this->conn = new PDO ( "mysql:host=localhost;dbname=estante", "root", "123" );
	}
	public function obterConexao() {
		return $this->conn;
	}
}
?>
