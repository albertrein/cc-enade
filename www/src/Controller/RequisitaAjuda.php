<?php

$objetoJsonRecebido = json_decode($_POST['json'], true);
if(!isset($objetoJsonRecebido['numeroquestao'])){
	die(NULL);
}

require '../Model/Questionario.php';
$questionarioObj = new Questionario();

$questionarioObj->requisitarAjuda($objetoJsonRecebido['numeroquestao']);

exit();