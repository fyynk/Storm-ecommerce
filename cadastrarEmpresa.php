<?php 
session_start();

include_once("config/cfg.php");

$empresa = new Empresa();

if(!empty($_POST))
{

	$nome = $_POST["nome"];
	$username = $_POST["usuario"];
	$email = $_POST["email"];
	$email2 = $_POST["email2"];
	$senha = $_POST["senha"];
	$senha2 = $_POST["senha2"];
	
	if ($nome == "") //Validação Nome Vazio
	{
	    $_SESSION['error'][0]='Digite seu nome!';
	    header("Location: cadastroEmpresa.php");
	    exit;
	}

	if ($username == "") //Validação Usuário Vazio
	{
	    $_SESSION['error'][1]='Digite o usuário!';
	    header("Location: cadastroEmpresa.php");
	    exit;
	}

	if ($email == "" or $email2 == "") //Validação Email Vazio
	{
	    $_SESSION['error'][2]='Digite seu email!';
	    header("Location: cadastroEmpresa.php");
	    exit;
	}

	if ($senha == "" or $senha2 == "") //Validação Senha Vazia
	{
	    $_SESSION['error'][3]='Digite sua senha!';
	    header("Location: cadastroEmpresa.php");
	    exit;
	}

	if ($email != $email2) //Validação Diferença de Email
	{
	    $_SESSION['error'][4]='Emails diferentes!';
	    header("Location: cadastroEmpresa.php");
	    exit;
	}

	if ($senha != $senha2) //Validação Diferença de Senha
	{
	    $_SESSION['error'][5]='Senha diferentes!';
	    header("Location: cadastroEmpresa.php");
	    exit;
	}

	if(strlen($senha) < 4 || strlen($senha) > 16)
	{
		$_SESSION['error'][6]='A senha deve ter entre 4 e 16 caracteres!';
		header("Location: cadastroEmpresa.php");
	    exit;
	}

	if(!$empresa->verificarBancoEmpresa($email)) //Verifica se o email já foi utilizado
	{
		$_SESSION['error'][7]='Email já utilizado!';
		header("location: cadastroEmpresa.php");
		exit;
	}

	if(!$empresa->verificarBancoEmpresa2($username)) //Verifica se o usuário já foi utilizado
	{
		$_SESSION['error'][8]='Usuário já utilizado!';
		header("location: cadastroEmpresa.php");
		exit;
	}

	$empresa->inserirEmpresa($nome, $username, $email, $senha); //Insere a empresa no banco
	header("location: index.php"); //Leva para a home

}

 ?>