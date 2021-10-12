<?php

use Model\DatabaseConnection\MySqlConnection;

require('DatabaseConnection/MysqlConnection.php');

class CadastroPerguntas extends MySqlConnection{
	private $conn;
	private $tableName;

	function __construct($tableName = 'questoes'){
		parent::__construct();
		$this->conn = parent::getConnection();
		$this->tableName = $tableName;
		return true;
	}

	function salvarPergunta($dados){
		$sql = "INSERT INTO ".$this->tableName."(resposta, ano, nrquestao) VALUES ('".$dados['resposta']. "', ".$dados['ano_prova'].", ".$dados['nrquestao'].");";
		
		if($this->conn->query($sql)){
			return $this->retornaUltimoIdRegistrado();
		}
		return false;
	}

	function retornaUltimoIdRegistrado(){
		return $this->conn->query('SELECT MAX(questaopk) as id FROM '.$this->tableName.';');
	}

}
