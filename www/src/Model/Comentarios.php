<?php

use Model\DatabaseConnection\MySqlConnection;

require_once('DatabaseConnection/MysqlConnection.php');

class Comentarios extends MySqlConnection{
	private $conn;

	function __construct(){
		parent::__construct();
		$this->conn = parent::getConnection();
		return false;
	}

	function buscaComentarios($idQuestao){
		$sql = "SELECT c.mensagem, u.nome AS nomeUsuario FROM comentarios c LEFT JOIN usuarios u ON u.usuariopk=c.usuariofk WHERE questaofk =".$idQuestao." ORDER BY date(data) ASC, hora ASC";
		$resultado = $this->conn->query($sql);
		if($resultado === NULL){
			return false;
		}
		return $resultado;
	}

	function questaoPossuiComentarios($idQuestao){
		$sql = "SELECT comentariopk FROM comentarios WHERE questaofk =".$idQuestao." LIMIT 1";
		$resultado = $this->conn->query($sql);
		if(mysqli_fetch_assoc($resultado) === NULL){
			return false;
		}
		return true;
	}

	function insereNovoComentario($dados){
		$handler = $this->conn->prepare('INSERT INTO comentarios(mensagem, data, hora, usuariofk, questaofk) VALUES (?, ?, ?, ?, ?)');
		$handler->bind_param('sssii', $dados['novaMensagem'], date('Y-m-d'), date('H:i:s'), $dados['usuariofk'], $dados['idquestao']);
		return $handler->execute();
	}

}