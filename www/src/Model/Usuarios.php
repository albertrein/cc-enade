<?php

use Model\DatabaseConnection\MySqlConnection;

require_once('DatabaseConnection/MysqlConnection.php');

class Usuarios extends MySqlConnection{
	private $conn;

	function __construct(){
		parent::__construct();
		$this->conn = parent::getConnection();
		return false;
	}

	function closeConnection(){
		mysqli_close($this->conn);
	}

	function retornaPkByUserEmail($email){
		$sql = "SELECT usuariopk FROM usuarios WHERE email = '".$email."';";
		$resultado = $this->conn->query($sql);
		if($resultado === NULL){
			return false;
		}
		return mysqli_fetch_assoc($resultado);
	}

	function findUsuarioPeloEmail($email){
		$sql = "SELECT nome, isprofessor FROM usuarios WHERE email = '".$email."';";
		$resultado = $this->conn->query($sql);
		
		if(mysqli_num_rows($resultado) === 1){
			return mysqli_fetch_assoc($resultado);
		}
		return false;
	}

	function insereNovoUsuario($nome, $email, $isprofessor){
		$handler = $this->conn->prepare('INSERT INTO usuarios(nome, email, isprofessor) VALUES (?, ?, ?)');
		$handler->bind_param('ssi', $nome, $email, $isprofessor);
		return $handler->execute();
	}

	function retornaRanking(){
		$sql = "SELECT pontuacao as pontuacaousuario, nome as nomeusuario FROM usuarios WHERE isprofessor = 0 ORDER BY pontuacao DESC LIMIT 3";
		$resultado = $this->conn->query($sql);
		if($resultado->num_rows > 0){
			return $resultado;
		}
		return false;
	}

	function atualizaPontuacaoUsuario($emailUsuario){
		$sql = "UPDATE usuarios SET pontuacao=pontuacao+1 WHERE email='".$emailUsuario."' AND isprofessor != 1";
		$this->conn->query($sql);
	}
}