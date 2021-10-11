<?php

require '../Model/Questionario.php';
$questionario = new Questionario();

$questaoAleatoria = $questionario->buscaQuestao();

if($questaoAleatoria && $questaoAleatoria["questaopk"] !== ""){
	echo json_encode($questaoAleatoria);
	exit();
}

echo json_encode(array("resposta" => "erro"));