<?php
session_start();
require_once '../config/cfg.php';

$tag = $_POST['categoria'];

$jogo = new Jogo();



if(isset($_SESSION['userid'])) {
	$jogo->getCatalogByTag($tag,'%%' , $_SESSION['userid']);
}
else {
	$jogo->getCatalogByTag($tag);
}





 ?>