<?php 	
session_start();
require_once("config/cfg.php");
if(isset($_SESSION["userid"])) {
    $id = $_SESSION["userid"];
}else {
    unset($id);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Storm - Home</title>
	<?php include_once('view/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" href="css/swiper.min.css">
 	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  	<script src="js/swiper.min.js"></script>
  	<script src="js/scriptHome.js"></script>
</head>

<body>
		<?php include_once('view/header.php'); ?>

	<main>
<section class="swiper-container">
				<div class="swiper-wrapper">
					 <?php 
					 $jogo = new Jogo();	
					 $result = $jogo->loadSpotlight();
					 foreach ($result as $key => $value) {
					 	echo '<div class="swiper-slide">
					 			<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
					 				<img src="images/jogos/'.$value["cd_jogo"].'_hd.jpg"/>
					 				<div class="text-block text-block--nome"> 
									    <h5>'.$value['nm_jogo'].'</h5>
								    </div>
								    <div class="text-block text-block--valor"> 
									    <p>R$'. " " . number_format($value["vl_jogo"],2,',','.') .'</p>
								    </div>
				 				</a>
			 				  </div>';
					 }
					  ?>
				</div>
			<div class="swiper-pagination cor2"></div>
			<div id="swp-btn-nxt" class="swiper-button-next"></div>
			<div id="swp-btn-prv" class="swiper-button-prev"></div>
		</section>
		<div class="content_divider"></div>

		<section class="maisJogado">

		<div class="col1Titulo">
			<div class="estiloTitulo">Recentemente Adicionadas</div>
		</div>

			<?php 
				$jogo = new Jogo();
				if(isset($id) && isset($_SESSION['userid'])) {
					$jogo->getRecent($id);
				} else {
					$jogo->getRecent();
				}
			 ?>

	</section>

		<div class="cls"></div>

		<section class="categoriaJogo">
			<div class="col1Titulo">
				<div class="estiloTitulo">Ação</div>
					<a href="catalogo.php?t=1">
						<div class="estiloTitulo_Mais">Ver mais</div>
					</a>
				</div>
				<?php 
				$jogo = new Jogo();
					if(isset($id) && isset($_SESSION['userid'])) {
						$jogo->loadInitialPage(1, $id);
					} else {
						$jogo->loadInitialPage(1);
					}
				 ?>
		<div class="cls"></div>
	</section>

		<section class="categoriaJogo">
			<div class="col1Titulo">
				<div class="estiloTitulo">Aventura</div>
				<a href="catalogo.php?t=3">
					<div class="estiloTitulo_Mais">Ver mais</div>
				</a>
			</div>
			<?php 
				$jogo = new Jogo();
				if(isset($id) && isset($_SESSION['userid'])) {
					$jogo->loadInitialPage(3, $id);
				} else {
					$jogo->loadInitialPage(3);
				}
				 ?>
		<div class="cls"></div>
		</section>

		<section class="categoriaJogo">
			<div class="col1Titulo">
				<div class="estiloTitulo">RPG</div>
				<a href="catalogo.php?t=4">
					<div class="estiloTitulo_Mais">Ver mais</div>
				</a>
			</div>
			<?php 
				if(isset($id) && isset($_SESSION['userid'])) {
				$jogo->loadInitialPage(4, $id);
				} else {
				$jogo->loadInitialPage(4);
				}
				 ?>
		<div class="cls"></div>
		</section>

		<section class="categoriaJogo">
			<div class="col1Titulo">
				<div class="estiloTitulo">Terror</div>
				<a href="catalogo.php?t=2">
					<div class="estiloTitulo_Mais">Ver mais</div>
				</a>
			</div>
			<?php 
				
				if(isset($id) && isset($_SESSION['userid'])) {
					$jogo->loadInitialPage(2, $id);
				}else {
					$jogo->loadInitialPage(2);
				}
				 ?>
				
				
		<div class="cls"></div>
		</section>

	</main>

	<div id="snackbar">Adicionado ao carrinho com sucesso!</div>
	
	<script>
	function myFunction() {
	  var x = document.getElementById("snackbar");
	  x.className = "show";
	  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	}
	</script>
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>

		<?php include_once('view/footer.php'); ?>
</body>
</html>

<!-- https://comunidade.pagseguro.uol.com.br/hc/pt-br/community/posts/220750288-Notifica%C3%A7%C3%B5es-Locais -->