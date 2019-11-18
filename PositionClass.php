<?php



class Position{
	//Department data variables.
	var $PositionID;
	var $DeptNum;
	var $PositionName;


	
	//Getters and setters
	
	//Department Position ID
	private function getDeptNum(){
		return $this->DeptNum;
	}
	private function setDeptNum($DeptNum){
		$this->DeptNum=$DeptNum;
	}
	//Department Name
	private function getPositionName(){
		return $this->PositionName;
	}
	private function setPositionName($PositionName){
		$this->PositionNamePositionName=$PositionName;
	}
	
	//Primary Key PositionID
	private function getPositionID(){
		return $this->PositionID;
			
	}	
	private function setPositionID(){
		$key = true;
		$index = 1;		
		require_once "connect.php";	
		
	//While loop to make new Position smallest available integer.
	while ($key){
		$sql ="SELECT * FROM `positions` WHERE `PositionID` ='".$index."'";
		$result = mysqli_query($conn, $sql);	
		if(mysqli_num_rows($result)>0){
			$index++;
			}else{
			$this->PositionID = $index;
			$key = false;
			}	
		}
	}
	
	//Functions for Position Class Use.
	

	//Public functtion to create a new Position and save to the database.
	public function newPosition($DeptNum,$PositionName){
		$this->DeptNum = $DeptNum;
		$this->PositionName = $PositionName;
		$this->setPositionID();
		include "connect.php";
		$sql= "INSERT INTO positions (PositionID, DeptNum, PositionName) VALUES ('$this->PositionID','$this->DeptNum', '$this->PositionName')";			
		mysqli_query($conn, $sql);
		echo '<center> Position Added Successfully. </center>';	
	}
	
	//Public function to set the values in an employee.
	public function makePosition($PositionID){		
		
		$this->PositionID = $PositionID;
		
		include "connect.php";
		$sql ="SELECT `DeptNum`, PositionName FROM `positions` WHERE `PositionID` ='".$PositionID."'";
		$result= mysqli_query($conn, $sql);
		
		while ($row = $result->fetch_row()) {
			$this->DeptNum = $row[0];
			$this->PositionName = $row[1];
		}	
		
	}
	
	//Update Function for Positions in database
	public function updatePosition(){

		include "connect.php";	
		$sql= "UPDATE `positions` SET DeptNum = '".$this->DeptNum."', PositionName = '".$this->PositionName."' WHERE `PositionID` = '".$PositionID."'";
		mysqli_query($conn, $sql);
		echo '<center> Position Updated Successfully. </center>';	
	}
	
	
	//Delete an Manager,
	public function deletePosition($PositionID){
		include "connect.php";
		$sql="DELETE FROM `positions` WHERE `PositionID` = '".$PositionID."'";
		mysqli_query($conn, $sql);
	}

}
 ?>