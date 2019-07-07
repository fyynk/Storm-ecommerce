<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Storm - Sobre</title>
    <?php include_once('view/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/sobre.css">
</head>
<body>

    <?php include_once('view/header.php') ?>

    <main>
        <div class="main--box-sobre">
            <div class="box-sobre-img_1">
                <img src="images/sobre/printDestaque.png" width="100%">
            </div>
            <div class="box-sobre-cont">
                <div class="sobre-cont-titulo">
                    <p>Sobre a Storm</p>
                </div>
                <div class="sobre-cont-desc">
                    <p style="padding-left: 30px; padding-right: 30px;">A Storm é uma plataforma de jogos indies, de navegação simples, onde os desenvolvedores podem os publicar por um preço acessível, como preferir em relação as suas características.<br>
                    Caso seja um <span style="font-weight: bold;">desenvolvedor</span> e nos envie o seu jogo, o avaliaremos de acordo com todos os requisitos e ele será colocado no site com nenhum problema</p>

                    <p style="font-weight: bold; text-align: center; font-size: 10.5pt;">Gostou da Storm e ainda não se registrou em nosso site? Bem, agora é sua chance</p>
                </div>
                <div class="sobre-cont-linkBtn">
                    <a href="cadastroUsuario.php">
                        <div class="sobre-cont-btn">
                            <p>Cadastre-se agora!</p>
                        </div>
                    </a>
                </div>
                <div class="sobre-cont-desc">
                    <p style="font-weight: bold; text-align: center; font-size: 10.5pt;">Caso queira entrar em contato conosco, clique aqui:</p>
                </div>
                <div class="sobre-cont-linkBtn">
                    <a href="contato.php">
                        <div class="sobre-cont-btn">
                            <p>Entre em contato com a Storm</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="cls"></div>
    </main>

    <?php include_once('view/footer.php') ?>

</body>
</html>