<?php
$objetoJsonRecebido = json_decode($_POST['json'], true);

/*TODO: regex aqui validar entrada*/



require '../Model/Questionario.php';
$questionario = new Questionario();

$retorno = $questionario->buscaResposta($objetoJsonRecebido);

$resposta = mysqli_fetch_assoc($retorno);

if(!$resposta){
	echo json_encode(array("resposta" => "erro"));
	exit();
}
if($resposta['resposta'] === strtoupper($objetoJsonRecebido['respostaUsuario']) && $objetoJsonRecebido['emailUsuario'] != 'visitante'){
	require '../Model/Usuarios.php';
	$usuarioObj = new Usuarios();
	$usuarioObj->atualizaPontuacaoUsuario($objetoJsonRecebido['emailUsuario']);
}

echo json_encode($resposta);
exit();