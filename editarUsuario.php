<?php 
session_start();
require_once "config/cfg.php";

if(isset($_SESSION['userid'])) {
	$id = $_SESSION['userid'];
	$user = new Usuario();
} else {
	header('location: index.php');
} 


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edite seu perfil</title>
	<?php include_once('view/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="css/editarPerfil.css">
</head>
<body>
	<?php include_once('view/header.php'); ?>

	<main>
		<section class="formulario">
			<div class="tituloForm cor4"><h1>Edite o perfil da sua empresa</h1></div>
			<div class="row" id="row1">
				<form class="col s12" method="post" action="editandoUsuario.php" enctype="multipart/form-data">
					<div class="row">
						<div class="input-field col s12">
	                        <?php echo '<input id="text" type="text" class="validate" name="nome" value="'.$user->getApelido().'">'?>
	                          <?php echo '<input id="nome" type="hidden" class="validate" name="nomeAtual" value="'.$user->getApelido().'">'?>
	                        <label for="nome">Nome</label>
                    	</div>
					</div>
					    <div class="file-field input-field">
					    	<div class="btn">
					        	<span>Capa</span>
					        	<input type="file" name="capa" accept="image/jpeg">
					      	</div>
					    	<div class="file-path-wrapper">
					        	<input class="file-path validate" type="text">
					      	</div>
					    </div>
					    <div class="file-field input-field">
					    	<div class="btn">
					        	<span>Foto de Perfil</span>
					        	<input type="file" name="perfil" accept="image/jpeg">
					      	</div>
					    	<div class="file-path-wrapper">
					        	<input class="file-path validate" type="text">
					      	</div>
					    </div>
					    <div class="row">
					    	<div>
					    		<p style="padding-left: 15px;">Imagens atuais:</p>
					    		<p style="margin: 0; padding-left: 15px; font-size: 9pt;
					    		opacity: 0.5;">Capa - Mínimo: 800px x 370px;</p>
					    		<p style="margin: 0; padding-left: 15px; margin-bottom: 10px;
					    		font-size: 9pt; opacity: 0.5;">Perfil - Mínimo: 100px x 100px;</p>
					    	</div>
					    </div>
					    <div class="capaFoto">
					    		<?php $user->getWallP($id);  ?>
					    </div>
						<div class="perfilFoto">
								<?php $user->getPhoto($id); ?>
					    </div>
					<div class="row">
                        <div class="input-field col s12">
                            <input type="submit" name="submit" value="Confirmar">
                        </div>
                    </div>

                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="row">
                            <div class="col s12">
                                <div class="alert1">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <?php foreach ($_SESSION['error'] as $key => $value) 
                                    {
                                        echo $value;
                                    } 
                                    $_SESSION['error'] = NULL;
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php endif ?>
				</form>
			</div>
		</section>
	</main>

	<?php include_once('view/footer.php'); ?>
	<script src="js/bootstrap.js"></script>
	<script src="js/materialize.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>