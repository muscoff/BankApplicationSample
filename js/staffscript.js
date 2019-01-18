function createStaff(){
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
		var position = document.getElementById('position');
		var positionValue = position[position.selectedIndex].value;
		var idType = document.getElementById('id_type');
		var idValue = idType[idType.selectedIndex].value;
		if(idValue!=='' && positionValue!=='' && count==0){
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'http://localhost/Bank/api/staffAccount.php', true);
			var params = 'fn='+firstName+'&ln='+lastName+'&b='+branch+'&num='+phoneNum+
			'&natnal='+nationality+'&res_add='+resAddress+'&occ='+occupation+'&position='+
			positionValue+'&Id_No='+idNumber+'&id_type='+idValue;
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.onload = function(){
				if(xhr.status==200 && xhr.readyState==4){
					//console.log(xhr.responseText);
					 var response = JSON.parse(xhr.responseText);
					 if(response.isInitialized==true){
					 	M.toast({html: response.info});
					 }else{
					 	M.toast({html: response.error, completeCallback: function(){reloadPage();}});
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

	function reloadPage(){
		location.reload();
	}