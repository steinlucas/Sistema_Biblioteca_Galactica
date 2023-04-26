<?php
include_once 'Conexao.php';
@include_once '../classes/Livro.php';
@include_once 'EditoraDAO.php';
@include_once 'AutorDAO.php';
class LivrosDAO {
	protected $conn;
	function __construct() {
		$conexao = new Conexao ();
		$this->conn = $conexao->obterConexao ();
	}
	public function recuperarTodosLivros() {
		$comandoSQL = 'select * from livro';
		$resultado = $this->conn->query ( $comandoSQL );
		$arrayLivros = array ();
		
		$editoraDAO = new EditoraDAO ();
		$autorDAO = new AutorDAO ();
		foreach ( $resultado as $umRegistro ) {
			$livro = new Livro ();
			$livro->setCodigo ( $umRegistro ['id'] );
			$livro->setTitulo ( $umRegistro ['titulo'] );
			$livro->setNumEdicao ( $umRegistro ['numedicao'] );
			$livro->setNPaginas ( $umRegistro ['numpaginas'] );
			$livro->setIsbn ( $umRegistro ['isbn'] );
			$livro->setAnoPublicacao ( $umRegistro ['anopublicacao'] );
			$editora = $editoraDAO->pesquisarEditoraPorCodigo ( $umRegistro ['id_editora'] );
			$livro->setEditora ( $editora );
			$autor = $autorDAO->pesquisarAutorPorLivro ( $umRegistro ['id'] );
			$livro->setAutor ( $autor );
			array_push ( $arrayLivros, $livro );
		}
		return $arrayLivros;
	}
	public function pesquisarLivroPorCodigo($codigo) {
		$comandoSQL = 'select * from livro where id = :cod';
		$stmt = $this->conn->prepare ( $comandoSQL );
		
		$resultado = $stmt->execute ( array (
				'cod' => $codigo 
		) );
		
		$livro = null;
		
		$editoraDAO = new EditoraDAO ();
		$autorDAO = new AutorDAO ();
		while ( $umRegistro = $stmt->fetch () ) {
			$livro = new Livro ();
			$livro->setCodigo ( $umRegistro ['id'] );
			$livro->setTitulo ( $umRegistro ['titulo'] );
			$livro->setNumEdicao ( $umRegistro ['numedicao'] );
			$livro->setNPaginas ( $umRegistro ['numpaginas'] );
			$livro->setIsbn ( $umRegistro ['isbn'] );
			$livro->setAnoPublicacao ( $umRegistro ['anopublicacao'] );
			$editora = $editoraDAO->pesquisarEditoraPorCodigo ( $umRegistro ['id_editora'] );
			$livro->setEditora ( $editora );
			$autor = $autorDAO->pesquisarAutorPorLivro ( $umRegistro ['id'] );
			$livro->setAutor ( $autor );
		}
		
		return $livro;
	}
	
	public function pesquisarLivroPorTitulo($tituloPesquisado) {
		$comandoSQL = 'select * from livro where upper(titulo) like upper("%'.$tituloPesquisado.'%")';
		$resultado = $this->conn->query ( $comandoSQL );
		$arrayLivros = array ();
		
		$editoraDAO = new EditoraDAO ();
		$autorDAO = new AutorDAO ();
		foreach ( $resultado as $umRegistro ) {
			$livro = new Livro ();
			$livro->setCodigo ( $umRegistro ['id'] );
			$livro->setTitulo ( $umRegistro ['titulo'] );
			$livro->setNumEdicao ( $umRegistro ['numedicao'] );
			$livro->setNPaginas ( $umRegistro ['numpaginas'] );
			$livro->setIsbn ( $umRegistro ['isbn'] );
			$livro->setAnoPublicacao ( $umRegistro ['anopublicacao'] );
			$editora = $editoraDAO->pesquisarEditoraPorCodigo ( $umRegistro ['id_editora'] );
			$livro->setEditora ( $editora );
			$autor = $autorDAO->pesquisarAutorPorLivro ( $umRegistro ['id'] );
			$livro->setAutor ( $autor );
			array_push ( $arrayLivros, $livro );
		}
		return $arrayLivros;
	}
	
	
	
	public function inserirLivro($livro) {

			$comandoSQL = 'insert into livro(titulo, isbn, numpaginas, numedicao, anopublicacao, id_editora)
					 VALUES ( :titulo, :isbn, :nPaginas, :numEdicao, :anoPublicacao, :editora)';
			$stmt = $this->conn->prepare ( $comandoSQL );
			$resultado = $stmt->execute ( array (
					':titulo' => $livro->getTitulo (),
					':isbn' => $livro->getIsbn (),
					':nPaginas' => $livro->getNPaginas (),
					':numEdicao' => $livro->getNumEdicao (),
					':anoPublicacao' => $livro->getAnoPublicacao (),
					':editora' => $livro->getEditora () 
			) );
			$id_livro = $this->conn->lastInsertId();

			
			$comandoSQL = 'insert into livro_autor(id_livro, id_autor)
					 VALUES ( :id_livro, :id_autor)';
			$stmt = $this->conn->prepare ( $comandoSQL );
			$resultado = $stmt->execute ( array (
					':id_livro' => $id_livro,
					':id_autor' => $livro->getAutor()->getCodigo () 
			) );


			return $resultado;

	}
	public function editarLivro($livro) {
		try {
			$this->conn->beginTransaction ();
			$comandoSQL = 'update livro set titulo= :titulo, isbn= :isbn, numpaginas= :nPaginas, numedicao = :numEdicao, 
							anopublicacao = :anoPublicacao, id_editora = :editora where id= :cod';
			$stmt = $this->conn->prepare ( $comandoSQL );
			$resultado = $stmt->execute ( array (
					':cod' => $livro->getCodigo (),
					':titulo' => $livro->getTitulo (),
					':isbn' => $livro->getIsbn (),
					':nPaginas' => $livro->getNPaginas (),
					':numEdicao' => $livro->getNumEdicao (),
					':anoPublicacao' => $livro->getAnoPublicacao (),
					':editora' => $livro->getEditora () 
			) );

			$comandoSQL = 'delete from livro_autor where id_livro= :cod';
			$stmt = $this->conn->prepare ( $comandoSQL );

			$resultado = $stmt->execute ( array (
					':cod' => $livro->getCodigo (),
			) );
			

			$comandoSQL = 'insert into livro_autor(id_livro, id_autor)
					 VALUES ( :id_livro, :id_autor)';
			$stmt = $this->conn->prepare ( $comandoSQL );
			
			$resultado = $stmt->execute ( array (
					':id_livro' => $livro->getCodigo(),
					':id_autor' => $livro->getAutor()->getCodigo() 
			) );
		
			$this->conn->commit ();
		} catch ( PDOException $e ) {
			$this->conn->rollback ();
			var_dump( $e);
			return false;
		}
		
		return true;
	}
	
	public function excluirLivro($codigo) {
		try {
			$this->conn->beginTransaction();
			$comandoSQL = 'delete from livro_autor where id_livro = :cod';
			$stmt = $this->conn->prepare ( $comandoSQL );
			$comandoSQL = 'delete from livro where id = :cod';
			$stmt2 = $this->conn->prepare ( $comandoSQL );
			$resultado = $stmt->execute ( array (
					'cod' => $codigo
			) );
			$resultado2 = $stmt2->execute ( array (
					'cod' => $codigo
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
