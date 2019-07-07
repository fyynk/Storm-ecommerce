<?php 
session_start();

require_once 'config/cfg.php';

$emp = new Empresa();

$inpTypeGame = trim($_POST['group3']);
$valueGame = trim($_POST['preco']);
$gameName = trim($_POST['nome']);
$descGame = trim($_POST['descJogo']);
if($_POST['tag'] == NULL) {
	$_SESSION['error'][0] = 'Selecione ao menos 1 categoria! ';
	header('location: envioJogo.php');
}
$tag = $_POST['tag'];
$fileGame = $_FILES['fileGame'];
$imgDestaque = $_FILES['imgDestaque'];
$imgFile1 = $_FILES['fileImg1'];
$image2 = $_FILES['image2'];
$imgFile3 = $_FILES['fileImg3'];
$imgFile4 = $_FILES['fileImg4'];

$radTermo = $_POST['radTermo'];



if(!$emp->valueOfGame($inpTypeGame,$valueGame)){
	$valueGame = 0;
}

if($gameName == "") {
	$_SESSION['error'][1] = "Campo do nome do jogo vazio!";
	header('location: envioJogo.php');
	exit;
}

if(strlen($gameName) > 100){
	$_SESSION['error'][2] = 'Quantidade de caracteres não permitido, somente 100 caracteres! <br>';
	header('location: envioJogo.php');
	exit;
}

if($descGame == "") {
	$_SESSION['error'][3] = "Campo da sinopse do jogo vazio!";
	header('location: envioJogo.php');
	exit;
}

if($fileGame['error'] == 4) {
	$_SESSION['error'][4] = 'Não foi inserido o arquivo do jogo, por favor inserir o jogo !';
	header('location: envioJogo.php');
	exit;
}
if($radTermo == 'on') {
	$_SESSION['error'][5] = "É necessario aceitar os termos de uso!";
	header('location: envioJogo.php');
	exit;
}

header('location: jogoEnviado.php');

// $emp->photoGame($imgDestaque);
// $emp->photoGame($imgFile1);
// $emp->photoGame($imgFile2);
// $emp->photoGame($imgFile3);
// $emp->photoGame($imgFile4);



 ?>