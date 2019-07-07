<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Storm - Contato</title>
    <?php include_once('view/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/estiloDenuncia.css">
</head>
<body>

	<?php include_once('view/header.php') ?>

	<main>
		<section class="formulario">
			<div class="tituloForm cor4"><h1>Denúncia</h1></div>
			<div class="row" id="row1">
				<form class="col s12" method="post">
					<div class="row">
						<div class="input-field col s12">
	                        <input id="emailContato" type="email" class="validate" style="font-size: 10.5pt;" name="nome">
	                        <label for="emailContato" style="font-size: 10.5pt;">E-mail</label>
                    	</div>
                    	<div class="input-field col s6">
                        <select name="motivo" class="custom-select custom-select-sm mb-3" id="motivoId"
                        style="margin-top: 14px; font-size: 10.5pt;">
                            <option value="-1" style="font-size: 10.5pt;"></option>
                            <option value="1" style="font-size: 10.5pt;">Conteúdo Ofensivo</option>
                            <option value="2" style="font-size: 10.5pt;">Malware</option>
                            <option value="3" style="font-size: 10.5pt;">Direitos Autorais</option>
                            <option value="4" style="font-size: 10.5pt;">Outros</option>
                        </select>
                        <label for="motivo" id="motivo" style="font-size: 10.5pt; margin-top: -16px;" class="motivoClass">Motivo</label>
                    </div>
					</div>
					<div class="row">
        				<div class="input-field col s12">
          					<textarea id="contatoMsg" class="materialize-textarea" style="color: #e8efff;"></textarea>
          					<label for="contatoMsg" style="font-size: 10.5pt;">Mensagem</label>
        				</div>
      				</div>
      				<div class="row">
                        <div class="input-field col s12">
                            <input type="submit" name="submit" value="Enviar">
                        </div>
                    </div>
      			</form>
      		</div>
		</section>
	</main>

	<?php include_once('view/footer.php') ?>
</body>
</html>