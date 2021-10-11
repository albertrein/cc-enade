<?php

use Model\DatabaseConnection\MySqlConnection;

require('DatabaseConnection/MysqlConnection.php');

class CadastroPerguntas extends MySqlConnection{
	private $conn;

	function __construct(){
		parent::__construct();
		$this->conn = parent::getConnection();
		return false;
	}

	function salvarPergunta($dados){
		$sql = "INSERT INTO questoes(resposta, ano, nrquestao) VALUES ('".$dados['resposta']. "', ".$dados['ano_prova'].", ".$dados['nrquestao'].");";
		
		if($this->conn->query($sql)){
			return $this->retornaUltimoIdRegistrado();
		}
		return false;
	}

	function retornaUltimoIdRegistrado(){
		return $this->conn->query('SELECT MAX(questaopk) as id FROM questoes;');
	}

}
