<?php
include_once 'Conexao.php';
@include_once '../classes/Editora.php';
class EditoraDAO {
	protected $conn;
	function __construct() {
		$conexao = new Conexao ();
		$this->conn = $conexao->obterConexao ();
	}
	public function recuperarTodasEditoras() {
		$comandoSQL = 'select * from editora';
		$resultado = $this->conn->query ( $comandoSQL );
		$arrayEditoras = array ();
		
		foreach ( $resultado as $umRegistro ) {
			$editora = new Editora ();
			$editora->setCodigo ( $umRegistro ['id'] );
			$editora->setNome ( $umRegistro ['nome'] );
			$editora->setCidade ( $umRegistro ['cidade'] );
			$editora->setEmail ( $umRegistro ['email'] );
			$editora->setWebsite ( $umRegistro ['website'] );
			$editora->setTelefone ( $umRegistro ['telefone'] );
			array_push ( $arrayEditoras, $editora );
		}
		return $arrayEditoras;
	}
	public function pesquisarEditoraPorCodigo($codigo) {
		$comandoSQL = 'select * from editora where id = :cod';
		$stmt = $this->conn->prepare ( $comandoSQL );
		
		$resultado = $stmt->execute ( array (
				'cod' => $codigo 
		) );
		
		$editora = null;
		
		while ( $umRegistro = $stmt->fetch () ) {
			$editora = new Editora ();
			$editora->setCodigo ( $umRegistro ['id'] );
			$editora->setNome ( $umRegistro ['nome'] );
			$editora->setCidade ( $umRegistro ['cidade'] );
			$editora->setEmail ( $umRegistro ['email'] );
			$editora->setWebsite ( $umRegistro ['website'] );
			$editora->setTelefone ( $umRegistro ['telefone'] );
		}
		
		return $editora;
	}
}
?>
