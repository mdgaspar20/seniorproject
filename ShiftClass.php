<?php



class Shift{
	//Shift data variables.
	
	var $ShiftID;
	var $StartTimeHour;
	var $EndTimeHour;
	var $DayNum;
	var $StartTimeMinute;
	var $EndTimeMinute;
	
	
	//Getters and setters
	
	//Start Hour
	private function getStartTimeHour(){
		return $this->StartTimeHour;
	}
	private function setStartTimeHour($StartTimeHour){
		$this->StartTimeHour=$StartTimeHour;
	}
	//End Hour
		private function getEndTimeHour(){
		return $this->EndTimeHour;
	}
	private function setEndTimeHour($EndTimeHour){
		$this->EndTimeHour=$EndTimeHour;
	}
	
	//Day Num
	private function getDayNum(){
		return $this->DayNum;
	}
	private function setDayNum($DayNum){
		$this->DayNum=$DayNum;
	}
	//Start Minute
	private function getStartTimeMinute(){
		return $this->StartTimeMinute;
	}
	private function StartTimeMinute($StartTimeMinute){
		$this->StartTimeMinute=$StartTimeMinute;
	}
	

	//End Minute
	private function getEndTimeMinute(){
		return $this->EndTimeMinute;
	}
	private function setEndTimeMinute($EndTimeMinute){
		$this->EndTimeMinute=$EndTimeMinute;
	}

	//Primary Key Shift ID
	private function getShiftID(){
		return $this->ShiftID;
			
	}	
	private function setShiftID(){
		$key = true;
		$index = 1;		
		require_once "connect.php";	
		
	//While loop to make new Shift smallest available integer.
	while ($key){
		$sql ="SELECT * FROM `shift` WHERE `ShiftID` ='".$index."'";
		$result = mysqli_query($conn, $sql);	
		if(mysqli_num_rows($result)>0){
			$index++;
			}else{
			$this->ShiftID = $index;
			$key = false;
			}	
		}
	}
	
	
	
	//Functions for Shift Class Use.
	

	//Public function to create a new Shift and save to the database.
	public function newShift($StartTimeHour,$EndTimeHour,$DayNum,$StartTimeMinute, $EndTimeMinute){
		$this->StartTimeHour = $StartTimeHour;
		$this->EndTimeHour = $EndTimeHour;
		$this->DayNum = $DayNum;
		$this->StartTimeMinute = $StartTimeMinute;
		$this->EndTimeMinute = $EndTimeMinute;
	
		$this->setShiftID();		
		include "connect.php";
		$sql= "INSERT INTO shift (ShiftID, StartTimeHour, EndTimeHour,DayNum, StartTimeMinute,EndTimeMinute) VALUES ('$this->ShiftID', '$this->StartTimeHour', '$this->EndTimeHour', '$this->DayNum',  '$this->StartTimeMinute', '$this->EndTimeMinute')";			
		mysqli_query($conn, $sql);
		echo '<center> Shift Added Successfully. </center>';	
	}
	
	//Public function to set the values in a Shift.
	public function makeShift($ShiftID){		
		
		$this->ShiftID = $ShiftID;
		
		include "connect.php";
		$sql ="SELECT `StartTimeHour` FROM `shift` WHERE `ShiftID` ='".$ShiftID."'";
		$this->StartTimeHour = mysqli_query($conn, $sql);
		
		$sql ="SELECT `EndTimeHour` FROM `shift` WHERE `ShiftID` ='".$ShiftID."'";	
		$this->EndTimeHour	= mysqli_query($conn, $sql);
	
		$sql ="SELECT `DayNum` FROM `shift` WHERE `ShiftID` ='".$ShiftID."'";	
		$this->DayNum = mysqli_query($conn, $sql);
		

		$sql ="SELECT `StartTimeMinute` FROM `shift` WHERE `ShiftID` ='".$ShiftID."'";	
		$this->StartTimeMinute = mysqli_query($conn, $sql);		
		
		$sql ="SELECT `EndTimeMinute` FROM `shift` WHERE `ShiftID` ='".$ShiftID."'";	
		$this->EndTimeMinute	= mysqli_query($conn, $sql);	
	}
	
	//Update Function for Shift in database
	public function updateShift($StartTimeHour,$EndTimeHour,$DayNum, $StartTimeMinute, $EndTimeMinute){
		
		include "connect.php";	
		$sql= "UPDATE `shift` SET StartTimeHour = '".$this->StartTimeHour."', EndTimeHour = '".$this->EndTimeHour."', DayNum = '".$this->DayNum."', StartTimeMinute = '".$this->StartTimeMinute."', EndTimeMinute = '".$this->EndTimeMinute."' WHERE `ShiftID` = '".$this->ShiftID."'";
		mysqli_query($conn, $sql);
		echo '<center> Shift Updated Successfully. </center>';	
	}
	
	
	//Delete a Shift.
	public function deleteShift(){
		include "connect.php";
		$sql="DELETE FROM `shift` WHERE `ShiftID` = '$this->ShiftID'";
		mysqli_query($conn, $sql);
	}
	
	
}

 ?>