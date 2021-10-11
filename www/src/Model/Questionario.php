<?php

use Model\DatabaseConnection\MySqlConnection;

require_once('DatabaseConnection/MysqlConnection.php');

class Questionario extends MySqlConnection{
	private $conn;

	function __construct(){
		parent::__construct();
		$this->conn = parent::getConnection();
		return false;
	}

	function closeConnection(){
		mysqli_close($this->conn);
	}

	function buscaResposta($dados){
		$sql = "SELECT resposta from questoes WHERE ano = ".$dados['ano']. " AND  nrquestao = ".$dados['nrquestao'];
		$resultado = $this->conn->query($sql);
		if($resultado->num_rows == 1){
			return $resultado;
		}
		return false;
	}

	function buscaQuestao(){
		$ultimoPk = $this->getUltimoIdInserido();
		
		while(true){
			$questaoAleatoria = $this->conn->query("SELECT questaopk, ano, nrquestao, duvida from questoes WHERE questaopk = ".rand(0,$ultimoPk));
			$dados = mysqli_fetch_assoc($questaoAleatoria);
			if($dados === NULL){
				continue;
			}
			return $dados;
		}
	}

	function getUltimoIdInserido(){
		$lastPk = $this->conn->query("select questaopk from questoes order by questaopk DESC LIMIT 1;");
		return mysqli_fetch_assoc($lastPk)['questaopk'];
	}

	function retornaUltimoIdRegistrado(){
		return $this->conn->query('SELECT MAX(questaopk) as id FROM questoes;');
	}

	function buscaListaQuestoes($numeroQuestao){
		$handler = $this->conn->prepare('SELECT questaopk, ano, nrquestao, duvida FROM questoes WHERE nrquestao = ?');
		$handler->bind_param('i', $numeroQuestao);
		if(!$handler->execute()){
			return false;
		}
		return $handler->get_result();
	}

	function requisitarAjuda($idQuestao){
		$sql = "UPDATE questoes SET duvida = 1 WHERE questaopk=".$idQuestao;
		$this->conn->query($sql);
		return true;
	}

	function buscaQuestoesEmAvaliacoes(){
		$sql = "SELECT questaopk, ano, nrquestao, duvida FROM questoes WHERE duvida = 1";
		$resultado = $this->conn->query($sql);
		if($resultado->num_rows > 0){
			return $resultado;
		}
		return false;
	}

	function atualizaQuestaoEmAvalicao($idQuestao, $duvida){
		$sql = "UPDATE questoes SET duvida = ".$duvida." WHERE questaopk=".$idQuestao;
		$this->conn->query($sql);
		return true;
	}

}

/*
$resultado = $this->conn->query($query) -> executa a query
object(mysqli_result)#3 (5) { ["current_field"]=> int(0) ["field_count"]=> int(1) ["lengths"]=> NULL ["num_rows"]=> int(1) ["type"]=> int(0) }

resultado obtem um objeto ou false caso de falha na query

para acessar o num_rows -> $resultado->num_rows

*/
