<?php 

class Jogo extends Sql {
	private $cd_jogo;
	private $nm_jogo;
	private $vl_jogo;
	private $ds_jogo;
	private $ds_sinopse;
	private $ds_requisito_minimo;
	private $ds_requisito_sugerido;


 // Getters & Setters 

	protected function set_cd_jogo($value) {
		$this->cd_jogo = $value;
	}

	public function get_cd_jogo() {
		return $this->cd_jogo;
	}

	protected function set_nm_jogo($value) {
		$this->nm_jogo  = $value;
	}

	public function get_nm_jogo() {
		return $this->nm_jogo;
	}

	protected function set_vl_jogo($value) {
		$this->vl_jogo  = $value;
	}

	public function get_vl_jogo() {
		return $this->vl_jogo;
	}

	protected function set_ds_sinopse($value) {
		$this->ds_sinopse = $value;
	}

	public function get_ds_sinopse() {
		return $this->ds_sinopse;
	}

	protected function set_dt_lancamento($value) {
		$this->dt_lancamento = $value;
	}

	public function get_dt_lancamento() {
		return $this->dt_lancamento;
	}

	protected function set_ds_requisito_minimo($value) {
		$this->ds_requisito_minimo = $value;
	}

	public function get_ds_requisito_minimo() {
		return $this->ds_requisito_minimo;
	}

	protected function set_ds_requisito_sugerido($value) {
		$this->ds_requisito_sugerido = $value;
	}

	public function get_ds_requisito_sugerido() {
		return $this->ds_requisito_sugerido;
	}



	public function loadById($id) {
		$sql = new Sql();
		$result = $sql->Select("SELECT * from jogo where cd_jogo = :ID ", array(":ID" => $id));
		if(count($result) >= 1){
			$this->setData($result[0]);
		}
	}

	// carrega os destaques com o limite de 4
	public function loadSpotlight() {
		$sql = new Sql();
		$result = $sql->Select("SELECT cd_jogo, nm_jogo, vl_jogo from Jogo where ic_destaque = true LIMIT 5");
		if(count($result) > 0) {
			return $result;
		}
	}		

	// carrega os jogos pela tag com o limite de 4

	public function loadInitialPage($tag, $userid = null) {
		$sql = new Sql();

		$result = $sql->Select("SELECT j.cd_jogo , j.nm_jogo, j.vl_jogo FROM Jogo j INNER JOIN  tag_jogo tj ON (tj.cd_jogo = j.cd_jogo) WHERE tj.cd_tag = :TAG LIMIT 4",
		 array(
		 	":TAG"=>$tag
		));
		if(count($result) > 0) {
			if ($userid != NULL) {
				foreach ($result as $key => $value) {
				echo '<div class="col1de4 fl cor3">
					<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
					<div class="imgCol1de4"><img src="images/jogos/'.$value["cd_jogo"].'.jpg"></div>
					<div class="titulo cor6">' . $value["nm_jogo"] . '</div>
					<div class="valor cor5" width="100%">R$'. " " . number_format($value["vl_jogo"],2,',','.') .'</div>
					</a>
					<div class="adicionarAoCarrinho">
						<button onclick="myFunction()" id="'.$value['cd_jogo'].'" class="addCarrinho">
							<img src="imgs/flaticon/addCarrinho.png" width="100%">
						</button>
					</div>
				</div>';
				}
				return;
			}
			foreach ($result as $key => $value) {
				echo '<div class="col1de4 fl cor3">
					<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
					<div class="imgCol1de4"><img src="images/jogos/'.$value["cd_jogo"].'.jpg"></div>
					<div class="titulo cor6">' . $value["nm_jogo"] . '</div>
					<div class="valor cor5" style="width: 99.5%">R$'. " " . number_format($value["vl_jogo"],2,',','.') .'</div>
					</a>
				</div>';
					}
		}
	}

	// seta os dados utilizando o setter
	private function setData($data) {
		$this->set_cd_jogo($data["cd_jogo"]);
		$this->set_nm_jogo($data["nm_jogo"]);
		$this->set_vl_jogo($data["vl_jogo"]);
		$this->set_ds_sinopse(utf8_decode($data["ds_sinopse"]));
		$this->set_dt_lancamento($data["dt_lancamento_jogo"]);
		$this->set_ds_requisito_minimo($data["ds_requesito_minimo"]);
		$this->set_ds_requisito_sugerido($data["ds_requesito_sugerido"]);
	}

	// traz a tag do respectivo jogo

