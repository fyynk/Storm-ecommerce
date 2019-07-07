<?php 
spl_autoload_register(function($nameClass){
	$dirClass = "Class";
	$filename = $dirClass . DIRECTORY_SEPARATOR . $nameClass . ".php";

	if(file_exists($filename)) {
		require_once($filename);
	}
	else {
		require_once "../".$filename;
	}
});

if(isset($_SESSION['userid'])) {
	Carrinho::sessionCart($_SESSION['userid']);
} else {
	Carrinho::sessionCart();
}


 ?>