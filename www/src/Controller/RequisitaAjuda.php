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

$questionarioObj->requisitarAjuda($objetoJsonRecebido['numeroquestao']);
$questionarioObj->closeConnection();
exit();