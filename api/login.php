<?php  
header("Access-Control-Allow-Origin: *");
include $_SERVER['DOCUMENT_ROOT'].'/bank/includes/dbh.inc.php';
include $_SERVER['DOCUMENT_ROOT'].'/bank/includes/login.inc.php';

if(isset($_POST['username']) && !empty($_POST['username'])){
	$username = $_POST['username'];
	$password =$_POST['password'];

	$login = new Login;
	$login->UserLogin($username, $password);
	//echo $username.' and '.$password;
}else{
	$arrayName = array('error' => 'Please make sure you enter both the username and the password correctly' );
	echo json_encode($arrayName);
}

?>