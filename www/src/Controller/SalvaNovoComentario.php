<?php 

$objetoJsonRecebido = json_decode($_POST['json'], true);
if(!isset($objetoJsonRecebido['idquestao']) || !isset($objetoJsonRecebido['emailUsuario']) || !isset($objetoJsonRecebido['novaMensagem']) || empty($objetoJsonRecebido['novaMensagem']) || ctype_space($objetoJsonRecebido['novaMensagem'])){
	header('HTTP/1.0 204 Not Found', true, 204);
	die(NULL);
}

include '../Model/Comentarios.php';
$comentarioObj = new Comentarios();
include '../Model/Usuarios.php';
$usuarioObj = new Usuarios();

$pkUsuario = $usuarioObj->retornaPkByUserEmail($objetoJsonRecebido['emailUsuario']);
$objetoJsonRecebido['usuariofk'] = $pkUsuario['usuariopk'];
if($objetoJsonRecebido['usuariofk'] === NULL){
	header('HTTP/1.0 204 Not Found', true, 204);
	die(NULL);
}

if($comentarioObj->insereNovoComentario($objetoJsonRecebido) === false){
	header('HTTP/1.0 204 Not Found', true, 204);
	die(NULL);
}

if(isset($objetoJsonRecebido['duvida'])){
	require '../Model/Questionario.php';
	if(!isset($objetoJsonRecebido['curso']) || $objetoJsonRecebido['curso'] === ""){
		$objetoJsonRecebido['curso'] = "questoes";
	}
	$questionarioObj = new Questionario($objetoJsonRecebido['curso']);
	$questionarioObj->atualizaQuestaoEmAvalicao($objetoJsonRecebido['idquestao'], $objetoJsonRecebido['duvida']);
}

header('HTTP/1.0 200', true, 200);
exit();