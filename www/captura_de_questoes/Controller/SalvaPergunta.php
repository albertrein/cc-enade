<?php
echo "<center>";
echo "<h4>Dados Recebidos:<h4><br>";
echo "<h5>".$_POST["resposta"]."</h5><br/>";
echo "<h5>".$_POST["ano_prova"]."</h5><br/>";
echo "<h5>".$_POST["nrquestao"]."</h5><br/>";
echo "<button style='font-size: 20px;' onclick=' window.location.href = \"../\"; '>Voltar para o cadastro</button>";
echo "</center>";

if(!isset($_FILES['imagem']['name'])){
	die('<h1>REFAZER -> Imagem não informada</h1>');
}

//die(var_dump($_POST));
require '../Model/CadastroPerguntas.php';
$cadastroPerguntalModel = new CadastroPerguntas($_POST['curso']);

if($retorno = $cadastroPerguntalModel->salvarPergunta($_POST)){
	$retorno =  mysqli_fetch_assoc($retorno)["id"];

	$extensaoArquivo = explode(".",$_FILES['imagem']['name']);

	move_uploaded_file($_FILES['imagem']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/imagens_questoes/tads/'.$retorno.".".$extensaoArquivo[1]);

	die('Salvo!');
}

die('<h1>Erro.</h1>');
