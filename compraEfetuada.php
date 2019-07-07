<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Compra efeituada</title>
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
			<h6>Obrigado por comprar na Storm! Sua compra foi efeituada com sucesso.</h6>
			<p style="text-transform: none; font-size: 12pt;
			color: #e8efff; opacity: 0.2;">Os dados da compra foram enviados por e-mail.</p>
			<a href="perfil.php">
				<div class="compraBtn" style="margin-top: 20px; margin-bottom: 15px;">
					<p>Ir para a sua biblioteca</p>
				</div>
			</a>
			<a href="catalogo.php">
				<div class="compraBtn">
					<p>Voltar ao catálogo</p>
				</div>
			</a>
		</div>
	</main>
<?php include 'view/footer.php'; ?>
</body>
</html>