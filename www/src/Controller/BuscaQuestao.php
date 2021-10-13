<?php

require '../Model/Questionario.php';
if(!isset($objetoJsonRecebido['curso'])){
	$objetoJsonRecebido['curso'] = "questoes";
} 
$questionario = new Questionario($objetoJsonRecebido['curso']);

$questaoAleatoria = $questionario->buscaQuestao();

if($questaoAleatoria && $questaoAleatoria["questaopk"] !== ""){
	echo json_encode($questaoAleatoria);
	exit();
}

echo json_encode(array("resposta" => "erro"));