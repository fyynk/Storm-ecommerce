<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Jogo Efetuada</title>
	<?php include 'view/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="css/estiloCompraEfeituada.css">
</head>
<body>
<?php include 'view/header.php'; ?>
	<main>
		<div class="compra">
			<div class="compra-img">
				<img src="imgs/iconJoinhaCompra.png" style="width: 100%; height: 100%;" width="100%">
			</div>
			<h6>Obrigado por enviar seu jogo para Storm! Seu jogo foi enviado para a análise com sucesso.</h6>
			<p style="text-transform: none; font-size: 12pt;
			color: #e8efff; opacity: 0.2;">Contataremos em breve.</p>
			<a href="perfilEmpresa.php?dev=<?php echo $id; ?>">
				<div class="compraBtn" style="margin-top: 20px; margin-bottom: 15px;">
					<p>Voltar ao perfil</p>
				</div>
			</a>
		</div>
	</main>
<?php include 'view/footer.php'; ?>
</body>
</html>