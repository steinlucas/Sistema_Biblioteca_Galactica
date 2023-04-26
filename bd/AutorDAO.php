<?php
include_once 'Conexao.php';
@include_once '../classes/Autor.php';
class AutorDAO {
	protected $conn;
	function __construct() {
		$conexao = new Conexao ();
		$this->conn = $conexao->obterConexao ();
	}
	public function recuperarTodosAutores() {
		$comandoSQL = 'select * from autor order by nome';
		$resultado = $this->conn->query ( $comandoSQL );
		$arrayAutores = array ();
		
		foreach ( $resultado as $umRegistro ) {
			$autor = new Autor ();
			$autor->setCodigo ( $umRegistro ['id'] );
			$autor->setNome ( $umRegistro ['nome'] );
			$autor->setEmail ( $umRegistro ['email'] );
			$autor->setWebsite ( $umRegistro ['website'] );
			array_push ( $arrayAutores, $autor );
		}
		return $arrayAutores;
	}
	
	public function pesquisarAutoresPorNome($nome, $limit=10) {
		$comandoSQL = "select * from autor where nome like :nome order by nome LIMIT :li";
		$stmt = $this->conn->prepare ( $comandoSQL );
		$stmt->bindValue(':nome', "%$nome%");
		$stmt->bindValue(':li', $limit, PDO::PARAM_INT);
		
		$resultado = $stmt->execute ();
		
		$autores = [];
		
		while ( $umRegistro = $stmt->fetch () ) {
			$autor = new Autor ();
			$autor->setCodigo ( $umRegistro ['id'] );
			$autor->setNome ( $umRegistro ['nome'] );
			$autor->setEmail ( $umRegistro ['email'] );
			$autor->setWebsite ( $umRegistro ['website'] );
			$autores[] = $autor;
		}
		
		return $autores;
	}
	public function pesquisarAutorPorLivro($codigo) {
		$comandoSQL = 'select a.* from autor a 
						inner join livro_autor li on li.id_autor=a.id 
						where id_livro = :cod order by nome';
		$stmt = $this->conn->prepare ( $comandoSQL );
		
		$resultado = $stmt->execute ( array (
				'cod' => $codigo 
		) );
		

		$autor = null;
		
		$umRegistro = $stmt->fetch ();
		
		if($umRegistro != null){
			$autor = new Autor ();
			$autor->setCodigo ( $umRegistro ['id'] );
			$autor->setNome ( $umRegistro ['nome'] );
			$autor->setEmail ( $umRegistro ['email'] );
			$autor->setWebsite ( $umRegistro ['website'] );
		}
		return $autor;
	}
	public function inserirAutor($autor, $idLivro) {
		try {
			$this->conn->beginTransaction ();
			
			$comandoSQL = 'insert into autor(nome, email, website)
					 VALUES ( :nome, :email, :website)';
			$stmt = $this->conn->prepare ( $comandoSQL );
			
			
			
			$resultado = $stmt->execute ( array (
					':nome' => $autor->getNome (),
					':email' => $autor->getEmail (),
					':website' => $autor->getWebsite () 
			) );
			
			$comandoSQL = 'insert into livro_autor (id_livro, id_autor)
							VALUES( :codigoLivro, :codigoAutor)';
			$stmt2 = $this->conn->prepare ( $comandoSQL );
			
			$id = $this->conn->lastInsertId ( "codigo" );
			
			$resultado2 = $stmt2->execute ( array (
					'codigoLivro' => $idLivro,
					'codigoAutor' => $id 
			) );
			
			$this->conn->commit ();
		} catch ( PDOException $e ) {
			$this->conn->rollback ();
			return false;
		}
		
		return true;
	}
	public function editarAutor($autor) {
		try {
			$this->conn->beginTransaction ();
			$comandoSQL = 'update autor set nome= :nome, email = :email, website= :website where id= :cod';
			$stmt = $this->conn->prepare ( $comandoSQL );
			$resultado = $stmt->execute ( array (
					':cod' => $autor->getCodigo (),
					':nome' => $autor->getNome (),
					':email' => $autor->getEmail (),
					':website' => $autor->getWebsite () 
			) );
			
			$this->conn->commit ();
		} catch ( PDOException $e ) {
			$this->conn->rollback ();
			return false;
		}
		
		return true;
	}
	public function excluirAutorLivro($idLivro, $idAutor) {
		try {
			$this->conn->beginTransaction ();
			$comandoSQL = 'delete from livro_autor where id_livro = :cod and id_autor = :codAutor';
			$stmt = $this->conn->prepare ( $comandoSQL );
			$resultado = $stmt->execute ( array (
					'cod' => $idLivro,
					'codAutor' => $idAutor 
			) );
			$this->conn->commit ();
		} catch ( PDOException $e ) {
			$this->conn->rollback ();
			return false;
		}
		
		return true;
	}
}
?>
