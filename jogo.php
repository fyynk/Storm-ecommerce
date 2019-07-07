<?php 
session_start();

require_once "config/cfg.php";

if(!isset($_GET["c"]) || $_GET["c"] == "") {
	header("location: index.php");
	exit;
}
$cd = $_GET["c"];
$jogo = new Jogo();
$jogo->loadById($cd);

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Storm - <?=$jogo->get_nm_jogo() ?></title>
		<?php include_once('view/head.php'); ?>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/estiloPaginaAberta.css">
    <link rel="stylesheet" href="css/swiper.min.css">

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  	<script src="js/swiper.min.js"></script>
  	<script src="js/script.js"></script>
</head>

<body>
	 <?php include_once('view/header.php'); ?>
	<main>

		<section class="tituloFlag">
			
			<div class="tituloJogo fl cor3"><?php echo $jogo->get_nm_jogo(); ?></div>

			<div class="flaticonFlag fl cor2"><a href="denuncia.php"><img src="imgs/flaticon/denuncia.png" title="Denunciar Jogo" alt="Denunciar Jogo"></a></div>

			<div class="cls"></div>
		</section>

		<div class="dateLancamento"><p>Publicado em: <?=date("d/m/Y", strtotime($jogo->get_dt_lancamento())); ?></p></div>

			<section class="swiper-container">
				<div class="swiper-wrapper">
					<?php 
					for ($i = 1; $i < 6; $i++) { 
						echo '<div class="swiper-slide"><img src="images/jogos/'.$jogo->get_cd_jogo().'_'.$i.'.jpg"/></div>';
					}
					 ?>
				</div>
			<div class="swiper-pagination cor2"></div>
			<div class="swiper-button-next" id="swp-btn-nxt"></div>
			<div class="swiper-button-prev" id="swp-btn-prv"></div>
		</section>

		<article class="cor3">
			
			<section class="descricaoJogo fl">
				<div class="sinopse fl">
					
					<div class="tituloSinopse"><p>Sinopse</p></div>
					<div class="contSinopse"><p><?=utf8_encode($jogo->get_ds_sinopse()); ?></p>
					</div>


				</div>
			</section>

			<section class="informacaoJogo fl cor5">
				
				<div class="valorJogo fl cor6"><p><?=$jogo->changeFormat();?></p></div>
				
				<?php if(isset($_SESSION["userid"])) {
					$userid = $_SESSION['userid'];
					$jogo->verifyHasGame($userid, $cd);
				}?>
				<?php if(isset($_SESSION["useridEmpresa"])): ?>
					<div class="nComprarJogo fl"><p>Impossível Comprar</p></div>
				<?php elseif (!isset($id)): ?>
					<div class="comprarJogo fl"><a href="login.php"><p>Comprar</p></a></div>
				<?php 	endif ?>

				<div class="boxTag fl">
					
					<div class="imgJogo"><?='<img src="images/jogos/'.$jogo->get_cd_jogo() . '.jpg"'; ?>/></div>

					<div class="tags">

						<div class="categoria cor5">Categorias:</div>

						<?php $tags = $jogo->getTagById($jogo->get_cd_jogo()); 
						foreach ($tags as $key => $tag) {
							echo '<div class="nm_categoria fl">'. $tag .'</div>';
						}
						?>
					<div class="desenvolvedor fl cor5">Desenvolvedor:</div>
						<?php
							$empresa = $jogo->getDeveloper($jogo->get_cd_jogo());
							$apelido_empresa = $jogo->getDevId($jogo->get_cd_jogo());	

							foreach($empresa as $index => $empresas) {
								echo '<div class="nm_desenvolvedor fl"><a href="perfilEmpresa.php?dev=' . $apelido_empresa[$index] . '">' . $empresas . '</a></div>';
							}
						 ?>

						<div class="plataforma fl cor5">Plataformas:</div>
						<?php 
							$plataforma = $jogo->getPlatform($jogo->get_cd_jogo());
							foreach ($plataforma as $key => $value) {
								echo '<div class="nm_plataforma fl">'.$value.'</div>';
							}

						 ?>

					</div>

				</div>

			</section>

			<div class="cls"></div>

		</article>

		<section class="requisito cor3">
			
			<div class="tituloRequisito">Requisitos do Sistema:</div>

				<?php if(null != $jogo->get_ds_requisito_sugerido()):  ?>
				<div class="requisitoMinimo fl cor1">
					<div class="tituloMinimo"><p><b>Mínimo:</b></p></div>
				<div class="contMinimo">
					<p>
					<?php echo $jogo->get_ds_requisito_minimo(); ?>
					</p>
				</div>
			</div>
				<div class="requisitoSugerido fl cor2">
					<div class="tituloSugerido"><p><b>Sugerido:</b></p></div>
				<div class="contSugerido">
					<p>
						<?php echo $jogo->get_ds_requisito_sugerido(); ?>
					</p>
				</div>
			<?php else: ?>
			<div class="requisitoMinimo minimoTodo fl cor1">
				<div class="tituloMinimo"><p><b>Mínimo:</b></p></div>
		<div class="requisitoMinimo fl cor2">
				<div class="contMinimo">
					<p>
					<?php echo $jogo->get_ds_requisito_minimo(); ?>
					</p>
				</div>
				<?php endif ?>

			</div>
			<div class="cls"></div>


		</section>

		
	</main>

	<?php include_once('view/footer.php'); ?>

</body>
</html>
