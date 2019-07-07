<?php
session_start();
require_once('config/cfg.php');

$empresa2 = new Empresa();

if (!empty($_POST))
{
	//Definindo variáveis pelo método POST
	$nome = trim($_POST["nome"]);
	$desc = trim($_POST["desc"]);
	$capa = $_FILES['capa']['name'];
	$perfil = $_FILES['perfil']['name'];

	//Validação//
	if ($nome == "") //Validação nome empresa vazio
	{
		$_SESSION['error'][0] = 'Digite o nome da empresa!';
		header("Location: editarPerfil.php?dev=".$_SESSION['useridEmpresa']);
		exit;
	}
	if ($desc == "") //Validação descrição empresa vazio
	{
		$_SESSION['error'][1] = 'Digite a descrição da empresa!';
		header("Location: editarPerfil.php?dev=".$_SESSION['useridEmpresa']);
		exit;
	}
	if($capa == NULL) //Validação imagem de capa vazia
	{
		$_SESSION['error'][2] = 'Escolha a imagem de capa da empresa!';
		header("Location: editarPerfil.php?dev=".$_SESSION['useridEmpresa']);
		exit;
	}
	if ($perfil == NULL) //Validação imagem de perfil vazia
	{
		$_SESSION['error'][3] = 'Escolha a imagem de perfil da empresa!';
		header("Location: editarPerfil.php?dev=".$_SESSION['useridEmpresa']);
		exit;
	}

	//Inserções
	if (isset($capa))
	{
		$infoCapa = pathinfo($_FILES['capa']['name']);
		$extCapa = $infoCapa['extension']; // get the extension of the file
		$newnameCapa = $_SESSION["useridEmpresa"].'_1.'.$extCapa; 

		$targetCapa = 'images/devs/'.$newnameCapa;
		move_uploaded_file( $_FILES['capa']['tmp_name'], $targetCapa);
	}

	if (isset($perfil))
	{
		$infoPerfil = pathinfo($_FILES['perfil']['name']);
		$extPerfil = $infoPerfil['extension']; // get the extension of the file
		$newnamePerfil = $_SESSION["useridEmpresa"].'.'.$extPerfil; 

		$targetPerfil = 'images/devs/'.$newnamePerfil;
		move_uploaded_file( $_FILES['perfil']['tmp_name'], $targetPerfil);
	}

	$empresa2->updateEmpresa($nome, $desc, $_SESSION['useridEmpresa']); //ERRO NESSA LINHAAAA

	// var_dump($empresa2);
	// if($stmt->rowCount() > 0)
	// {
 //   		echo 'ocorreram alterações na tabela';
	// } else {
 //   		echo 'nada foi alterado';
	// }
	// var_dump($empresa->updateEmpresa($_SESSION['useridEmpresa'], $nome, $desc));
	// header("Location: perfilEmpresa.php?dev=".$_SESSION['useridEmpresa']);
}