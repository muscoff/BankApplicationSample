<?php  
	session_start();
	// include 'includes/dbh.inc.php';
	// include 'includes/user.inc.php';
	// $dbh = new User;
	

	//$dbh->getUserCheck();
	//var_dump($dbh->changePass());//
	//$dbh->changePass();
	// $user = new DBH;
	// $DBH = $user->Dbh();
	// $STH = $DBH->prepare("SELECT * FROM `users`");
	// $STH->execute();
	//echo $data = $dbh->getUsers();
	// foreach ($data as $key) {
	// 	echo $key->username.'<br>';
	// }
	// echo '<br>';
	// echo $dbh->getUserCheck();
	//$dbh->Dbh();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/materialize.min.js"></script>
</head>
<body>
	<div class="black" id="header">
		<div class="center"><span class="center yellow">UMB</span><span class="white-text"> - Universal Merchant Bank</span></div>
	</div>
	<div class="container-1">
		<div class="card" id="login">
			<div class="center"><h5>Login Form</h5></div>
			<div class="container">
				<div class="input-field">
					<input type="text" id="username" name="" placeholder="Username">
				</div>
				<div class="input-field">
					<input type="password" id="password" name="" placeholder="password">
				</div>
				<button class="btn" id="btn">Login</button>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		document.getElementById('btn').addEventListener('click', login);
		var username = document.getElementById('username').value;
		var password = document.getElementById('password').value;

		function login(){
			var username = document.getElementById('username').value;
			var password = document.getElementById('password').value;

			if(username!='' && password!=''){
				var xhr = new XMLHttpRequest();
				var params = 'username='+username+'&password='+password;
				xhr.open('POST', 'http://localhost/Bank/api/login.php', true);
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

				xhr.onload = function () {
					if(xhr.status==200 && xhr.readyState==4){
						var result = JSON.parse(xhr.responseText);
						if(result.validate==true){
							//console.log(result);
							window.location = '/bank/admin/';
						}else{
							M.toast({html: result.message});
						}
						//console.log(xhr);
						//console.log(xhr.responseText);
						//window.location = xhr.responseText;
					}
				}
				xhr.send(params);
			}else{
				alert('Please check the username and password');
			}
			//alert('Username: '+username +' Password: '+password);
		}
	</script>
</body>
</html>