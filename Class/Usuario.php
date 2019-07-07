<?php 

Class Usuario extends Sql {

	private $id;
	private $nome;
	private $email;
	private $cartao;
	private $apelido;


	// Get's & Set's

	public function getId() {
		return $this->id;
	}

	public function getNome() {
		return $this->nome;
	}

	private function setNome($nome){
		$this->nome = $nome;
	}

	public function getEmail() {
		return $this->email;
	}

	private function setEmail($email){
		$this->email = $email;
	}

	public function getCartao() {
		return $this->cartao;
	}

	private function setCartao($cartao) {
		$this->cartao = $cartao;
	}

	public function getCpf() {
		return $this->cpf;
	}

	private function setCpf($cpf) {
		$this->cpf = $cpf;
	}

	public function getApelido() {
		return $this->apelido;
	}

	private function setApelido($apelido) {
		$this->apelido = $apelido;
	}




	// Verifica no banco se já existe um email cadastrado
	public function verificarBanco($email) {
		$conn = new Sql();
		$results = $conn->Select("SELECT id_usuario FROM usuario WHERE nm_email = :EMAIL",
		array(
			":EMAIL" => $email
		));
		if(count($results) > 0){
			return false;
		}
		return true;
	}

	public function inserirUsuario($nm, $user, $email, $pass, $nasc, $sex) {
		$conn = new Sql();
		$conn->Query("INSERT INTO usuario (nm_email, cd_senha, nm_usuario, nm_apelido, dt_nascimento, sg_sexo, cd_tipo_usuario)
			values(:EMAIL, md5(:SENHA), :USUARIO, :APELIDO, :NASC, :SEXO, :TIPO)", 
			array(
					":EMAIL"=>$email,
					":SENHA"=>$pass,
					":USUARIO"=>$nm,
					":APELIDO"=>$user,
					":NASC"=>$nasc,
					":SEXO"=>$sex,
					":TIPO"=>2
			));

	}

		
	public function Login($email, $pass) {
		$conn = new Sql();
		$result = $conn->Select("SELECT id_usuario FROM usuario where nm_email = :EMAIL and cd_senha = md5(:SENHA) ",
		 array(
		 	":EMAIL"=> $email,
		 	":SENHA"=> $pass
		 ));
		 if(count($result) > 0) {
		 	return $result[0]['id_usuario'];
		 }
		 return false;			
	}


	public function loadById($id) {
		$conn = new Sql();
		$results = $conn->Select("SELECT * FROM usuario WHERE id_usuario = :ID", array(":ID"=>$id));
		if(count($results) > 0){	
			$this->setData($results[0]);
		}
		return false;
	}

	private function setData($data) {
		$this->setEmail($data['nm_email']);
		$this->setNome($data['nm_usuario']);
		$this->setCpf($data['cd_cpf']);
		$this->setCartao($data['cd_cartao']);
		$this->setApelido($data['nm_apelido']);
	}


	public function getPhoto($userid) {
		$this->loadById($userid);
		$filename = $userid . "_perfil.jpg";
		$root = $_SERVER['DOCUMENT_ROOT'] . '/TCCProgamacao/images/user/';
		if(!file_exists($root . $filename)){
			echo '<img src="images/user/default-user.png" width="100%" style="display: block;"/>';
		}
		else {
			echo '<img src="images/user/'.$filename.'" width="100%" style="display: block;"/>';
		}
	}

	public function getWallP($userid) {
		$this->loadById($userid);
		$filename = $userid ."_wp.jpg";
		$root = $_SERVER['DOCUMENT_ROOT'] . '/TCCProgamacao/images/user/';
		if(!file_exists($root . $filename)){
			echo '<img src="images/user/default-wp.jpg" width="100%" style="display: block;"/>';
		}
		else {
			echo '<img src="images/user/'.$filename.'" width="100%" style="display: block;"/>';
		}	
	}

	public function changeName($apelido, $userid) {
		$sql = new Sql();
		$sql->Query("UPDATE Usuario set nm_apelido = :APELIDO where id_usuario = :ID",
		array(
			':APELIDO'=>$apelido,
			':ID'=>$userid
		));
	}

	public function changePhoto($photo, $userid, $perfilPhoto = 'perfil') {
		if($photo['type'] != "image/jpeg"){
			$_SESSION['error'][0] = "Tipo de imagem não suportada. Somente imagens .jpg ou .jpeg";
			header('location: editarUsuario.php?u='.$userid);
		}

		if($perfilPhoto == 'perfil') {
			$nameImg = $userid."_perfil.jpg";
		}
		else {
			$nameImg = $userid."_wp.jpg";
		}
		$locationImg = "images/user/".$nameImg;
		move_uploaded_file($photo['tmp_name'], $locationImg);
	}

}
 ?>