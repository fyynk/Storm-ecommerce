<?php 
session_start();
include_once "config/cfg.php";

if(!empty($_POST))
{
	$username = $_POST["usuario"]; //Setando o usuario
	$pass = $_POST["senha"]; //Setando a senha do usuario
		
	$userLog = new Usuario(); //Utilizando a classe Usuario

	$empresaLog = new Empresa(); //Utilizando a classe Empresa

	if ($username == "") //Validação Username Vazio
	{
	    $_SESSION['error'][0]='Digite seu email!';
	    header("Location: login.php");
	    exit;
	}

	if ($pass == "") //Validação Senha Vazia
	{
	    $_SESSION['error'][1]='Digite sua senha!';
	    header("Location: login.php");
	    exit;
	}

	if($res = $userLog->Login($username, $pass)) //Login de Usuário
	{
		$_SESSION["userid"] = $res;
		header("location: index.php");
		exit;
	}

	if($res = $empresaLog->loginEmpresa($username, $pass)) //Login de Empresa
	{
		$_SESSION["useridEmpresa"] = $res;
		header("location: perfilEmpresa.php?dev=". $res);
		exit;
	}

	//Validação de login incorreto
	$_SESSION['error'][2]='Senha e/ou Email errado!';
	header("location: login.php");
	exit;
	
}


 ?>