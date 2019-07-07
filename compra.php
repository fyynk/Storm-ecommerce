<?php   
session_start();
require_once 'config/cfg.php';
$id = $_SESSION['userid'];
$cart = new Carrinho();
$valorFinal = $cart->getTotalValue($id);

if (!isset($id))
{
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Storm - Carrinho de compras</title>
        <?php include 'view/head.php'; ?>
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="css/materialize.css">
    <link rel="stylesheet" type="text/css" href="css/estilo_DadosCompra.css">
    <link href="https://fonts.googleapis.com/css?family=Chivo" rel="stylesheet">

</head>
<body>
    <?php include 'view/header.php'; ?>
        <main>
        <div class="tituloForm cor4"><h1>Finalizar Compra</h1></div>
            <section class="formulario">
            <div class="row" id="row1">
                <!-- action="controller/controllerPedido.php" -->
            <form class="col s12" method="post" action="controller/controllerPedido.php">
                <input type="hidden" id="tokenCard" name="tokenCard">
                <input type="hidden" id="hashCard" name="hashCard"> 
                <input type="hidden" id="valorTotal" value="<?=$valorFinal?>">
                 <div class="row"><h6>Dados do Comprador</h3></div>
                <div class="row">
                    
                    <div class="input-field col s12">
                        <input id="nomeComprador" name="nomeComprador" type="text" class="validate" placeholder="Digite seu nome" value="<?php echo $user->getNome(); ?>">
                        <label for="nomeComprador">Nome:</label>
                    </div>
                </div>

                <!-- <div class="usuarioErro"> <span for="lblErro">Nome de usuário já utilizado</span> </div> -->

                <div class="row">
                      <div class="input-field col s5">
                        <input id="cpfComprador" name="cpfComprador" type="text" class="validate" maxlength="11" placeholder="Digite seu CPF" value="<?php echo $user->getCpf(); ?>">
                        <label for="cpfComprador">CPF do Comprador: </label>
                    </div>
                    
                    <div class="input-field col s3">
                        <input id="dddComprador" name="dddComprador" type="text" class="validate" placeholder="Digite seu DDD">
                        <label for="dddComprador">DDD:</label>
                    </div>

                    <div class="input-field col s4">
                        <input id="telComprador" name="telComprador" type="text" class="validate" placeholder="Digite seu telefone">
                        <label for="telComprador">Telefone: </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="cepComprador" name="cepComprador" type="text" class="validate" maxlength="8" onblur="pesquisacep(this.value);" placeholder="Digite seu CEP">
                        <label for="cepComprador">CEP do Comprador: </label>
                    </div>

                    <div class="input-field col s8">
                        <input id="enderecoComprador"  name="enderecoComprador" type="text" class="validate" placeholder="Digite seu endereço">
                        <label for="enderecoComprador">Endereço do Comprador: </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="numeroEndereco" name="numeroComprador" type="text" class="validate" placeholder="Digite o número">
                        <label for="numeroEndereco">Número do Endereço: </label>
                    </div>

                    <div class="input-field col s6">
                        <input id="complementoComprador" name="complementoComprador" type="text" class="validate" placeholder="Digite o complemento">
                        <label for="complementoComprador">Complemento do Comprador: </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="bairroComprador" name="bairroComprador" type="text" class="bairroComprador" placeholder="Digite seu bairro">
                        <label for="bairroComprador">Bairro do Comprador: </label>
                    </div>
                    <div class="input-field col s6">
                        <input id="cidadeComprador" name="cidadeComprador" type="text" class="validate" placeholder="Digite sua cidade">
                        <label for="cidadeComprador">Cidade: </label>
                    </div>

                    <div class="input-field col s2">
                        <input id="uf" type="text" name="uf" class="validate" maxlength="2" placeholder="Digite o UF">
                        <label for="uf">UF: </label>
                    </div>
                </div>

                <div class="row">

                </div>
                                    <!--CARTAO DE CREDITO-->
                <div class="row">
                    <div class="input-field col s6">
                        <input id="numCartao" type="text" name="numCartao" class="validate" placeholder="Digite o número do cartão" value="<?php echo $user->getCartao(); ?>">
                        <label for="numCartao">Número do Cartão: </label>
                    </div>
                    <div class="col s2 input-field bandeiraCartao"></div>
                    <div class="input-field col s4">
                        <input id="mesValidade" name="mesValidade" type="text" class="validate" maxlength="2" placeholder="Digite o mês de validade">
                        <label for="mesValidade">Mês de Validade: </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="anoValidade" name="anoValidade" type="text" class="validate" maxlength="4" placeholder="Digite o ano de validade">
                        <label for="anoValidade">Ano de Validade: </label>
                    </div>
    
                    <div class="input-field col s3">
                        <input id="CVV" name="CVV" type="text" class="validate" maxlength="3" placeholder="Digite o CVV">
                        <label for="CVV">CVV: </label>
                    </div>
                        <div class="input-field col s5">
                        <select class="custom-select custom-select-sm mb-3" id="qtdParcelas" name="qtdParcelas" type="text" >
                            <option value="" disabled selected>Selecione as parcelas</option>
                        </select>
                        <label for="qtdParcelas" id="parcela">Número de Parcelas: </label>
                </div>

                <div class="row">
  
                    </div>

                    <div class="input-field col s12">
                        <input id="donoCartao" type="text" name="donoCartao" class="validate" placeholder="Digite o titular">
                        <label for="donoCartao">Nome do Titular do Cartão: </label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <input id="cpfCartao" type="text" name="cpfCartao" class="bairroComprador" maxlength="11" placeholder="Digite o CPF do titular">
                        <label for="cpfCartao">CPF do Titular do Cartão: </label>
                    </div>
                </div>
               
                <input type="submit" name="enviar" value="Finalizar"/>

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
    <?php include 'view/footer.php'; ?>


    <script src="js/main.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/cep.js"></script>
    <script type="text/javascript" src= "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="js/zepto.min.js"></script>
    <script src="js/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>