<?php  

class Account extends DBH{
	private $account_number;
	private $amount;
	public function registerAccount($fn, $ln, $brnch, $num, $national, $res_add, $occ, $id_no, $id_type)
	{
		$firstname = $fn;
		$lastname = $ln;
		$branch = $brnch;
		$phoneNumber = $num;
		$nationality = $national;
		$residentialAddress = $res_add;
		$occupation = $occ;
		$identificationNumber = $id_no;
		$identificaitonType = $id_type;
		$accountNumber = rand(1000000,2000000);

		$STH = $this->Dbh()->prepare("INSERT INTO `acc_registration` (`firstName`,`lastName`,`branch`,`phoneNumber`, `nationality`, `resAddr`,`occupation`,`Id_No`,`id_type`, `acc_number`) VALUES ('$firstname', '$lastname', '$branch', '$phoneNumber', '$nationality', '$residentialAddress', '$occupation', '$identificationNumber', '$identificaitonType', '$accountNumber')");
		$STH->execute();
		if($STH->rowCount()>0){
			$arrayName = array('name' => $lastname.' '.$firstname, 'acc_no'=>$accountNumber );
			//return $arrayName;
			$account = $this->getAccountNumber();
			$acc_num = $account['account_number'];
			$acc_name = $account['name'];
			$this->initializeAccountBalance($acc_num, $acc_name);
		}
		
	}

	public function getAccountNumber(){
		$accountN = null;
		$STHacc_num = $this->Dbh()->prepare("SELECT * FROM `acc_registration` ORDER BY `id` DESC LIMIT 1");
		$STHacc_num->execute();
		if($STHacc_num->rowCount()>0){
			$data = $STHacc_num->fetch(PDO::FETCH_OBJ);
			$accountN = array('account_number'=>$data->acc_number, 'name'=>$data->firstName.' '.$data->lastName);
		} 
		return $accountN;
	}

	public function initializeAccountBalance($accNo, $accName){
		$this->account_number =$accNo;
		$ac =$this->account_number;
		$acc_holder_name = $accName;
		$STHinitial = $this->Dbh()->prepare("INSERT INTO `tranzaction` (`acc_num`) VALUES ('$ac')");
		$STHinitial->execute();
		if($STHinitial->rowCount()>0){
			$arrayName = array('message' => 'New Account has been created for '.$acc_holder_name, 'isInitialized'=>true);
			echo json_encode($arrayName);
		}
	}

	public function getAccDetail($accNum){
		$accountNum = $accNum;
		$STHgetD = $this->Dbh()->prepare("SELECT * FROM `tranzaction` WHERE `acc_num`='$accountNum'");
		$STHgetD->execute();
		if($STHgetD->rowCount()>0){
			$data = $STHgetD->fetch(PDO::FETCH_OBJ);
			$getname = $this->getAccountName($accountNum);
			$fullname = $getname['name'];
			$brnch = $getname['branch'];
			$cBalance = $data->current_balance;
			$aBalance = $data->available_balance;
			$details = array('c_balance'=>$cBalance, 'av_balance'=>$aBalance, 'name'=>$fullname, 'branch'=>$brnch, 'isValid'=>true);
			echo json_encode($details);
		}
		else{
			$arrayName = array('error' =>'Match not found', 'isValid' =>false );
			echo json_encode($arrayName);
		}
	}

	public function getAccountName($accNum){
		$accnum = $accNum;
		$STHgetAccName = $this->Dbh()->prepare("SELECT * FROM `acc_registration` WHERE `acc_number`='$accnum'");
		$STHgetAccName->execute();
		if($STHgetAccName->rowCount()>0){
			$getName = $STHgetAccName->fetch(PDO::FETCH_OBJ);
			$getNameArray = array('name' =>$getName->firstName.' '.$getName->lastName, 'branch'=>$getName->branch);
			return $getNameArray;
		}
	}

