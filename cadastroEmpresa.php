<?php 
session_start();
if (isset($_SESSION['userid']) || isset($_SESSION['useridEmpresa']))
{
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Storm - Registrar Empresa</title>
	<?php include_once('view/head.php'); ?>
	<link rel="stylesheet" type="text/css" href="css/cadastroEmpresa.css">
</head>
<body>

	<?php include_once('view/header.php'); ?>

	<main>

		<div class="tituloForm cor4"><h1>Registre sua conta de Empresa</h1></div>

		<section class="formulario">

        <div class="row" id="row1">
            <form class="col s12" method="post" action="cadastrarEmpresa.php">

                <div class="row">
                    <div class="input-field col s12">
                        <input id="nome" type="text" class="validate" name="nome">
                        <label for="nome">Nome da empresa</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="username" type="text" class="validate" name="usuario">
                        <label for="username">Usuário</label>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="input-field col s6">
                        <input id="email" type="email" class="validate" name="email">
                        <label for="email">E-mail</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="email2" type="email" class="validate" name="email2">
                        <label for="email2">Insira o e-mail novamente</label>
                    </div>

                </div>

                <div class="row">
                    
                    <div class="input-field col s6">
                        <input id="password" type="password" class="validate" name="senha">
                        <label for="password">Senha</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="password2" type="password" class="validate" name="senha2">
                        <label for="password2">Insira a senha novamente</label>
                    </div>

                </div>

                <div class="row">
                        <div class="input-field col s12">
                            <input type="submit" name="submit" value="Registrar">
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

    <script type="text/javascript" src="js/main.js"></script>

</body>
</html>