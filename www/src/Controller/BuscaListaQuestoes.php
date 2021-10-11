<?php

$objetoJsonRecebido = json_decode($_POST['json'], true);
if(!isset($objetoJsonRecebido['numeroquestao'])){
	die(NULL);
}

require '../Model/Questionario.php';
$questionarioObj = new Questionario();

$resultadoQuery = $questionarioObj->buscaListaQuestoes($objetoJsonRecebido['numeroquestao']);
if($resultadoQuery->num_rows == 0 or $resultadoQuery == false){
	header('HTTP/1.0 204 Not Found', true, 204);
	die(NULL);
}

$arrayDadosObtidos = array();
while($linhaDados = mysqli_fetch_assoc($resultadoQuery)){
	$arrayDadosObtidos[] = $linhaDados;
}

echo json_encode($arrayDadosObtidos);
$questionarioObj->closeConnection();
