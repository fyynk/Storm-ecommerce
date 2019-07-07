<?php 
session_start();
include 'config/cfg.php';
$jogo = new Jogo();
$cart = new Carrinho();
$_SESSION['cart'] = null;
if(isset($_GET['rm'])) {
	$cart->deleteItemCart($_SESSION['userid'], $_GET['rm'] );
}
if(isset($_GET["i"])) {
	$cart->insertCart($_SESSION['userid'], $_GET['i']);
}
if(isset($_SESSION['userid'])) {
	$list = $cart->sessionCart($_SESSION['userid']);
}

if (isset($_SESSION['useridEmpresa'])){
	header("Location: index.php");
	exit;
}

 ?>

<!DOCTYPE html>
<html>
<head>

	<title>Storm - Carrinho de compras</title>
		<?php include 'view/head.php'; ?>
    <link rel="stylesheet" type="text/css" href="css/estiloCarrinho.css">

</head>

<body>
	<?php include 'view/header.php'; ?>
	<main>
		<div class="titulo cor2"><b>Meu carrinho</b></div>
		<article>
			<section class="boxCarrinhoJogo fl">
			    <div class="boxItensCompra">
							<?php 
								if(!empty($list[0])) {
								foreach ($list as $key => $id) {
									$jogo->loadById($id);
									echo ' 
						<div class="colJogo fl cor3">
							<a href="jogo.php?c='.$jogo->get_cd_jogo().'" class="linkPadrao">
								<div class="imgColJogo fl">
									<img src="images/jogos/' . $jogo->get_cd_jogo() .'.jpg">
									</div>
								<div class="tituloJogo fl">
									<p>' . $jogo->get_nm_jogo() . '</p>
								</div>
							</a>
								<div class="valorJogo fl">
									<p>'.$jogo->changeFormat().'</p>
									<a href="carrinho.php?rm='.$jogo->get_cd_jogo().'" class="valorJogo--remover">
									<p>Remover</p>
								</a>
								</div>
						</div>';		
								}
								$valorTotal = $cart->getTotalValue($_SESSION['userid']);
								echo '<div class="valorSubTotal cor1">
										<p>Subtotal</p>
									</div>
									<div class="valorSubTotal2 cor1">
										<p> R$ '.number_format($valorTotal,2,',','.').'</p>
									</div>';	

							}else {
								$valorTotal = 0.0;
								echo  '<div class="imgCarrinhoVazio">
									<img src="imgs/flaticon/carrinhoVazio.png" width="100%">
									<p>Carrinho vazio!</p>
									</div>';
								}
							 ?>
			</section>

			<section class="boxFormaPagamento fl cor4">
				<div class="boxContinuarC">
					<a href="catalogo.php" class="btn cC">Continuar Comprando</a>
				</div>
				<div class="boxFinalizarP">
					<?php if($valorTotal != 0.0): ?>	
					<div class="valorTotal cor1">
						<p><?= 'Valor Total: R$ ' . number_format($valorTotal, 2,',','.') ?></p>
					</div>			
					<a href="compra.php" class="btn fC">Finalizar Pedido</a>
				<?php endif ?>
				</div>
			</section>

			<div class="cls"></div>
		</article>

	</main>

	<?php include 'view/footer.php'; ?>

</body>
</html>