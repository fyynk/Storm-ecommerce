<?php 
session_start();
require_once "config/cfg.php";
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');

if (!isset($_SESSION['userid'])) {
	header('location: index.php');
}
$id = $_SESSION['userid'];
$user = new Usuario();
$user->loadById($id);
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Storm - <?php echo $user->getApelido(); ?></title>
	<?php include_once('view/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="css/perfil.css">
</head>
<body>
	<?php include_once('view/header.php'); 
	$lib = new Biblioteca();
?>
	<main>
		<div class="perfil">
			<div class="perfil--capa">
				<?php $user->getWallP($id); ?>
			</div>

			<div class="perfil--barra">

			<?php  echo	"<a href='editarUsuario.php?u=".$id."'>
					<div class='barra-editarPerfil-btn'>
					Editar perfil
			</div>
			</a>";
			 ?>
			<div class="perfil--foto" style="background-color: #1b384a;">
					<?php $user->getPhoto($id); ?>
			</div>

			<div class="perfil--nome-empresa">
				<p><?=$user->getApelido()?></p>
			</div>

			<form>
				<div class="perfil--desc" style="visibility: hidden;">

				</div>
			</form>
			<div class="perfil--box-jogos" style="width: 63.2%;">
				<div class="perfil--jogos">
					<div class="jogos-coluna">
						<div class="coluna-titulo">
							<p><span>Minha Biblioteca</span></p>
						</div>
						<div style="display: inline-block;">
						<h6>Jogos Disponiveis: </h6>
						<?php $lib->userLib($id, true); ?>
					</div>
						<div>
							<h6  style="margin-top: 20px; float: left; display: block; width: 100%">Aguardando Pagamento: </h6>
							<?php $lib->userLib($id); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="cls"></div>
	</main>
	<div class="cls"></div>
	<?php include_once('view/footer.php'); ?>

</body>
</html>