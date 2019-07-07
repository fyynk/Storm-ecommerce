<?php 

class Biblioteca extends Jogo {



    // Depois do pagamento é colocado na biblioteca do usuario os jogos;

  	public function insertLib($userid) {
  		$sql = new Sql();
  		$cart = new Carrinho();
  		$result = $cart->selectItemCart($userid);
  		foreach ($result as $key => $value) {
  			$sql->Query("INSERT INTO biblioteca (id_usuario, cd_jogo) VALUES (".$userid."," . $value['cd_jogo'].")");
  		}
  		$sql->Query("DELETE FROM item_pedido where id_usuario = :USERID",
  		array(
  			":USERID"=>$userid	

  		));
  	}


	public function userLib($userid, $status = false) {
		$sql = new Sql();
		$result = $sql->Select("SELECT cd_jogo from biblioteca where id_usuario = :ID and ic_status = :STATUS",
		array(
			":ID"=>$userid,
			':STATUS'=>$status
		));

		if (count($result) > 0) {
			$jogo = new Jogo();
			foreach ($result as $key => $value) {
				$game = $value['cd_jogo'];
				$jogo->loadById($game);
        if(!$status){
    				echo '<a href="jogo.php?c='.$jogo->get_cd_jogo().'">
                    <div class="col1de4">
                        <div class="imgCol1de4">
                          <img src="images/jogos/'.$jogo->get_cd_jogo().'.jpg"  style="filter: grayscale(9);" width="100%">
                        </div>
                        <div class="titulo">'.$jogo->get_nm_jogo().'</div>
                    </div>
                  </a>';
              }
              else {
                $filename = urlencode($jogo->get_cd_jogo().".rar");
                echo '<a href="jogo.php?c='.$jogo->get_cd_jogo().'">
                    <div class="col1de4">
                        <div class="imgCol1de4">
                          <img src="images/jogos/'.$jogo->get_cd_jogo().'.jpg" width="100%">
                        </div>
                        <div class="titulo" style="float: left; width: 100%;">'.$jogo->get_nm_jogo().'</div>
                        <a href="download.php?file='.$filename.'" class="linkDownload"
                        style="width: 100%;">
                            <button class="btnDownload">Download</button>
                        </a>
                    </div>
                  </a>';
              }
          }
			}
	}

	public function changeStatus($userid) {
      $sql = new Sql();
          $sql->Query("UPDATE biblioteca set ic_status = true where id_usuario = :ID",
         array(
          ":ID"=>$userid
          ));
        }  
    }   

 ?>