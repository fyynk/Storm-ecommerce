<?php 

 Class Carrinho extends Jogo {

/*
	1º Verifica se existe um session de userid(se está logado);
	2º Faz um join entre as tabelas (jogo <=> item_pedido) <=> carrinho;
	3º isso me traz os itens do carrinho do respectivo usuario;
	4º Vem em forma de string e transformo em array pois os itens estão concatenado;
	5º Caso ele pule fora desse if ele verifica se existe um session de cart,
		se não tiver é criado o mesmo com array vazio;
 */
 	static public function sessionCart($id = null) {
 		if(!empty($_SESSION['userid'])) {
 			$sql = new Sql();
 			 $result = $sql->Select('SELECT group_concat(j.cd_jogo) as lista_jogo from jogo j
				 inner join
				 item_pedido ip on (ip.cd_jogo = j.cd_jogo)
				 inner join
				 carrinho c on(c.cd_carrinho = ip.cd_carrinho) where c.id_usuario = :ID group by  c.id_usuario;',
				 array(
				 	":ID" => $id
				 ));
 			if(count($result) > 0){
 				return $listCart = explode(',', $result[0]['lista_jogo']);	
 			}
      else {
        return array();
      }
 		} 
 	} 

 	/*
		1º Dou um select para verificar se existe um carrinho existente na conta referida;
		2º Se não existir, é feito um insert no carrinho somente com o userid, criando assim
		 o carrinho do usuario e altero o valor do result;
		3º independente de existir ou não um carrinho, ño final é criado e inserido no mesmo,
		 os dados do usuario, carrinho e do jogo;
 	*/
 	public function insertCart($userid, $gameid) {
 		$sql = new Sql();
 		$result = $this->selectCartById($userid);
 		if(count($result) <= 0) {
 			$sql->Query("INSERT INTO carrinho (id_usuario) values(:USERID)",
 				array(
 					':USERID'=>$userid
 				));
 			$result = $this->selectCartById($userid);	
	 		}
			$cart = $result[0]["cd_carrinho"];
		$sql->Query("INSERT INTO item_pedido values(:CART, :USERID, :GAMEID);",
			array(
				':CART' => $cart,
				':USERID' => $userid,
				':GAMEID'=> $gameid
			));
 	}


	// 1º Traz o carrinho do Usuario;
 	public function selectCartById($id) {
 		$sql = new Sql();
 		$result = $sql->Select("SELECT cd_carrinho from carrinho where id_usuario = :ID ",
 		array(
 			":ID" => $id
 		));
 		return $result;
 	}

 	// 1ª Deleta um item do carrinho do usuario;
 	public function deleteItemCart($userid, $gameid) {
 		$sql = new Sql();
 		$sql->Query('DELETE from item_pedido where cd_jogo = :GAMEID and id_usuario = :USERID;',
 		 array(
 		 	':GAMEID'=> $gameid,
 		 	':USERID'=>	$userid
 		 ));
 	}

 	// Traz a soma dos valores de todos os itens dentro do carrinho baseado pelo usuario;

 	public function getTotalValue($userid) {
 		$sql = new Sql();
 		$result = $sql->Select('SELECT sum(vl_jogo) as vl_total from item_pedido ip inner join jogo j on (ip.cd_jogo = j.cd_jogo) where id_usuario = :ID',
 			array(
 				':ID'=>$userid
 				));
 		if(count($result) > 0){
 			$total = $result[0]['vl_total'];
 			if($total == NULL) {
 				$total = 0.0;
 			}
 			return $total;
 		}
 		return "Valor total não encontrado!.";

 	}


 	// Traz os produtos do carrinho do usuario em um array bidimensional. E carregando os jogos pelo metodo loadById;

  public function selectItemCart($userid) {
    $result = $this->sessionCart($userid);
    $jogo = new Jogo();
    $item = array();
    $i = 0;
    if(count($result) > 0){
    foreach ($result as $key => $value) {
        $jogo->loadById($value);
            $item[$key] = array(
              'cd_jogo'=>$jogo->get_cd_jogo(),
              'nm_jogo'=>$jogo->get_nm_jogo(),
              'vl_jogo'=>$jogo->get_vl_jogo()
            );
        $i++;
      }
      return $item; 
    } else {
      return array();
    }
  	
  	}

    // atualiza o codigo do pedido do usuario (codigo vindo do pagseguro);

  	public function updateCode($code, $cart) {
  		$sql = new Sql();
  		$sql->Query('UPDATE carrinho set cd_pedido = :CODE WHERE cd_carrinho = :CART',
  		array(
  			':CODE'=>$code,
  			':CART'=>$cart
  		));
  	}


  
}



