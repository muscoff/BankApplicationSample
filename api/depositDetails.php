<?php  
header("Access-Control-Allow-Origin: *");
include $_SERVER['DOCUMENT_ROOT'].'/bank/includes/dbh.inc.php';
include $_SERVER['DOCUMENT_ROOT'].'/bank/includes/account.inc.php';

if(isset($_GET['accNum']) && !empty($_GET['accNum'])){
	$accNum = $_GET['accNum'];

	$account = new Account;
	$account->getAccDetail($accNum);
	//$account->initializeAccount();
	//echo $username.' and '.$password;
}else{
	$arrayName = array('error' => 'Input is required');
	echo json_encode($arrayName);
}

?>