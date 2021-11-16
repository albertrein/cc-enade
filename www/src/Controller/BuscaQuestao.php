<?php
error_reporting(0);
$objetoJsonRecebido = json_decode($_POST['json'], true);

require '../Model/Questionario.php';
if(!isset($objetoJsonRecebido['curso']) || $objetoJsonRecebido['curso'] === ""){
	$objetoJsonRecebido['curso'] = "questoes";
} 
$questionario = new Questionario($objetoJsonRecebido['curso']);

$questaoAleatoria = $questionario->buscaQuestao();

if($questaoAleatoria && $questaoAleatoria["questaopk"] !== ""){
	echo json_encode($questaoAleatoria);
	$questionario->closeConnection();
	exit();
}

echo json_encode(array("resposta" => "erro"));

$questionario->closeConnection();