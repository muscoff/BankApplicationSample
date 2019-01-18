<?php
session_start();
if($_SESSION['user']){  
	include $_SERVER['DOCUMENT_ROOT'].'/bank/admin/includes/header.php';
?>

<div class="center"><span class="black-text title">Create Customer Account</span></div>
<div class="divider"></div>
<div class="container">
	<div class="row">
		<div class="input-field col l6 m6 s12">
          <input placeholder="First Name" id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col l6 m6 s12">
          <input placeholder="Last Name" id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <input placeholder="Placeholder" id="branch" type="text" class="validate">
          <label for="branch">Branch</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <input placeholder="+233247899003" id="phoneNumber" type="text" class="validate">
          <label for="phoneNumber">Phone Number</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <input placeholder="Nationality" id="national" type="text" class="validate">
          <label for="nationality">Nationality</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <input placeholder="Residential Address" id="resAddr" type="text" class="validate">
          <label for="resAddr">Residential Address</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <input placeholder="Occupation" id="occupation" type="text" class="validate">
          <label for="occupation">Occupation</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <input placeholder="Identification Number" id="IdNumber" type="text" class="validate">
          <label for="IdNumber">Identification Number</label>
        </div>
        <div class="input-field col l4 m4 s12">
          <select id="id_type">
		      <option value="" disabled selected>Select Id Type</option>
		      <option value="Passport">Passport</option>
		      <option value="Voter's Id">Voter's Id</option>
		      <option value="Driver's Licence">Driver's Licence</option>
		  </select>
		    <label>ID Type</label>
        </div>
        <div class="col l8 m8 s12"><br>
        	<div class="right"><button class="btn" id="btn" onclick="createAccount()">Create Account</button></div>
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