	public function depositFunds($accNum, $amount){
		$balance = $this->getBankBalance($accNum);
		$cBalance = $balance['currentB'];
		$aBalance = $balance['availableB'];
		$controlId = $balance['id'];
		$this->account_number = $accNum;
		$this->amount = $amount;
		$cBalance = $cBalance + $this->amount;
		$aBalance = $aBalance + $this->amount;
		$STHdeposit = $this->Dbh()->prepare("UPDATE `tranzaction` SET `current_balance`='$cBalance', `available_balance`='$aBalance', `deposit`='$this->amount' WHERE `acc_num`='$this->account_number' AND `id`='$controlId' ");
		$STHdeposit->execute();
		if($STHdeposit->rowCount()>0){
			$arrayName = array('message' => 'Transaction has been successful. An amount of '.$this->amount.' has been deposited into ACC_NUMBER: '.$this->account_number, 'transact'=>true );
			echo json_encode($arrayName);
		}else{
			$arrayName = array('error' => 'Transaction Failed' , 'transact'=>false );
		}
	}

	public function getBankBalance($accNum){
		$this->account_number = $accNum;
		$STHgetBalance = $this->Dbh()->prepare("SELECT * FROM `tranzaction` WHERE `acc_num`='$this->account_number'");
		$STHgetBalance->execute();
		if($STHgetBalance->rowCount()>0){
			$balance = $STHgetBalance->fetch(PDO::FETCH_OBJ);
			$balanceArray = array('currentB' => $balance->current_balance, 'availableB' => $balance->available_balance, 'id'=>$balance->id);
			return $balanceArray;
		}
	}

	public function withdrawFunds($accNum, $amount){
		$this->account_number = $accNum;
		$this->amount = $amount;
		$balance = $this->getBankBalance($this->account_number);
		$cBalance = $balance['currentB'];
		$aBalance = $balance['availableB'];
		$controlId = $balance['id'];
		$cBalance = $cBalance - $this->amount;
		$aBalance = $aBalance - $this->amount;
		$STHwithdraw = $this->Dbh()->prepare("UPDATE `tranzaction` SET `current_balance`='$cBalance', `available_balance`='$aBalance', `withdrawal`='$this->amount' WHERE `acc_num`='$this->account_number' AND `id`='$controlId' ");
		$STHwithdraw->execute();
		if($STHwithdraw->rowCount()>0){
			$arrayName = array('message' => 'Transaction has been successful. An amount of '.$this->amount.' has been withdrawn from ACC_NUMBER: '.$this->account_number, 'transact'=>true );
			echo json_encode($arrayName);
		}else{
			$arrayName = array('error' => 'Transaction Failed' , 'transact'=>false );
		}	
	}

	public function registerStaff($fn,$ln,$brnch,$num,$national,$res_add,$occ,$position,$id_no,$id_type){
		$firstN = $fn;
		$lastN = $ln;
		$branch = $brnch;
		$number = $num;
		$nationality = $national;
		$residentialAddr = $res_add;
		$occupation = $occ;
		$position = $position;
		$idNumber = $id_no;
		$idType = $id_type;
		$staffId = rand(10000000,200000000);

		$STHstaff = $this->Dbh()->prepare("INSERT INTO `staff_table` (`firstName`,`lastName`,`branch`,`phoneNumber`,`nationality`,`res_add`,`occupation`,`position`,`identityNumber`,`id_type`,`staffId`) VALUES ('$firstN','$lastN','$branch','$number','$nationality','$residentialAddr','$occupation','$position','$idNumber','$idType','$staffId')");
		$STHstaff->execute();
		if($STHstaff->rowCount()>0){
			$this->registerAccount($firstN,$lastN,$branch,$number,$nationality,$residentialAddr,$occupation,$idNumber,$idType);
		}else{
			$error = array('error' =>'Failed to create staff account. Please contact the IT Term for assistance');
			echo json_encode($error);
		}
	}
}

?>