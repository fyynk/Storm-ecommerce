<?php 
session_start();

include_once("config/cfg.php");


$nome = $_POST["nome"];
$username = $_POST["usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$nasc = $_POST["dateNasc"];
$sexo = $_POST["sexo"];

$usuario = new Usuario();

if(!$usuario->verificarBanco($email))
{
	header("location: erro.php");
	exit;
}

$usuario->inserirUsuario($nome, $username, $email, $senha, $nasc, $sexo);
header("location: index.php");


 ?>