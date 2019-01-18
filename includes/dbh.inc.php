<?php  

class DBH {
	private $host;
	private $user;
	private $pass;
	private $database;

	public function __construct(){
		//$this->Dbh();
	}

	public function Dbh(){
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";
		$this->database = "bank";

		try {
			$DBH = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->pass);
			return $DBH;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>