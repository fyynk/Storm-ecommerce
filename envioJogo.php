<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once 'view/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="css/envioJogo.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.css">
	<script src="js/materialize.js"></script>
	<script src="js/bootstrap.js"></script>
	<meta charset="utf-8">
</head>
<body>
	<?php require_once 'view/header.php'; ?>
	<main>
		<div class="envioJogo--box">
			<form method="post" action="enviarJogo.php" enctype="multipart/form-data">
				<div class="box-1">
					<p class="tituloEnvieSeuJogo">Envie o seu jogo</p>
					<p class="p_radio">
					    <label>
					      	<input class="with-gap" name="group3" value="gratis" type="radio" checked="checked" id="gratis" />
					      	<span style="font-size: 9.5pt; padding-top: 3px;">Grátis</span>
						</label>
					</p>
				    <p class="p_radio">
						<label>
						    <input class="with-gap precoJogoRadio" value="pago" id='pago' name="group3" type="radio"/>
						    <span style="font-size: 9.5pt; padding-top: 3px;">Pago</span>
						    <div class="row precoJogo">
								<div class="input-field col s4" style="display: none;" id="boxPreco">
	                        		<input id="preco" type="text" class="validate" name="preco">
	                        		<label for="preco" style="font-size: 10.5pt;">Preço</label>
                    			</div>
						  	</div>
					    </label>
					</p>
				</div>
				<div class="box-2">
					<p class="tituloCaracteristicasJogos">Características do seu jogo</p>
					<div class="box-2-cont">
						<div class="row">
							<div class="input-field col s12">
	                        	<input id="tituloJogo" type="text" class="validate" name="nome">
	                        	<label for="tituloJogo" style="font-size: 10.5pt;">Título</label>
                    		</div>
						</div>
						<div class="row">
        					<div class="input-field col s12">
          						<textarea id="descEmpresa" class="materialize-textarea" name="descJogo" style="color: #e8efff;"></textarea>
          						<label for="descEmpresa" style="font-size: 10.5pt;">Sinopse</label>
        					</div>
      					</div>
						<br>
						<p class="tituloCategorias">Categorias</p>
						<p>
      						<label>
        						<input type="checkbox" name="tag[]" value="3" class="filled-in" checked="checked" />
        						<span style="font-size: 10.5pt;">Aventura</span>
      						</label>
    					</p>
    					<p>
      						<label>
        						<input type="checkbox" name="tag[]" value="1" class="filled-in" checked="checked" />
        						<span style="font-size: 10.5pt;">Ação</span>
      						</label>
    					</p>
    					<p>
      						<label>
        						<input type="checkbox" name="tag[]" value="4" class="filled-in"  checked="checked" />
        						<span style="font-size: 10.5pt;">Drama</span>
      						</label>
    					</p>
    					<p>
      						<label>
        						<input type="checkbox" name="tag[]" value="5" class="filled-in" checked="checked" />
        						<span style="font-size: 10.5pt;">RPG</span>
      						</label>
    					</p>
    					<p>
      						<label>
        						<input type="checkbox" name="tag[]" value="2" class="filled-in" checked="checked" />
        						<span style="font-size: 10.5pt;">Terror</span>
      						</label>
    					</p>
						<br>
						<p class="tituloAnexo">Anexo do seu jogo</p>
						<div class="file-field input-field">
      						<div class="btn">
        					<span>Anexo</span>
        						<input type="file" name="fileGame" placeholder="Envie o anexo do seu jogo...">
      						</div>
      						<div class="file-path-wrapper">
        						<input class="file-path validate" type="text">
      						</div>
    					</div>
					</div>
				</div>
				<div class="box-3">
					<p class="tituloMidia">Mídia</p>
					<label>Imagem de destaque
						<div class="imgDestaque" id="boxDestaque">
							<img src="#">
						</div>
						<div for="imgDestaque" class="divFileImg" style="margin-top: 4px;">
							<div class="uploadIcon" style="width: 16px; height: 16px; float: left;">
								<img src="imgs/iconUpload.png" style="width: 100%; height: 100%">
							</div>
							<p style="float: left; margin-left: 4px; margin-top: 0px;">Escolha um arquivo...</p>
						</div>
						<input type="file" name="imgDestaque" id="imgDestaque" style="display: none;">
						<input type="submit" name="enviarImg" class="enviarImgBtn" style="float: left;
						width: 212px; margin-left: 1px; margin-top: 4px;">
					</label>
						<br>
					<label>
						<br>
						<br>
						<p style="margin-top: -6px; margin-bottom: -3px;">Outras imagens</p>

						<div class="maisImagens" style="float: left;">
							<div class="maisImagens-img">
								<img src="#" width="100%" style="width: 100%; height: 100%;">
							</div>
							<div for="fileImg" class="divFileImg">
								<div class="uploadIcon" style="width: 16px; height: 16px; float: left;">
									<img src="imgs/iconUpload.png" style="width: 100%; height: 100%">
								</div>
								<p style="float: left; margin-left: 4px; margin-top: 0px;">Escolha um arquivo...</p>
							</div>
							<input type="file" id="fileImg" name="fileImg1" style="width: 210px; padding: 7px; display: none;">
							<input type="submit" name="enviarImg" class="enviarImgBtn">
						</div>


						<div class="maisImagens" style="float: left;">
							<div class="maisImagens-img">
								<img src="#" width="100%" style="width: 100%; height: 100%;">
							</div>
							<div for="fileImg" class="divFileImg">
								<div class="uploadIcon" style="width: 16px; height: 16px; float: left;">
									<img src="imgs/iconUpload.png" style="width: 100%; height: 100%">
								</div>
								<p style="float: left; margin-left: 4px; margin-top: 0px;">Escolha um arquivo...</p>
							</div>
							<input type="file" name="image2"  style="width: 210px; padding: 7px; display: none;">
							<input type="submit" name="enviarImg" class="enviarImgBtn">
						</div>


						<div class="maisImagens" style="float: left;">
							<div class="maisImagens-img">
								<img src="#" width="100%" style="width: 100%; height: 100%;">
							</div>
							<div for="fileImg" class="divFileImg">
								<div class="uploadIcon" style="width: 16px; height: 16px; float: left;">
									<img src="imgs/iconUpload.png"" style="width: 100%; height: 100%">
								</div>
								<p style="float: left; margin-left: 4px; margin-top: 0px;">Escolha um arquivo...</p>
							</div>
							<input type="file" id="fileImg" name="fileImg3"  style="width: 210px; padding: 7px; display: none;">
							<input type="submit" name="enviarImg" class="enviarImgBtn">
						</div>


						<div class="maisImagens" style="float: left;">
							<div class="maisImagens-img">
								<img src="#" width="100%" style="width: 100%; height: 100%;">
							</div>
							<div for="fileImg" class="divFileImg">
								<div class="uploadIcon" style="width: 16px; height: 16px; float: left;">
									<img src="imgs/iconUpload.png" style="width: 100%; height: 100%">
								</div>
								<p style="float: left; margin-left: 4px; margin-top: 0px;">Escolha um arquivo...</p>
							</div>
							<input type="file" id="fileImg" name="fileImg4"  style="width: 210px; padding: 7px; display: none;">
							<input type="submit" name="enviarImg" class="enviarImgBtn">
						</div>
					</label>
					<div class="cls"></div>
				</div>
				<div class="box-4">
					<p class="tituloTermos">Termos</p>
					<textarea readonly>	Seja bem-vindo à plataforma de jogos indies, Storm. Se chegou até aqui, é porque está enviando seu jogo, e nos seguintes termos de condições, o que exigimos é:

