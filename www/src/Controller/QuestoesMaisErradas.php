<?php

require '../Model/Questionario.php';
error_reporting(0);
if(!isset($objetoJsonRecebido['curso']) || $objetoJsonRecebido['curso'] === ""){
	$objetoJsonRecebido['curso'] = "cc";
}

$questionarioObj = new Questionario($objetoJsonRecebido['curso']);

$response = $questionarioObj->retornaQuestoesMaisErradas();

if($response === false){
	header('HTTP/1.0 204 Not Found', true, 204);
	$questionarioObj->closeConnection();
	exit();
}

header("HTTP/1.1 200 OK");
$arrayDadosObtidos = array();
while($linhaDados = mysqli_fetch_assoc($response)){
	$arrayDadosObtidos[] = $linhaDados;
}

echo json_encode($arrayDadosObtidos);
$questionarioObj->closeConnection();
exit();