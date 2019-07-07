<?php 
session_start();

require_once '../config/cfg.php';



if(isset($_SESSION['userid'])) {
	$game = $_GET['id'];
	$userid = $_SESSION['userid'];
	$cart = new Carrinho();
	$cart->insertCart($userid, $game);

}

 ?>
