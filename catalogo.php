<?php
session_start();
require_once "config/cfg.php";
$pagina = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
$jogo = new Jogo();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Storm - Jogos</title>
	<?php include_once('view/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="css/jogos.css">
</head>
<body>

	<?php include_once('view/header.php'); ?>

	<main>

		<div class="fontCat cor1"><p>Jogos</p></div>
		<section>
			<form class="formulario col s12" method="post" action="">
				<div class="row">
					<input type="hidden" value="<?=$pagina?>" name="page">
					<div class="input-field col s7">
		            	<input type="search" name="campo" id="campo" placeholder="Digite o nome do jogo..." required
		            	style="margin-top: -4px;">
		            	<input type="submit" name="btnSearch" id="btnSearch" style="display: none;">
		                <label for="jogo">Procure o jogo</label>
		            </div>
					<div class="input-field col s5">
	                    <select class="custom-select custom-select-sm mb-3"
	                    id="categoria" name="categoria" style="font-size: 10.5pt;">
	                        <option value="-1" style="font-size: 10.5pt;" selected>----------------</option>
	                        <option value="3" style="font-size: 10.5pt;">Aventura</option>
	                        <option value="1" style="font-size: 10.5pt;">Ação</option>
	                        <option value="4" style="font-size: 10.5pt;">Drama</option>
	                        <option value="2" style="font-size: 10.5pt;">Terror</option>
	                        <option value="5" style="font-size: 10.5pt;">RPG</option>
	                    </select>
	                    <label for="categoria" id="categoriaTitulo">Categorias</label>
	                </div>
				</div>
			</form>
		</section>


		<div class="content_divider"></div>

		<section class="catalogoReal">
			
<!-- 			<div class="col1Titulo">
				<div class="estiloTitulo">Mais recentes</div>
			</div> -->
			<div id="itemCatalogo">	
				<?php 

				if(isset($_GET['t'])){
					$tag = $_GET['t'];
					if(isset($_SESSION['userid'])) {
						$jogo->getCatalogByTag($tag, $id);
					} else {
						$jogo->getCatalogByTag($tag);
					}
				} else {
					if(isset($_SESSION['userid'])) {
						$jogo->catalogGame($pagina,"%%" , $id);
					} else {
						$jogo->catalogGame($pagina,"%%");
					}
				}


    			?>
		</div>

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
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/ajax.js"></script>
	<?php include_once('view/footer.php'); ?>
	
</body>
</html>