<?php

require '../Model/Usuarios.php';
$usuarioObj = new Usuarios();

$ranking = $usuarioObj->retornaRanking();
if($ranking === false){
	header('HTTP/1.0 404 Not Found', true, 404);
	die(NULL);	
}

header("HTTP/1.1 200 OK");
$arrayDadosObtidos = array();
while($linhaDados = mysqli_fetch_assoc($ranking)){
	$arrayDadosObtidos[] = $linhaDados;
}

echo json_encode($arrayDadosObtidos);
$usuarioObj->closeConnection();
exit();