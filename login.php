<?php 	

session_start();
include_once 'config/cfg.php';

if(isset($_SESSION["userid"])){
		$_SESSION["userid"] = NULL;
		$_SESSION['cart'] = array();
}elseif(isset($_SESSION["useridEmpresa"])){
		$_SESSION["useridEmpresa"] = NULL;
		$_SESSION['cart'] = array();
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Storm - Login</title>
	<?php include_once('view/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" type="text/css" href="css/materialize.css">
</head>
<body>

	<?php include_once('view/header.php'); ?>

	<main>

		<div class="titulo cor2"><b>Entrar</b></div>

		<article class="boxLogin cor3">
			
			<section class="boxRegistro fl">
				
				<div class="boxIRF">
				<div class="tituloRF"><p>Registrar sua conta</p></div>

				<div class="contRegis"><p>Aqui, você pode criar sua conta, escolhendo ser um desenvolvedor ou usuário comum, aproveitando dos jogos que oferecemos.</p></div>

				<a href="cadastroUsuario.php" class="btnRegistrar">Registrar</a>

				</div>

			</section>

			<div class="content_divider fl"></div>

			<section class="formulario fl">
				
				<div class="boxIRF">
				<div class="tituloRF"><p>Logar com a sua conta</p></div>

				<form class="form1" method="post" action="redirect.php">

                	<div class="row">
	                    <div class="input-field col s12">
	                        <input id="email" type="email" class="validate" name="usuario">
	                        <label for="email">E-mail</label>
	                    </div>
                	</div>

                	<div class="row">
                		<div class="input-field col s12">
                			<input id="password" type="password" class="validate" name="senha">
                        	<label for="password">Senha</label>
                		</div>
                	</div>
                	<div class="row">
                		<div class="input-field col s12">
                			<input type="submit" name="entrar" value="Entrar">
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

			<div class="cls"></div>

		</article>

	</main>

	<?php include_once('view/footer.php'); ?>

	<script type="text/javascript" src="js/main.js"></script>

</body>
</html>