<?php
error_reporting(0);
$objetoJsonRecebido = json_decode($_POST['json'], true);
if(!isset($objetoJsonRecebido['emailUsuario'])){
	header('HTTP/1.0 404 Not Found', true, 404);
	die(NULL);
}

require '../Model/Usuarios.php';
$usuarioObj = new Usuarios();

$dadosObtidos = $usuarioObj->findUsuarioPeloEmail($objetoJsonRecebido['emailUsuario']);
if($dadosObtidos === false){
	header('HTTP/1.0 404 Not Found', true, 404);
	die(NULL);
}

header("HTTP/1.1 200 OK");
echo json_encode($dadosObtidos);
die(NULL);