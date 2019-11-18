<?php



class Department{
	//Department data variables.
	
	var $DepartmentID;
	var $DepartmentName;
	var $DepartmentManagerID;

	
	//Getters and setters
	
	//Department Manager ID
	private function getDepartmentManagerID(){
		return $this->DepartmentManagerID;
	}
	private function setDepartmentManagerID($DepartmentManagerID){
		$this->DepartmentManagerID=$DepartmentManagerID;
	}
	//Department Name
	private function getDepartmentName(){
		return $this->DepartmentName;
	}
	private function setDepartmentName($DepartmentName){
		$this->DepartmentName=$DepartmentName;
	}
	//Department ID
	private function getDepartmentID(){
		return $this->DepartmentID;
	}
	
	private function setDepartmentID(){
		$key = true;
		$index = 1;		
		require_once "connect.php";	
		
	//While loop to make new Department smallest available integer.
	while ($key){
		$sql ="SELECT * FROM `department` WHERE `DepartmentID` ='".$index."'";
		$result = mysqli_query($conn, $sql);	
		if(mysqli_num_rows($result)>0){
			$index++;
			}else{
			$this->DepartmentID = $index;
			$key = false;
			}	
		}
	}
	//Functions for Department Class Use.
	

	//Public functtion to create a new Manager and save to the database.
	public function newDepartment($DepartmentName,$DepartmentManagerID){
		$this->DepartmentName = $DepartmentName;
		$this->DepartmentManagerID = $DepartmentManagerID;
		$this->setDepartmentID();		
		include "connect.php";
		$sql= "INSERT INTO department (DepartmentID, DepartmentName, DepartmentManagerID) VALUES ('$this->DepartmentID', '$this->DepartmentName', '$this->DepartmentManagerID')";			
		mysqli_query($conn, $sql);
		echo '<center> Department Added Successfully. </center>';	
	}
	
	//Public function to set the values in an Department.
	public function makeDeparment($DepartmentID){		
		
		$this->DepartmentID = $DepartmentID;
		
		include "connect.php";
		$sql ="SELECT DepartmentName, DepartmentManagerID FROM `department` WHERE `DepartmentID` ='".$DepartmentID."'";
		$result = mysqli($conn, $sql);
		while($row=$result->fetch_row()){
			$this->DepartmentName=$row[0];
			$this->DepartmentManagerID=$row[1];
		}		
	}
	
	//Update Function for Department in database
	public function updateDepartment(){
		
		include "connect.php";	
		$sql= "UPDATE `department` SET DepartmentName = '".$this->DepartmentName."', DepartmentManagerID = '".$this->DepartmentManagerID."' WHERE `DepartmentID` = '".$this->DepartmentID."'";
		mysqli_query($conn, $sql);
		echo '<center> Department Updated Successfully. </center>';	
	}
	
	
	//Delete an Department,
	public function deleteDepartment($DepartmentID){
		include "connect.php";
		$sql="DELETE FROM `department` WHERE `DepartmentID` = '".$DepartmentID."'";
		mysqli_query($conn, $sql);
	}
	
	
}
 ?>