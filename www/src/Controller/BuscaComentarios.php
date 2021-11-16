<?php
error_reporting(0);
$objetoJsonRecebido = json_decode($_POST['json'], true);
if(!isset($objetoJsonRecebido['idquestao'])){
	die(NULL);
}

require '../Model/Comentarios.php';
$comentarioObj = new Comentarios();

if($comentarioObj->questaoPossuiComentarios($objetoJsonRecebido['idquestao']) === false){
	header('HTTP/1.0 404 Not Found', true, 404);
	die(NULL);
}

$dadosObtidos = $comentarioObj->buscaComentarios($objetoJsonRecebido['idquestao']);
if(!$dadosObtidos){
	header('HTTP/1.0 404 Not Found', true, 404);
	die(NULL);
}

$mensagens = array();
while($dado = mysqli_fetch_assoc($dadosObtidos)){
	$mensagens[] = array("mensagem"=>$dado['mensagem'], "nomeUsuario" => $dado["nomeUsuario"]);
}

echo json_encode($mensagens);
$comentarioObj->closeConnection();
exit();

