<?php 

Class Empresa extends Sql {

	private $cd_empresa;
	private $nm_apelido_empresa;
	private $nm_email_empresa;

	// Get's & Set's

	public function get_cd_empresa() {
			return $this->cd_empresa;
		}

	public function set_cd_empresa($value){
		$this->cd_empresa = $value;
	}

	public function get_nm_apelido_empresa() {
		return $this->nm_apelido_empresa;
	}

	public function set_nm_apelido_empresa($value){
		$this->nm_apelido_empresa = $value;
	}

	public function get_email_empresa() {
		return $this->nm_email_empresa;
	}

	public function set_email_empresa($value){
		$this->nm_email_empresa = $value;
	}

	// Verifica no banco se já existe um email dessa empresa cadastrado
		public function verificarBancoEmpresa($nm_email_empresa) {
			$conn = new Sql();
			$results = $conn->Select("SELECT cd_empresa FROM empresa WHERE nm_email_empresa = :EMAIL_EMPRESA",
			array(
				":EMAIL_EMPRESA" => $nm_email_empresa
			));
			if(count($results) > 0){
				return false;
			}
			return true;
		}

	// Verifica no banco se já existe um usuario dessa empresa cadastrado
	public function verificarBancoEmpresa2($nm_apelido_empresa) {
		$conn = new Sql();
		$results = $conn->Select("SELECT cd_empresa FROM empresa WHERE nm_apelido_empresa = :APELIDO_EMPRESA",
		array(
			":APELIDO_EMPRESA" => $nm_apelido_empresa
		));
		if(count($results) > 0){
			return false;
		}
		return true;
	}

	//Insere uma nova conta de empresa no banco
	public function inserirEmpresa($nm, $apelido, $email, $pass) {
		$conn = new Sql();
		$conn->Query("INSERT INTO empresa (nm_empresa, nm_apelido_empresa, nm_email_empresa, cd_senha_empresa, cd_tipo_usuario)
			values(:NOME_EMPRESA, :APELIDO_EMPRESA, :EMAIL_EMPRESA, md5(:SENHA), :TIPO)", 
			array(
					":NOME_EMPRESA"=>$nm,
					":APELIDO_EMPRESA"=>$apelido,
					":EMAIL_EMPRESA"=>$email,
					":SENHA"=>$pass,						
					":TIPO"=>2
			));

	}

	//Fazer login da empresa no site
	public function loginEmpresa($email, $pass) {
			$conn = new Sql();
			$result = $conn->Select("SELECT cd_empresa FROM empresa where nm_email_empresa = :EMAIL_EMPRESA and cd_senha_empresa = md5(:SENHA)",
			 array(
			 	":EMAIL_EMPRESA"=> $email,
			 	":SENHA"=> $pass
			 ));
			 if(count($result) > 0) {
			 	return $result[0]['cd_empresa'];
			 }
			 return false;			
		}

	//Carrega Empresa pelo código
	public function loadByIdEmpresa($id) {
			$conn = new Sql();
			$results = $conn->Select("SELECT * FROM empresa WHERE cd_empresa = :ID", array(":ID"=>$id));
			if(count($results) > 0){	
				return $results[0];
			}
			return false;
		}

	//Seleciona o(s) jogo(s) que a empresa possui 
	public function getGame($id) {
		$conn = new Sql();
		$results = $conn->Select("SELECT j.cd_jogo , j.nm_jogo, j.ds_sinopse FROM Jogo j 
								  INNER JOIN  empresa_jogo ej ON (ej.cd_jogo = j.cd_jogo) 
								  WHERE ej.cd_empresa = :ID", array(":ID"=>$id));
		if(count($results) > 0) {
			return $results;
		}
	}
	
	public function updateEmpresa($nm, $ds, $id) {
		$conn = new Sql();
		$conn->Query("UPDATE empresa SET nm_empresa = :NOME, ds_empresa = :DESCRICAO WHERE cd_empresa = :ID;", array(
			":NOME"=>$nm,
			":DESCRICAO"=>$ds,
			":ID"=>$id
		));
	}

	public function valueofGame($type, $value = 0) {
		if($type == 'on') {
			$_SESSION['error'][3] = 'Método de pagamento não selecionado, por favor selecione um!.';
			header('location: envioJogo.php');

		}
		if($type == 'pago'){
			if($value <= 0 && is_integer()){
				$_SESSION['error'][0] = 'Valor do jogo não aceito, por favor colocar um valor valido ou colocar gratuito';	
				header('location: envioJogo.php');	
			}
			$value = str_replace(',', '.', $value);
			if(!is_numeric($value)) {
				$_SESSION['error'][1] = "Valor digitado não é numérico!";
				header('location: envioJogo.php');
			}
			return true;
		}
		return false;
	}



	public function photoGame($filePhoto) {
		if ($filePhoto['error'] == 4) {
				$_SESSION['error'][1] = 'Não foi selecionado imagens do jogo, 5 imagens requiridas!.';
				header('location: envioJogo.php');
		}
	}
}

?>