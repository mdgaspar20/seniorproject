<?php

class employee{
	//Employee data variables.
	
	var $fname;
	var $lname;
	var $EmployeeID;
	var $DeptNum;
	var $role;
	var $password;
	var $EmployeeLogin;
	var $Email;
	
	//Getters and setters
	
	//First name
	public function getfname(){
		return $this->fname;
	}
	public function setfname($fname){
		$this->fname=$fname;
	}
	//Last name
	public function getlname(){
		return $this->lname;
	}
	public function setlname($lname){
		$this->lname=$lname;
	}
	//Department Number
	public function getDeptNum(){
		return $this->DeptNum;
	}
	public function setDeptNum($DeptNum){
		$this->DeptNum=$DeptNum;
	}
	//Employee role/position title
	public function getrole($role){
		return $this->role;
	}
	private function setrole($role){
		$this->role=$role;
	}
	//Employee User Name
	public function getemployeeLogin(){
		return $this->EmployeeLogin;
	}
	public function setemployeeLogin($EmployeeLogin){
		$this->EmployeeLogin=$EmployeeLogin;
	}
	//Password
	private function getpassword(){
		return $this->password;
	}
	private function setpassword($password){
		$this->password=$password;
	}
	//Email
	public function getEmail(){
		return $this->Email;
	}
	public function setEmail($Email){
		$this->Email=$Email;
	}
	
	
	//Primary Key User ID
	public function getEmpID(){
		return $this->EmployeeID;
			
	}	
	private function setEmpID(){
		$key = true;
		$index = 1;		
		require_once "connect.php";	
		
	//While loop to make new employee smallest available integer.
	while ($key){
		$sql ="SELECT * FROM `employee` WHERE `EmployeeID` ='".$index."'";
		$result = mysqli_query($conn, $sql);	
		if(mysqli_num_rows($result)>0){
			$index++;
			}else{
			$this->EmployeeID = $index;
			$key = false;
			}	
		}
	}
	
	
	//Functions for Employee Class Use.
	
	
	//Public function to create a new employee and save to the database.
	public function newEmployee($fname,$lname,$DeptNum,$EmployeeLogin,$Email, $password, $role){
		$this->fname = $fname;
		$this->lname = $lname;
		$this->DeptNum = $DeptNum;
		$this->role = $role;
		$this->EmployeeLogin = $EmployeeLogin;
		$this->password = $password;
		$this->Email=$Email;
		//Encryption not tested.
		$EncryptedPassword = md5($password);
		$this->setEmpID();		
		
		include "connect.php";
		$sql= "INSERT INTO employee (EmployeeID, fname, lname, DeptNum, EmployeeLogin, Email, password, role) VALUES ('$this->EmployeeID', '$this->fname', '$this->lname', '$this->DeptNum', '$this->EmployeeLogin', '$this->Email', '$EncryptedPassword', '$this->role')";			
		mysqli_query($conn, $sql);
		echo '<center> Employee Added Successfully. </center>';	
	}
	
	//Public function to set the values in an employee.
	public function makeEmployee($EmployeeID){		
		
		$this->EmployeeID = $EmployeeID;
		
		include "connect.php";
		$sql ="SELECT Fname,Lname,DeptNum,EmployeeLogin,Email FROM `employee` WHERE `EmployeeID` ='".$EmployeeID."'";
		
		
		$result = mysqli_query($conn,$sql);
		while($row=$result->fetch_row()){
			$this->fname=$row[0];
			$this->lname=$row[1];
			$this->DeptNum=$row[2];
			$this->EmployeeLogin=$row[3];
			$this->Email=$row[4];
			}
	}
	public function printEmp(){
		print_r($this->fname);
		print_r($this->lname);
		print_r($this->DeptNum);
		print_r($this->EmployeeLogin);
		print_r($this->Email);
	}
	
	//Update Function for Employee in daatabase
	public function updateEmployee(){
		
		include "connect.php";	
		$sql= "UPDATE `employee` SET Fname = '".$this->fname."', Lname = '".$this->lname."', DeptNum = '".$this->DeptNum."', EmployeeLogin = '".$this->EmployeeLogin."' WHERE `EmployeeID` = '".$this->EmployeeID."'";
		mysqli_query($conn, $sql);
		echo '<center> Employee Updated Successfully. </center>';	
	}
	
	
	//Delete an employee,
	public function deleteEmployee(){
		include "connect.php";
		$sql="DELETE FROM `employee` WHERE `EmployeeID` = '".$this->EmployeeID."'";
		mysqli_query($conn, $sql);
	}
	
}

 ?>
