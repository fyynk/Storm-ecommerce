<?php 
session_start();
require_once 'config/cfg.php';
$user = new Usuario();
$id = $_SESSION['userid'];

if($_POST) {
	$nmAtual = trim($_POST['nomeAtual']);
	$nome = trim($_POST['nome']);
	$capa = $_FILES['capa'];
	$perfil = $_FILES['perfil'];

	if($nome != $nmAtual) {
		$user->changeName($nome, $id);
	}


	if($capa['error'] != 4){
		$user->changePhoto($capa, $id, 'capa');
	}

	if($perfil['error'] != 4) {
		$user->changePhoto($perfil, $id, 'perfil');
	}

	header('location:perfil.php');

}




 ?>