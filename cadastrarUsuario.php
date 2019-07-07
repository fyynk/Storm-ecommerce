<?php 
session_start();

include_once("config/cfg.php");

$usuario = new Usuario();

function test_input($dataCadast)
    //Função para resetar os espaços(trim), Strip caracteres desnecessários(stripslashes), Prevenir attackers from exploiting the code by injecting HTML or JS(htmlspecialchars)
    {
        $dataCadast = trim($dataCadast);
        $dataCadast = stripslashes($dataCadast);
        $dataCadast = htmlspecialchars($dataCadast);
        return $dataCadast;
    }

if(!empty($_POST))
{

	$nome = test_input($_POST["nome"]);
	$username = test_input($_POST["usuario"]);
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$nasc = test_input($_POST["dateNasc"]);
	if(isset($_POST['sexo'])){ $sexo = $_POST["sexo"]; }
	$email2 = $_POST["email2"];
	$senha2 = $_POST["senha2"];
	
	if ($nome == "") //Validação Nome Vazio
	{
	    $_SESSION['error'][0]='Digite seu nome!';
	    header("Location: cadastroUsuario.php");
	    exit;
	}

	if ($username == "") //Validação Usuário Vazio
	{
	    $_SESSION['error'][1]='Digite o usuário!';
	    header("Location: cadastroUsuario.php");
	    exit;
	}

	if ($email == "" or $email2 == "") //Validação Email Vazio
	{
	    $_SESSION['error'][2]='Digite seu email!';
	    header("Location: cadastroUsuario.php");
	    exit;
	}

	if ($senha == "" or $senha2 == "") //Validação Senha Vazia
	{
	    $_SESSION['error'][3]='Digite sua senha!';
	    header("Location: cadastroUsuario.php");
	    exit;
	}

	if ($nasc == "") //Validação Data de nascimento Vazia
	{
	    $_SESSION['error'][4]='Digite sua data de nascimento!';
	    header("Location: cadastroUsuario.php");
	    exit;
	}

	if (isset($sexo) == "") //Validação Sexo Vazia
	{
	    $_SESSION['error'][5]='Escolha seu sexo!';
	    header("Location: cadastroUsuario.php");
	    exit;
	}

	if ($email != $email2) //Validação Diferença de Email
	{
	    $_SESSION['error'][6]='Emails diferentes!';
	    header("Location: cadastroUsuario.php");
	    exit;
	}

	if ($senha != $senha2) //Validação Diferença de Senha
	{
	    $_SESSION['error'][7]='Senha diferentes!';
	    header("Location: cadastroUsuario.php");
	    exit;
	}

	if(strlen($senha) < 4 || strlen($senha) > 16)
	{
		$_SESSION['error'][8]='A senha deve ter entre 4 e 16 caracteres!';
		header("Location: cadastroUsuario.php");
	    exit;
	}

	if(!$usuario->verificarBanco($email)) //Verifica se o email já foi utilizado
	{
		$_SESSION['error'][9]='Email já utilizado!';
		header("location: cadastroUsuario.php");
		exit;
	}

	if(!$usuario->verificarBanco($username)) //Verifica se o nome de usuário já foi utilizado
	{
		$_SESSION['error'][10]='Usuário já utilizado!';
		header("location: cadastroUsuario.php");
		exit;
	}

	$usuario->inserirUsuario($nome, $username, $email, $senha, $nasc, $sexo); //Insere o usuario no banco
	header("location: index.php"); //Leva para a home

}

 ?>