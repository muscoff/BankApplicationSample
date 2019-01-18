<?php
session_start();
if($_SESSION['user']){  
	include $_SERVER['DOCUMENT_ROOT'].'/bank/admin/includes/header.php';
?>

	<div class="container">
		<div class="row">
			<div class="col l3 s6 card">
				<a href="acc-registration/">
					<div class="flexcontainer">
						<div class="sameHeight">
							<span class="blue-text title">Create Account</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col l3 s6 card">
				<a href="deposit-funds/">
					<div class="flexcontainer">
						<div class="sameHeight">
							<span class="green-text title">Deposit Funds</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col l3 s6 card">
				<a href="withdrawal/">
					<div class="flexcontainer">
						<div class="sameHeight">
							<span class="red-text title">Withdraw Funds</span>
						</div>
					</div>
				</a>
			</div>
			<div class="col l3 s6 card">
				<a href="staff-account-registration/">
					<div class="flexcontainer">
						<div class="sameHeight">
							<span class="orange-text title">Create Staff Account</span>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>


<?php
  include $_SERVER['DOCUMENT_ROOT'].'/bank/admin/includes/footer.php';
}
else{
	header('Location: /bank/');
}
?>