<?php 	
session_start();
require_once '../config/cfg.php';

$campo = "%". $_POST['campo'] . "%";

$page = $_POST['page'];

$categoria = $_POST['categoria'];

$jogo = new Jogo();


if(isset($_SESSION['userid'])) {
	$jogo->catalogGame(1, $campo,$_SESSION['userid'], true);
} else {
	$jogo->catalogGame(1, $campo, NULL, true);
}


 ?>