1.	Se você quer que seu jogo fique em destaque, entre em contato conosco e iremos discutir com um valor fixo e um certo tempo para ele permanecer lá.

1.1.	A imagem em destaque é exigida em jpeg, com um certo tamanho para ela, de 1280px por 720px, no mínimo.

2.	A cada venda do seu jogo, solicitamos 10% do lucro de cada venda, já a empresa continua com os seus 90%.

3.	Todas as imagens, sem exceção, precisam ser do formato jpeg.

4.	Não seja um arquivo que comprometa a plataforma e nem o usuário que compra o jogo.

5.	Não use linguagem obscena nem aclame discurso de ódio, não toleramos isso, e sua empresa junto com seus jogos serão tirados do nosso site sem segundos avisos.

	Quando seu jogo for enviado, iremos verificar se atende a todos os nossos requisitos, opcionais e obrigatórios, e retornaremos o mais cedo possível com uma resposta.
					</textarea>
					<p class="p_radio">
					    <label>
					      	<input class="with-gap" name="radTermo" type="radio" checked  value="aceito" />
					      	<span style="font-size: 9.5pt; padding-top: 3px;">Li e concordo com os termos de condição e uso</span>
						</label>
					</p>
					<input type="submit" name="submitJogo" value="Enviar Jogo">
					<div class="cls"></div>
				</div>
			</form>
			 <?php if(isset($_SESSION['error'])): ?>
                        <div class="row">
                            <div class="col s12">
                                <div class="alert1">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <?php foreach ($_SESSION['error'] as $key => $value) 
                                    {
                                        echo $value . "<br/>";
                                    } 
                                    $_SESSION['error'] = NULL;
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php endif ?>
		</div>
		<div class="cls"></div>
	</main>
	<script>
		var inpPago = document.querySelector('#pago');
		var boxValor = document.querySelector('#boxPreco');
		inpPago.addEventListener('click', () => {
			boxValor.style.display = 'block';
		});
		var inpGratis = document.querySelector('#gratis');
		inpGratis.addEventListener('click', () => {
			boxValor.style.display = 'none';
		}); 

	</script>

	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/imgJogo.js"></script>
</body>
		
</html>