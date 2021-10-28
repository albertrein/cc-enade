<?php
error_reporting(0);
$objetoJsonRecebido = json_decode($_POST['json'], true);
if(!isset($objetoJsonRecebido['nomeUsuario']) || !isset($objetoJsonRecebido['emailUsuario']) || !is_numeric($objetoJsonRecebido['isProfessor']) || !isset($objetoJsonRecebido['cursoDoUsuario'])){
	header('HTTP/1.0 204 Not Found', true, 204);
	die("#1");
}
if(empty($objetoJsonRecebido['nomeUsuario']) || is_null($objetoJsonRecebido['nomeUsuario']) || ctype_space($objetoJsonRecebido['nomeUsuario'])){
	header('HTTP/1.0 204 Not Found', true, 204);
	die("#1");
}

if(empty($objetoJsonRecebido['emailUsuario']) || is_null($objetoJsonRecebido['emailUsuario']) || ctype_space($objetoJsonRecebido['emailUsuario']) || !strpos($objetoJsonRecebido['emailUsuario'], "@")){
	header('HTTP/1.0 204 Not Found', true, 204);
	die("#1");
}

require '../Model/Usuarios.php';
$usuarioObj = new Usuarios();

$dadosObtidos = $usuarioObj->findUsuarioPeloEmail($objetoJsonRecebido['emailUsuario']);
if($dadosObtidos === false){
	//adiciona usuario
	if($usuarioObj->insereNovoUsuario($objetoJsonRecebido['nomeUsuario'], $objetoJsonRecebido['emailUsuario'], $objetoJsonRecebido['isProfessor'], $objetoJsonRecebido['cursoDoUsuario'])){
		header("HTTP/1.1 200 OK");
		die(NULL);
	}
}

header('HTTP/1.0 204 Not Found', true, 204);
die("#2");