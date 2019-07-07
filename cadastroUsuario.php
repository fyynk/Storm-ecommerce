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
    <title>Storm - Cadastro Usuário</title>
    <?php include_once('view/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/cadastroUsuario.css">
    <script src="js/main.js"></script>
</head>
<body>

    <?php include_once('view/header.php'); ?>

    <main>

        <div class="tituloForm cor4"><h1>Crie sua conta</h1></div>

        <section class="formulario">

            <div class="row" id="row1">
            <form class="col s12" method="post" action="cadastrarUsuario.php">

                <div class="row">
                    <div class="input-field col s12">
                        <input id="nomeCompleto" type="text" class="validate" name="nome">
                        <label for="nomeCompleto">Nome Completo</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="usuario" type="text" class="validate" name="usuario">
                        <label for="usuario">Usuario</label>
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
                        <input id="senha" type="password" class="validate" name="senha" maxlength="16">
                        <label for="senha">Senha</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="senha2" type="password" class="validate" name="senha2" maxlength="16">
                        <label for="senha2">Insira a senha novamente</label>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="dateNasc" type="date" class="validate" name="dateNasc">
                        <label for="dateNasc">Data de Nascimento</label>
                    </div>

                    <div class="input-field col s6">
                        <select name="sexo" class="custom-select custom-select-sm mb-3">
                            <option value="" disabled selected>Selecione seu Sexo</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="O">Outro</option>
                        </select>
                        <label for="sexo" id="sexo">Sexo</label>
                    </div>
                </div>

                <input type="submit" name="submit" value="Registrar" />

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

    <?php include_once('view/footer.php') ?>

    <script type="text/javascript" src="js/main.js"></script>

</body>
</html>