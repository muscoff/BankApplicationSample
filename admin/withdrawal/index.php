<?php
session_start();
if($_SESSION['user']){  
	include $_SERVER['DOCUMENT_ROOT'].'/bank/admin/includes/header.php';
?>

<div class="center"><span class="green-text title">Funds Withdrawal</span></div>
<div class="divider"></div>
<!-- <div class="container"> -->
	<div class="row">
		<div class="col l8 m8 s12">
			<div class="container">
				<div class="row">
					<div class="input-field col l12 m12 s12">
			          <input placeholder="Full Name" id="full_name" value="" type="text" class="validate" disabled>
			          <label for="full_name">Full Name</label>
			        </div>
			        <div class="input-field col l6 m6 s12">
			          <input placeholder="Current Balance" id="current_b" value="" type="text" class="validate" disabled>
			          <label for="current_b">Current Balance</label>
			        </div>
			        <div class="input-field col l6 m6 s12">
			          <input placeholder="Available Balance" id="available_b" value="" type="text" class="validate" disabled>
			          <label for="available_b">Available Balance</label>
			        </div>
			        <div class="input-field col l6 m6 s12">
			          <input placeholder="Branch" id="branch" value="" type="text" class="validate" disabled>
			          <label for="branch">Branch</label>
			        </div>
				</div>
			</div>
		</div>

		<div class="col l4 m4 s12">
			<div class="container">
				<div class="input-field col l12 m12 s12">
			        <input placeholder="Acc No." id="accNum" value="" type="text" class="validate">
			        <label for="accNum">Acc No.</label>
			    </div>
			    <div class="input-field col l12 m12 s12">
			        <input placeholder="Amount" id="amount" value="" type="text" class="validate">
			        <label for="amount">Amount</label>
			    </div>
			    <div class="input-field col l12 m12 s12">
			        <button class="btn" id="btn" onclick="withdrawFunds()">Withdrawal</button>
			    </div>
			</div>
		</div>
	</div>
<!-- </div> -->


<?php
  include $_SERVER['DOCUMENT_ROOT'].'/bank/admin/includes/footer.php';
}
else{
	header('Location: /bank/');
}
?>