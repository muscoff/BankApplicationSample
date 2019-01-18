<?php  
header("Access-Control-Allow-Origin: *");
include $_SERVER['DOCUMENT_ROOT'].'/bank/includes/dbh.inc.php';
include $_SERVER['DOCUMENT_ROOT'].'/bank/includes/account.inc.php';

if(isset($_POST['accNum']) && !empty($_POST['accNum'])){
	$accNum = $_POST['accNum'];
	$amount = $_POST['deposit'];

	$account = new Account;
	$account->depositFunds($accNum, $amount);
	//$account->initializeAccount();
	//echo $username.' and '.$password;
}else{
	$arrayName = array('error' => 'Input is required');
	echo json_encode($arrayName);
}

?>