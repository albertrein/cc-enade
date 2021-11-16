<?php
error_reporting(0);
$objetoJsonRecebido = json_decode($_POST['json'], true);
if(!isset($objetoJsonRecebido['numeroquestao'])){
	die(NULL);
}

require '../Model/Questionario.php';
if(!isset($objetoJsonRecebido['curso']) || $objetoJsonRecebido['curso'] === ""){
	$objetoJsonRecebido['curso'] = "questoes";
} 
$questionarioObj = new Questionario($objetoJsonRecebido['curso']);

$resultadoQuery = $questionarioObj->buscaListaQuestoes($objetoJsonRecebido['numeroquestao']);
if($resultadoQuery->num_rows == 0 or $resultadoQuery == false){
	header('HTTP/1.0 204 Not Found', true, 204);
	$questionarioObj->closeConnection();
	die(NULL);
}

$arrayDadosObtidos = array();
while($linhaDados = mysqli_fetch_assoc($resultadoQuery)){
	$arrayDadosObtidos[] = $linhaDados;
}

echo json_encode($arrayDadosObtidos);
$questionarioObj->closeConnection();
