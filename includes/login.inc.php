<?php  

class Login extends DBH {
	public function UserLogin($username, $password){
		$Username = $username; $Password = $password;
		if(!empty($Username) && !empty($Password)){
			session_start();
			$STH = $this->Dbh()->prepare("SELECT * FROM `users` WHERE `username`=? AND `password`=?");
			$STH->execute([$username, $password]);
			if($STH->rowCount()){
				$data = $STH->fetch(PDO::FETCH_OBJ);
				$_SESSION['user'] = $data->username;
				//echo 'admin/index.php';
				//echo 'true';
				$arrayName = array('validate' => true, 'name'=>$data->username );
				echo json_encode($arrayName);
			}else{
				$error = array('message' => 'Not Found', 'validate'=>false );
				echo json_encode($error);
			}
		}
	}
}

?>
