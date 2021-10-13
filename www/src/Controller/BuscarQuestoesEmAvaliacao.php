<?php

require '../Model/Questionario.php';
if(!isset($objetoJsonRecebido['curso'])){
	$objetoJsonRecebido['curso'] = "questoes";
}
$questionarioObj = new Questionario($objetoJsonRecebido['curso']);

$questoesParaAvaliacao = $questionarioObj->buscaQuestoesEmAvaliacoes();

if(!$questoesParaAvaliacao){
	header('HTTP/1.0 204 Not Found', true, 204);
	exit();
}

$arrayDadosObtidos = array();
while($linhaDados = mysqli_fetch_assoc($questoesParaAvaliacao)){
	$arrayDadosObtidos[] = $linhaDados;
}

echo json_encode($arrayDadosObtidos);
$questionarioObj->closeConnection();
exit();