<?php  
header("Access-Control-Allow-Origin: *");
include $_SERVER['DOCUMENT_ROOT'].'/bank/includes/dbh.inc.php';
include $_SERVER['DOCUMENT_ROOT'].'/bank/includes/account.inc.php';

if(isset($_POST['Id_No']) && !empty($_POST['Id_No'])){
	$firstname = $_POST['fn'];
	$lastname =$_POST['ln'];
	$branch = $_POST['b'];
	$phoneNumber = $_POST['num'];
	$nationality = $_POST['natnal'];
	$residentialAddress = $_POST['res_add'];
	$occupation = $_POST['occ'];
	$position = $_POST['position'];
	$identificationNumber = $_POST['Id_No'];
	$identificaitonType = $_POST['id_type'];

	$account = new Account;
	$account->registerStaff($firstname, $lastname,$branch,$phoneNumber,$nationality,$residentialAddress, $occupation, $position, $identificationNumber, $identificaitonType);
}

?>