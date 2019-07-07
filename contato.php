<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Storm - Contato</title>
    <?php include_once('view/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="css/estiloContato.css">
</head>
<body>

	<?php include_once('view/header.php') ?>

	<main>
		<section class="formulario">
			<div class="tituloForm cor4"><h1>Contato</h1></div>
			<div class="row" id="row1">
				<form class="col s12" method="post">
					<div class="row">
	                    <div class="input-field col s12">
	                        <input id="emailContato" type="email" class="validate" name="nome">
	                        <label for="emailContato" style="font-size: 10.5pt;">Email</label>
	                    </div>
                	</div>

	                <div class="input-field col s6">
                        <select name="motivo" class="custom-select custom-select-sm mb-3" style="font-size: 10.5pt;">
                            <option value="" disabled selected style="font-size: 10.5pt;">Tipo de mensagem</option>
                            <option value="1" style="font-size: 10.5pt;">Ajuda</option>
                            <option value="2" style="font-size: 10.5pt;">Dúvida</option>
                            <option value="3" style="font-size: 10.5pt;">Outro</option>
                        </select>
                        <label for="motivo" id="motivo" style="font-size: 10.5pt;">Motivo:</label>
                    </div>

                	<div class="row">
        				<div class="input-field col s12">
          					<textarea id="contatoMsg" class="materialize-textarea"></textarea>
          					<label for="contatoMsg" style="font-size: 10.5pt;">Mensagem</label>
        				</div>
      				</div>
      				<input type="submit" name="submit" value="Enviar" />
				</form>
			</div>
		</section>
	</main>

	<?php include_once('view/footer.php') ?>
</body>
</html>