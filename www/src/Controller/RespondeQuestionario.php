<?php
error_reporting(0);
$objetoJsonRecebido = json_decode($_POST['json'], true);

require '../Model/Questionario.php';
if(!isset($objetoJsonRecebido['curso']) || $objetoJsonRecebido['curso'] === ""){
	$objetoJsonRecebido['curso'] = "questoes";
}
$questionario = new Questionario($objetoJsonRecebido['curso']);

$retorno = $questionario->buscaResposta($objetoJsonRecebido);

$resposta = mysqli_fetch_assoc($retorno);

if(!$resposta){
	echo json_encode(array("resposta" => "erro"));
	exit();
}
if($resposta['resposta'] === strtoupper($objetoJsonRecebido['respostaUsuario'])){
	if($objetoJsonRecebido['emailUsuario'] != 'visitante'){
		require '../Model/Usuarios.php';
		$usuarioObj = new Usuarios();
		$usuarioObj->atualizaPontuacaoUsuario($objetoJsonRecebido['emailUsuario']);
	}
	$questionario->atualizaAcertosDaQuestao($objetoJsonRecebido);
}else{
	$questionario->atualizaErrosDaQuestao($objetoJsonRecebido);
}

echo json_encode($resposta);
exit();