<?php 
session_start();
require_once 'config/cfg.php';

$lib = new Biblioteca();
$cart = new Carrinho();

if(isset($_POST)) {
	if(isset($_SESSION['userid'])) {
		$id = $_SESSION['userid'];
			$lib->changeStatus($id);

	}
}
// if(isset($_SESSION['userid'])) {
// 	$id = $_SESSION['userid'];
// 	if(isset($_POST['btnLiberar'])){
// 		$lib = new Biblioteca();
// 		$lib->changeStatus($id);
// 		echo "Jogos Liberados!";
// 	}
// }else {
// 	header("location: index.php");
// }
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Status</title>
</head>
<body>
	<form method="post" action="">
		<input type="submit" id="btnLiberar" name="btnLiberar" value="Liberar Jogo">
		<span id="lblReposta" name="lblReposta"></span>
	</form>
</body>
</html>


