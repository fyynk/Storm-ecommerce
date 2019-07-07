<?php 

class Sql {

	const SERVER = "localhost";
	const USERNAME = "root";
	const PASSWORD = "root";
	const SCHEMA = "prjstorm";

	private $conn;

	function __construct() {
			$this->conn = new PDO(
			"mysql:host=".Sql::SERVER.";dbname=".Sql::SCHEMA,
			Sql::USERNAME,
			Sql::PASSWORD,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") // força o PDO iniciar com utf-8 NÂO RETIRAR!
			);

	}

	private function bindParam($statement, $identifier, $value) {
		$statement->bindParam($identifier, $value);
	}

	private function setParams($statement, $parameter = array()) {
		foreach($parameter as $key => $value) {
			$this->bindParam($statement, $key, $value);
		}
	}

	public function Select($rawQuery, $params = array()) {
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function Query($rawQuery, $params = array()){
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
	}
}



 ?>