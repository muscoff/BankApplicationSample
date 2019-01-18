function accInfo(){
	var fullName = document.getElementById('full_name');
	var btn = document.getElementById('btn');
	var currentBalance = document.getElementById('current_b');
	var availableBalance = document.getElementById('available_b');
	var branch = document.getElementById('branch');
	var input = encodeURIComponent(document.getElementById('accNum').value);
	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'http://localhost/Bank/api/depositDetails.php?accNum='+input, true);
	xhr.onload = function(){
		if(xhr.status==200 && xhr.readyState==4){
			var result = JSON.parse(xhr.responseText);
			if(result.isValid==true){
				fullName.setAttribute('value', result.name);
				currentBalance.setAttribute('value', result.c_balance);
				availableBalance.setAttribute('value', result.av_balance);
				branch.setAttribute('value', result.branch);
				btn.removeAttribute('disabled');
			}else{
				btn.setAttribute('disabled', true);
				fullName.setAttribute('value', '');
				currentBalance.setAttribute('value', '');
				availableBalance.setAttribute('value', '');
				branch.setAttribute('value', '');
			}
		}
	}
	xhr.send();
	setTimeout(accInfo, 500);
}

function deposit(){
	var accNumHolder = document.getElementById('accNum');
	var accNum = document.getElementById('accNum').value;
	var amount = document.getElementById('amount').value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'http://localhost/Bank/api/depositFunds.php', true);
	var params = 'accNum='+accNum+'&deposit='+amount;
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(xhr.status==200 && xhr.readyState==4){
			var result = JSON.parse(xhr.responseText);
			if(result.transact==true){
				M.toast({html: result.message, completeCallback: function(){location.reload()}});
			}
		}
	}
	xhr.send(params);
}

function withdrawFunds(){
	var accNumHolder = document.getElementById('accNum');
	var accNum = document.getElementById('accNum').value;
	var amount = document.getElementById('amount').value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'http://localhost/Bank/api/withdrawFunds.php', true);
	var params = 'accNum='+accNum+'&withdraw='+amount;
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(xhr.status==200 && xhr.readyState==4){
			var result = JSON.parse(xhr.responseText);
			if(result.transact==true){
				M.toast({html: result.message, completeCallback: function(){location.reload()}});
			}
		}
	}
	xhr.send(params);
}

function createAccount(){
		var validate = document.getElementsByClassName('validate').length;
		var inputField = document.getElementsByClassName('validate');
		var count = 0;

		for(var i=0; i<validate; i++){
			if(inputField[i].value==''){
				count= count+1;
			}
		}

		var firstName = document.getElementById('first_name').value;
		var lastName = document.getElementById('last_name').value;
		var branch = document.getElementById('branch').value;
		var phoneNum = document.getElementById('phoneNumber').value;
		var nationality = document.getElementById('national').value;
		var resAddress = document.getElementById('resAddr').value;
		var occupation = document.getElementById('occupation').value;
		var idNumber = document.getElementById('IdNumber').value;
		var idType = document.getElementById('id_type');
		var idValue = idType[idType.selectedIndex].value;

		if(idValue!=='' & count==0){
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'http://localhost/Bank/api/registerAccount.php', true);
			var params = 'fn='+firstName+'&ln='+lastName+'&b='+branch+'&num='+phoneNum+
			'&natnal='+nationality+'&res_add='+resAddress+'&occ='+occupation+
			'&Id_No='+idNumber+'&id_type='+idValue;
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.onload = function(){
				if(xhr.status==200 && xhr.readyState==4){
					//console.log(xhr.responseText);
					var response = JSON.parse(xhr.responseText);
					if(response.isInitialized==true){
						M.toast({html: response.message, completeCallback: function(){location.reload()}});
					}
				}
			}
			xhr.send(params);
			//M.toast({html: 'Full Name : '+firstName+' '+lastName+' Branch: '+branch});
		}
		else {
			M.toast({html: 'Please make sure all the input field are filled!'});
		}
	}



document.addEventListener('DOMContentLoaded', function() {
     accInfo();
  });