	public function getTagById($id) {
		$sql = new Sql();

		$result = $sql->Select("SELECT group_concat(t.nm_tag separator '-') as tags from jogo j inner join tag_jogo tj on (j.cd_jogo = tj.cd_jogo) 
			inner join tag t on (t.cd_tag = tj.cd_tag)where j.cd_jogo = :ID  group by j.cd_jogo ", array(":ID"=>$id));
		if(count($result) > 0) {
			return explode('-', $result[0]['tags']);
		}
	}

	// traz a plataforma do respectivo jogo

	public function getPlatform($id) {
		$sql = new Sql();
		$result = $sql->Select("SELECT group_concat(p.nm_plataforma separator '-') as plataformas from plataforma p
 			inner join jogo_plataforma jp on (p.cd_plataforma = jp.cd_plataforma) inner join jogo j on (j.cd_jogo = jp.cd_jogo) where j.cd_jogo = :ID group by j.cd_jogo;", array(':ID'=> $id));
		if(count($result) > 0) {
			return explode('-', $result[0]['plataformas']);
		}

	}

	// muda o formato do valor do jogo para casa decimais com vigulas ex: 1,000.00 => 1.000,00
	public function changeFormat() {
		if($this->get_vl_jogo() != 0.0) {
			return 'R$ '. number_format($this->get_vl_jogo(), 2, ',', '.');
		}
		return 'Gratuito';
				
	}

		public function getDeveloper($id) {
		$sql = new Sql();
		$result = $sql->Select("SELECT group_concat(e.nm_empresa SEPARATOR '-.') AS empresas FROM empresa e
								INNER JOIN empresa_jogo ej ON (e.cd_empresa = ej.cd_empresa)
								INNER JOIN jogo j on (j.cd_jogo = ej.cd_jogo) 
								WHERE j.cd_jogo = :ID group by j.cd_jogo;", array(':ID'=> $id));

		if(count($result) > 0) {
			return explode('-.', $result[0]['empresas']);
		}
	}

	public function getDevId($id) {
		$sql = new Sql();
		$result = $sql->Select("SELECT group_concat(e.cd_empresa SEPARATOR '-') AS empresas FROM empresa e
								INNER JOIN empresa_jogo ej ON (e.cd_empresa = ej.cd_empresa)
								INNER JOIN jogo j on (j.cd_jogo = ej.cd_jogo) 
								WHERE j.cd_jogo = :ID group by j.cd_jogo;", array(':ID'=> $id));
		if(count($result) > 0) {
			return explode('-', $result[0]['empresas']);
		}
	}
	


	public function getRecent($userid = null) {
		$sql = new Sql();
		$result = $sql->Select('SELECT cd_jogo, nm_jogo, vl_jogo from jogo where cd_jogo != 1 order by dt_lancamento_jogo desc limit 4');
		if(count($result)> 0) {
			if($userid != null) {
				foreach ($result as $key => $value) {
					echo '<div class="col1de4 fl cor3">
				<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
				<div class="imgCol1de4"><img src="images/jogos/'.$value["cd_jogo"].'.jpg"></div>
				<div class="titulo cor6">' . $value["nm_jogo"] . '</div>
				<div class="valor cor5"  >R$'. " " . number_format($value["vl_jogo"],2,',','.') .'</div>
				</a>
				<div class="adicionarAoCarrinho">
					<button onclick="myFunction()" id="'.$value['cd_jogo'].'" class="addCarrinho">
						<img src="imgs/flaticon/addCarrinho.png" width="100%">
					</button>
				</div>
				</div>';
				}
				return;
			}	
			foreach ($result as $key => $value) {
				echo '<div class="col1de4 fl cor3">
					<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
					<div class="imgCol1de4"><img src="images/jogos/'.$value["cd_jogo"].'.jpg"></div>
					<div class="titulo cor6">' . $value["nm_jogo"] . '</div>
					<div class="valor cor5" style="width: 99.5%">R$'. " " . number_format($value["vl_jogo"],2,',','.') .'</div>
					</a>
				</div>';
			}
		}
	}

	public function catalogGame($page = 1,$gameName = "%%", $userid = null, $search = false) {
		$sql = new Sql();
		$quantity = 16;
		$initial = ( $quantity * $page ) - $quantity;
		$result = $sql->Select("SELECT cd_jogo, nm_jogo, vl_jogo from jogo where nm_jogo like :JOGO order by dt_lancamento_jogo desc limit " . $initial . ", " . $quantity,
			array(
				':JOGO'=> $gameName
			));

		//ITEM DO CATALOGO
		if(count($result) > 0 ) {
			if($userid != NULL) {
				foreach ($result as $key => $value) {
					echo '<div class="col1de4 fl cor3">
						<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
						<div class="imgCol1de4"><img src="images/jogos/'.$value["cd_jogo"].'.jpg"></div>
						<div class="titulo cor6">' . $value["nm_jogo"] . '</div>
					<div class="valor cor5">R$ ' . number_format($value["vl_jogo"],2,',','.') .'</div>
					</a>
					<div class="adicionarAoCarrinho">
						<button onclick="myFunction()" id="'.$value['cd_jogo'].'" class="addCarrinho">
							<img src="imgs/flaticon/addCarrinho.png" width="100%">
						</button>
					</div>
				</div>';
			}
		} else {
			foreach ($result as $key => $value) {
			echo '<div class="col1de4 fl cor3">
					<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
					<div class="imgCol1de4"><img src="images/jogos/'.$value["cd_jogo"].'.jpg"></div>
					<div class="titulo cor6">' . $value["nm_jogo"] . '</div>
				<div class="valor cor5" style="width: 99.5%">R$ ' . number_format($value["vl_jogo"],2,',','.') .'</div>
				</a>
			</div>';
			}

		}
		if(!$search) {
			// PAGINAÇÂO
			echo '<div class="main--pagination">
					<ul>';
				if($page > 1) {
				echo '<a href="catalogo.php?p='. ($page - 1) . '">
						<li class="seta-pagination-anterior"><</li>
					</a>';
				}else {
					echo '<a href="catalogo.php?p=1">
						<li class="seta-pagination-anterior"><</li>
					</a>';
					}
				
			$count = $this->countGame();
				for ($i = 1 ; $i <= $count ; $i++) { 
					echo '<a href="catalogo.php?p='.$i.'">
						<li class="pagination-pagina">'.$i.'</li>
					</a>';
				}

			if($page != $count) {
				echo '<a href="catalogo.php?p='. ($page + 1) . '">
					<li class="seta-pagination-proxima">></li>
				</a>';
			}
			echo '</ul>
				</div>';
			}

		} else {
	echo '	<div class="erroJogo">
						<div class="erroJogoCont">
							<div class="erroJogoImg">
								<img src="imgs/flaticon/iconErro.png" width="100%">
							</div>
							<p>Nenhum jogo encontrado.</p>
						</div>
					</div>'; 
		}
	}

	// Conta a quantidade de Jogos existentes.
	public function countGame() {
		$sql = new Sql();
		$result = $sql->Select("SELECT COUNT(*) as count FROM jogo");
		if(count($result) > 0) {
			
			$count = ($result[0]['count']) / 16;
			return ceil($count);
		}
	}

	public function getCatalogByTag($tag, $userid = NULL) {
		$sql = new Sql();

		if($tag != "-1") {
		$result = $sql->Select("SELECT t.nm_tag, j.cd_jogo , j.nm_jogo, j.vl_jogo FROM Jogo j
								INNER JOIN  tag_jogo tj ON (tj.cd_jogo = j.cd_jogo)
								INNER JOIN tag t on (t.cd_tag = tj.cd_tag)  WHERE tj.cd_tag = :TAG LIMIT 16",
			array(
			 	":TAG"=>$tag,
			));

		if(count($result) > 0) {
			echo  '<div class="col1Titulo">
				<div class="estiloTitulo">' .$result[0]['nm_tag']. '</div>
			</div>';

			if($userid != NULL) {


			foreach ($result as $key => $value) {
				echo '<div class="col1de4 fl cor3">
					<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
					<div class="imgCol1de4"><img src="images/jogos/'.$value["cd_jogo"].'.jpg"></div>
					<div class="titulo cor6">' . $value["nm_jogo"] . '</div>
				<div class="valor cor5"  >R$ ' . number_format($value["vl_jogo"],2,',','.') .'</div>
					</a>
				<div class="adicionarAoCarrinho">
					<button onclick="myFunction()" id="'.$value['cd_jogo'].'" class="addCarrinho">
						<img src="imgs/flaticon/addCarrinho.png" width="100%">
					</button>
				</div>
			</div>';
				}

			} else {


			foreach ($result as $key => $value) {
				echo '<div class="col1de4 fl cor3">
					<a href="jogo.php?c='.$value['cd_jogo'].'" class="linkPadrao">
					<div class="imgCol1de4"><img src="images/jogos/'.$value["cd_jogo"].'.jpg"></div>
					<div class="titulo cor6">' . $value["nm_jogo"] . '</div>
				<div class="valor cor5" style="width: 99.5%">R$ ' . number_format($value["vl_jogo"],2,',','.') .'</div>
					</a>

			</div>';
				}
			}
			return;
		} 
	}
	if ($userid != NULL) {
		$this->catalogGame(1,'%%', $userid);
	}else {		
		$this->catalogGame();	
	}
}

	public function verifyHasGame($userid, $gameid = null) {
		$sql = new Sql();
	 	$result = $sql->Select("SELECT * from biblioteca
	 		 where id_usuario = :USER and cd_jogo = :GAME",
		array(
			':USER'=>$userid,
			':GAME'=>$gameid
			));

		if(count($result) > 0) {
			echo '<div class="ncomprarJogo fl">
			<p>Jogo Adquirido</p></div>';
		} else {
			echo '<div class="comprarJogo fl">
			<a href="carrinho.php?i='.$gameid.'"><p>Comprar</p></a></div>';
		}
	}
}



/*
select j.cd_jogo, j.nm_jogo, group_concat(p.nm_plataforma separator '-') as plataformas from plataforma p
 inner join jogo_plataforma jp on (p.cd_plataforma = jp.cd_plataforma) inner join jogo j on (j.cd_jogo = jp.cd_jogo) group by j.cd_jogo;
 
 */

 ?>