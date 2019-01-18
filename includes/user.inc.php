<?php  

class User extends DBH{
	public function getUsers(){
		//$dick = null;
		$STH = $this->Dbh()->prepare("SELECT * FROM `users`");
		$STH->execute();
		//$row = $STH->fetchAll(PDO::FETCH_OBJ);
		//return json_encode($row);
		while($row = $STH->fetch(PDO::FETCH_OBJ)){
			 echo '<div class="col l3 s6"><p>'.$row->username.'</p><p>'.$row->password.'</p></div>';
			//echo '<p>'.$row->username.'</p>';
		}
	}

	public function getUserCheck(){
		$id = 1;
		$username = 'ama';

		$STH = $this->Dbh()->prepare("SELECT * FROM `users` WHERE `id`=? AND `username`=?");
		$STH->execute([$id, $username]);
		if($STH->rowCount()){
			$data = $STH->fetch(PDO::FETCH_OBJ);
			//return $data->password;
			return $arrayName = array('id' => $id, 'username' => $username);
		}
	}

	public function changePass(){
		$name = $this->getUserCheck();
		$id = $name['id'];
		echo $id;
		//$name = 'mussy';
		//echo $name;
		//$arrayName = array('name' => 'mussy', 'money'=>1000 );
		//return $arrayName;
	}
}

?>