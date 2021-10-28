<?php

use Model\DatabaseConnection\MySqlConnection;

require_once('DatabaseConnection/MysqlConnection.php');

class Questionario extends MySqlConnection{
	private $conn;
	private $tableName;

	function __construct($tableName = 'questoes'){
		parent::__construct();
		$this->tableName = $tableName;
		$this->conn = parent::getConnection();
		return true;
	}

	function closeConnection(){
		mysqli_close($this->conn);
	}

	function buscaResposta($dados){
		$sql = "SELECT resposta from ".$this->tableName." WHERE ano = ".$dados['ano']. " AND  nrquestao = ".$dados['nrquestao'];
		$resultado = $this->conn->query($sql);
		if($resultado->num_rows == 1){
			return $resultado;
		}
		return false;
	}

	function atualizaAcertosDaQuestao($dados){
		$handler = $this->conn->prepare('UPDATE '.$this->tableName.' SET acertos = acertos + 1 WHERE ano = ? AND nrquestao = ?');
		$handler->bind_param('ii', $dados['ano'], $dados['nrquestao']);
		if(!$handler->execute()){
			return false;
		}
		return $handler->get_result();
	}

	function atualizaErrosDaQuestao($dados){
		$handler = $this->conn->prepare('UPDATE '.$this->tableName.' SET erros = erros + 1 WHERE ano = ? AND nrquestao = ?');
		$handler->bind_param('ii', $dados['ano'], $dados['nrquestao']);
		if(!$handler->execute()){
			return false;
		}
		return $handler->get_result();
	}

	function buscaQuestao(){
		$ultimoPk = $this->getUltimoIdInserido();
		
		while(true){
			$questaoAleatoria = $this->conn->query("SELECT questaopk, ano, nrquestao, duvida from ".$this->tableName." WHERE questaopk = ".rand(0,$ultimoPk));
			$dados = mysqli_fetch_assoc($questaoAleatoria);
			if($dados === NULL){
				continue;
			}
			return $dados;
		}
	}

	function getUltimoIdInserido(){
		$lastPk = $this->conn->query("SELECT questaopk FROM ".$this->tableName." order by questaopk DESC LIMIT 1;");
		return mysqli_fetch_assoc($lastPk)['questaopk'];
	}

	function retornaUltimoIdRegistrado(){
		return $this->conn->query('SELECT MAX(questaopk) as id FROM '.$this->tableName.';');
	}

	function buscaListaQuestoes($numeroQuestao){
		$handler = $this->conn->prepare('SELECT questaopk, ano, nrquestao, duvida FROM '.$this->tableName.' WHERE nrquestao = ?');
		$handler->bind_param('i', $numeroQuestao);
		if(!$handler->execute()){
			return false;
		}
		return $handler->get_result();
	}

	function requisitarAjuda($idQuestao){
		$sql = "UPDATE ".$this->tableName." SET duvida = 1 WHERE questaopk=".$idQuestao;
		$this->conn->query($sql);
		return true;
	}

	function buscaQuestoesEmAvaliacoes(){
		$sql = "SELECT questaopk, ano, nrquestao, duvida FROM ".$this->tableName." WHERE duvida = 1";
		$resultado = $this->conn->query($sql);
		if($resultado->num_rows > 0){
			return $resultado;
		}
		return false;
	}

	function atualizaQuestaoEmAvalicao($idQuestao, $duvida){
		$sql = "UPDATE ".$this->tableName." SET duvida = ".$duvida." WHERE questaopk=".$idQuestao;
		$this->conn->query($sql);
		return true;
	}

	function retornaQuestoesMaisErradas(){
		$sql = 'SELECT count(erros) as qtderros FROM '.$this->tableName.' where erros != 0';
		$qtdErros = $this->conn->query($sql);		
		if(!$qtdErros || $qtdErros->num_rows == 0){
			return false;
		}
		$qtdErros = mysqli_fetch_assoc($qtdErros);
		$handler = $this->conn->prepare('SELECT nrquestao, ano, erros FROM '.$this->tableName.' ORDER BY erros DESC LIMIT '.$qtdErros["qtderros"]);
		if(!$handler->execute()){
			return false;
		}
		return $handler->get_result();
	}

}

/*
$resultado = $this->conn->query($query) -> executa a query
object(mysqli_result)#3 (5) { ["current_field"]=> int(0) ["field_count"]=> int(1) ["lengths"]=> NULL ["num_rows"]=> int(1) ["type"]=> int(0) }

resultado obtem um objeto ou false caso de falha na query

para acessar o num_rows -> $resultado->num_rows

*/
