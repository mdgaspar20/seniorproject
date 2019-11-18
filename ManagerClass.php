<?php



class Manager{
	//Manager data variables.
	
	var $ManagerID;
	var $ManagerFirst;
	var $ManagerLast;
	var $ManagerLogin;
	var $ManagerPassword;
	var $DeptNum;
	var $Email;
	
	//Getters and setters
	
	//First name
	private function getManagerFirst(){
		return $this->ManagerFirst;
	}
	private function setManagerFirst($ManagerFirst){
		$this->ManagerFirst=$ManagerFirst;
	}
	//Last name
	private function getManagerLast(){
		return $this->ManagerLast;
	}
	private function setManagerLast($ManagerLast){
		$this->ManagerLast=$ManagerLast;
	}
	//Department Number
	private function getDeptNum(){
		return $this->DeptNum;
	}
	private function setDeptNum($DeptNum){
		$this->DeptNum=$DeptNum;
	}
	

	//Manager User Name
	private function getManagerLogin(){
		return $this->ManagerLogin;
	}
	private function setManagerLogin($ManagerLogin){
		$this->ManagerLogin=$ManagerLogin;
	}
	//Password
	private function getManagerPassword(){
		return $this->ManagerPassword;
	}
	private function setManagerPassword($ManagerPassword){
		$this->ManagerPassword=$ManagerPassword;
	}
	
		//Email
	private function getEmail(){
		return $this->Email;
	}
	private function setEmail($Email){
		$this->Email=$Email;
	}
	
	//Primary Key User ID
	private function getManagerID(){
		return $this->ManagerID;
			
	}	
	private function setManagerID(){
		$key = true;
		$index = 1;		
		require_once "connect.php";	
		
	//While loop to make new Manager smallest available integer.
	while ($key){
		$sql ="SELECT * FROM `manager` WHERE `ManagerID` ='".$index."'";
		$result = mysqli_query($conn, $sql);	
		if(mysqli_num_rows($result)>0){
			$index++;
			}else{
			$this->ManagerID = $index;
			$key = false;
			}	
		}
	}
	
	
	
	//Functions for Manager Class Use.
	

	//Public function to create a new Manager and save to the database.
	public function newManager($ManagerFirst,$ManagerLast,$DeptNum,$ManagerLogin,$Email, $ManagerPassword){
		$this->ManagerFirst = $ManagerFirst;
		$this->ManagerLast = $ManagerLast;
		$this->DeptNum = $DeptNum;
		$this->ManagerLogin = $ManagerLogin;
		$this->ManagerPassword = $ManagerPassword;
		$this->Email=$Email;
		//Encryption not tested.
		$EncryptedPassword = md5($ManagerPassword);
		$this->setManagerID();		
		include "connect.php";
		$sql= "INSERT INTO manager (ManagerID, ManagerFirst, ManagerLast,ManagerLogin, ManagerPassword,DeptNum,Email) VALUES ('$this->ManagerID', '$this->ManagerFirst', '$this->ManagerLast', '$this->ManagerLogin',  '$EncryptedPassword', '$this->DeptNum', '$this->Email')";			
		mysqli_query($conn, $sql);
		echo '<center> Manager Added Successfully. </center>';	
	}
	
	//Public function to set the values in an Manager.
	public function makeManager($ManagerID){		
		
		$this->ManagerID = $ManagerID;
		
		include "connect.php";
		$sql ="SELECT `ManagerFirst`, ManagerLast, DeptNum, Email, ManagerLogin FROM `manager` WHERE `ManagerID` ='".$ManagerID."'";
		
		$result = mysqli_query($conn,$sql);
		while($row=$result->fetch_row()){
			$this->ManagerFirst=$row[0];
			$this->ManagerLast=$row[1];
			$this->DeptNum=$row[2];
			$this->Email=$row[3];
			$this->ManagerLogin=$row[4];
			}

	}
	
	//Update Function for Manager in database
	public function updateManager(){
		
		include "connect.php";	
		$sql= "UPDATE `manager` SET ManagerFirst = '".$this->ManagerFirst."', ManagerLast = '".$this->ManagerLast."', DeptNum = '".$this->DeptNum."', ManagerLogin = '".$this->ManagerLogin."' WHERE `ManagerID` = '".$this->ManagerID."'";
		mysqli_query($conn, $sql);
		echo '<center> Manager Updated Successfully. </center>';	
	}
	
	
	//Delete an Manager,
	public function deleteManager(){
		include "connect.php";
		$sql="DELETE FROM `manager` WHERE `ManagerID` = '$this->ManagerID'";
		mysqli_query($conn, $sql);
	}
	
	
}

 ?>