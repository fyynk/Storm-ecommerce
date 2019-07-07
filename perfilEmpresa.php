<?php 
session_start();

require_once "config/cfg.php";

if(!isset($_GET["dev"]) || $_GET["dev"] == "" || $_GET["dev"] == 0) {
	header("location: index.php");
	exit;
}

$cd = $_GET['dev'];
$empresa = new Empresa();
if($empresa->loadByIdEmpresa($cd)) {
	$rowEmpresa = $empresa->loadByIdEmpresa($cd);
} else {
	header('location: index.php');
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Storm - <?php echo $rowEmpresa['nm_empresa']; ?></title>
	<?php include_once('view/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="css/perfil.css">
</head>
<body>
	<?php include_once('view/header.php'); ?>

	<main>
		<div class="perfil">
			<div class="perfil--capa">
				<?='<img src="images/devs/'.$cd . '_1.jpg" width="100%"/>'; ?>
			</div>

			<div class="perfil--barra">

			<?php if(isset($_SESSION['useridEmpresa']) && $_SESSION['useridEmpresa'] === $cd):
			
				echo '<a href="editarPerfil.php?dev='.$cd.'">
					<div class="barra-editarPerfil-btn">
						Editar perfil
					</div>
				</a>
				<a href="envioJogo.php">
					<div class="barra-biblioteca-btn">
						Enviar jogo
					</div>
				</a>';
			
			endif; ?>

			</div>
			<div class="perfil--foto">
					<?='<img src="images/devs/'.$cd . '.jpg" width="100%"/>'; ?>
			</div>

			<div class="perfil--nome-empresa">
				<p><?php echo $rowEmpresa['nm_empresa']; ?></p>
			</div>

			<form>
				<div class="perfil--desc">
					<p>
					 <?php echo $rowEmpresa['ds_empresa']; ?>
					</p>
				</div>
			</form>
			<div class="perfil--box-jogos">
				<div class="perfil--jogos">
					<div class="jogos-coluna">
						<div class="coluna-titulo">
							<p>Jogos da <span><?php echo $rowEmpresa['nm_empresa']; ?></span></p>
						</div>

						<?php
						$result = $empresa->getGame($cd);
						if(!empty($result))
						{
							foreach ($result as $key => $value) {
								echo '<a href="jogo.php?c='.$value['cd_jogo'].'">
								<div class="col1de4">
										<div class="imgCol1de4">
											<img src="images/jogos/'.$value['cd_jogo'].'.jpg" width="100%">
										</div>
										<div class="titulo">'.$value['nm_jogo'].'</div>
										<div class="desc">
											<p>'.$value['ds_sinopse'].'</p>
										</div>
								</div>
							</a>';
							}
						}else{
							echo "<div style='color: white;'>Ainda não há jogos adicionados</div>";
						}

						 ?>
					</div>
				</div>
			</div>
		</div>
	<div class="cls"></div>
	</main>

	<?php include_once('view/footer.php'); ?>

</body>
</html>