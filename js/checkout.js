var Root="http://" + document.location.hostname +"/TCCProgamacao/";
var valor = $("#valorTotal").val(); 



// inicia a sessao com o hash gerado no controllerId.php via json
function iniciarSessao()
{
	$.ajax({
		url: Root+"controller/controllerId.php",
		type: 'POST',
		dataType: 'json',
		success: function(data) {
			PagSeguroDirectPayment.setSessionId(data.id);
		},
		error: function() {
			console.log('Não foi possivel iniciar a sessao!');
		},
		complete: function() {
			listaMeioPagamento();
		}
	});
}


//lista o pagamento possiveis com o Pagseguro
function listaMeioPagamento() {
	PagSeguroDirectPayment.getPaymentMethods({
	amount: valor,
	success: function(data) {

		$.each(data.paymentMethods.CREDIT_CARD.options, function(i, obj){
			$('.cartaoCredito').append("<div><img src=https://stc.pagseguro.uol.com.br./"+obj.images.MEDIUM.path+">"+ obj.name+" </div>");
		})
	},
	error: function() {
		console.log('Não foi possivel listar o meio de pagamento!');
	}
});
}
/* Ao digitar o numero do cartao nos 6 primeiros digitos ele usa a função do pagseguro
para verificar a bandeira do cartão
*/
$('#numCartao').on('keyup', function() {
	var NumeroCartao = $(this).val(); // numero do cartao
	var qntCaracteres = NumeroCartao.length; // a qnt de caracters do cartao

	/* quando ver que o num de caracteres for 6 ele faz a verificação( 6 digitos é o minimo)
	para saber a bandeira.
	*/
	if(qntCaracteres >= 6) {
	PagSeguroDirectPayment.getBrand({
		cardBin: NumeroCartao,
		success: function(response) {
	  		var bandeiraImg = response.brand.name; // tras o nome da bandeira
	  		$('#bandeiraCartao').val(bandeiraImg);
	 		$('.bandeiraCartao').html("<img src=https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/" + bandeiraImg + ".png>"); // é gerado um img com o nome da bandeira
	 		 getParcelas(bandeiraImg);
			},

			//caso dê erro é limpado a div do bandeira cartão(caso tenha algo dentro), e é mandado uma msg de erro para o usuario.
		error: function(response) {
			$('$bandeiraCartao').empty();
			$('.bandeiraCartao').empty();
			$('.msgError').html("<span>Cartão invalido!</span>")
		},
	});
}
});


// exibe a quantidade e valores das parcelas

function getParcelas(bandeira)
{
PagSeguroDirectPayment.getInstallments({
        amount: valor, // traz o valor do pruduto
        maxInstallmentNoInterest: 2, // o numero de parcelas q não será cobrado juros
        brand: bandeira, // a bandeira vinda por parametro 
        success: function(response){
        	/*o primeiro foreach lê o json enviado no parametro response que são varios arrays, 
        	 o segundo foreach($.each) abaixo remove todos os valores dentro da tag <select>
			isso evita a duplicação nas parcelas, sempre que for mostrado as parcelas 
			é retirado tudo que esta dentro.
        	 */
         $.each(response.installments,function(i,obj){

         	   $("#qtdParcelas option").each(function(){
                if($(this).text() != "Selecione"){
                    $(this).remove();
                }
            });

                $.each(obj,function(i2,obj2){
                    var numberValue = obj2.installmentAmount;
                    var num = "R$ "+ numberValue.toFixed(2).replace(".",",");
                    var numParcelas = numberValue.toFixed(2);
                    $('#qtdParcelas').show().append("<option value='" + obj2.quantity + "' title='" + numParcelas + "'>"+obj2.quantity+" x de " + num + "</option>");
                });
            });
       	 
        }, // fim do succsess
	});
}

$("#qtdParcelas").on('change', function() {
	var valueSelected = document.getElementById('qtdParcelas');
	$('#valorParcelas').val(valueSelected.options[valueSelected.selectedIndex].title);
});

//chama a funcao do token
// $('#CVV').on('blur', function() {
// 	getTokenCard();
// });

//pega o token do Cartão
function getTokenCard() {
	PagSeguroDirectPayment.createCardToken({
   cardNumber: $('#numCartao').val(), // Número do cartão de crédito
   brand: $('#bandeiraCartao').val(), // Bandeira do cartão
   cvv: $('#CVV').val(), // CVV do cartão
   expirationMonth: $('#mesValidade').val(), // Mês da expiração do cartão
   expirationYear: $('#anoValidade').val(), // Ano da expiração do cartão, é necessário os 4 dígitos.
   success: function(response) {
        $('#tokenCard').val(response.card.token);
   },

});
}

// Gera o hash do cartão
$('#btnComprar').on('click', function(event) {
	getTokenCard();
	PagSeguroDirectPayment.onSenderHashReady(function(response){
		$("#hashCard").val(response.senderHash);
	});
})

iniciarSessao();