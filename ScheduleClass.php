<?php



class Schedule{
	//Schedule data variables.
	
	var $ScheduledShiftsID;
	var $WeekID;
	var $ShiftID;
	var $EmployeeID;
	var $PostedFlag;
	var $ModRequest;
	var $ModReposted;
	var $Archived;
	
	//Getters and setters
	
	
	private function getArchived(){
		return $this->Archived;
	}
	private function setArchivedArchived($Archived){
		$this->Archived=$Archived;
	}
	
	private function getWeekID(){
		return $this->WeekID;
	}
	private function setWeekID($WeekID){
		$this->WeekID=$WeekID;
	}
	
	private function getShiftID(){
		return $this->ShiftID;
	}
	private function setShiftID($ShiftID){
		$this->ShiftID=$ShiftID;
	}
	
	private function getEmployeeID(){
		return $this->EmployeeID;
	}
	private function setEmployeeID($EmployeeID){
		$this->EmployeeID=$EmployeeID;
	}
	
	private function getPostedFlag(){
		return $this->PostedFlag;
	}
	private function setPostedFlag($PostedFlag){
		$this->PostedFlag=$PostedFlag;
	}
	
	private function getModRequest(){
		return $this->ModRequest;
	}
	private function setModRequest($ModRequest){
		$this->ModRequest=$ModRequest;
	}
	
	private function getModReposted(){
		return $this->ModReposted;
	}
	private function setModReposted($ModReposted){
		$this->ModReposted=$ModReposted;
	}
	
	//Primary Key Shift ID
	private function getScheduledShiftsID(){
		return $this->ModReposted;
			
	}	
	private function setScheduledShiftsID(){
		$key = true;
		$index = 1;		
		$index = 1;		
		require_once "connect.php";	
		
	//While loop to make new Schedule smallest available integer.
	while ($key){
		$sql ="SELECT * FROM `scheduledshifts` WHERE `ScheduledShiftsID` ='".$index."'";
		$result = mysqli_query($conn, $sql);	
		if(mysqli_num_rows($result)>0){
			$index++;
			}else{
			$this->ScheduledShiftsID = $index;
			$key = false;
			}	
		}
	}
	
	//Functions for Schedule Class Use.
	

	//Public function to create a new Schedule and save to the database.
	public function newSchedule($WeekID, $ShiftID,$EmployeeID,$PostedFlag,$ModRequest,$ModReposted,$Archived){
		$this->WeekID = $WeekID;
		$this->ShiftID = $ShiftID;
		$this->EmployeeID = $EmployeeID;
		$this->PostedFlag = $PostedFlag;
		$this->ModRequest=$ModRequest;
		$this->ModReposted = $ModReposted;
		$this->Archived=$Archived;
		$this->setScheduledShiftsID();		
		include "connect.php";
		$sql= "INSERT INTO scheduledshifts (ScheduledShiftsID,WeekID, ShiftID,EmployeeID,PostedFlag,ModRequest,ModReposted,Archived) VALUES ('$this->ScheduledShiftsID', '$this->WeekID', '$this->ShiftID', '$this->EmployeeID',  '$this->PostedFlag', '$this->ModRequest', '$this->ModReposted','$this->Archived')";			
		mysqli_query($conn, $sql);
		echo '<center> Manager Added Successfully. </center>';	
	}
	
	//Public function to set the values in an Manager.
	public function makeSchedule($ScheduledShiftsID){		
		
		$this->ScheduledShiftsID = $ScheduledShiftsID;
		
		include "connect.php";
		$sql ="SELECT WeekID, ShiftID,EmployeeID,PostedFlag,ModRequest,ModReposted,Archived FROM `scheduledshifts` WHERE `ScheduledShiftsID` ='".$this->ScheduledShiftsID."'";
		
		
		$result = mysqli_query($conn,$sql);
		while($row=$result->fetch_row()){
			$this->WeekID=$row[0];
			$this->ShiftID=$row[1];
			$this->EmployeeID=$row[2];
			$this->PostedFlag=$row[3];
			$this->ModRequest=$row[4];
			$this->ModReposted=$row[5];
			$this->Archived=$row[6];
			
			}
	}
	
	
	//Update Function for Schedule in database
	public function updateShedule(){
		
		include "connect.php";	
		$sql= "UPDATE `scheduledshifts` SET WeekID = '".$this->WeekID."', ShiftID = '".$this->ShiftID."', EmployeeID = '".$this->EmployeeID."', PostedFlag = '".$this->PostedFlag."', ModRequest = '".$this->ModRequest."', ModReposted = '".$this->ModReposted."', Archived = '".$this->Archived."' WHERE `ScheduledShiftsID` = '".$this->ScheduledShiftsID."'";
		mysqli_query($conn, $sql);
		echo '<center> Schedule Updated Successfully. </center>';	
	}
	
	
	//Delete a Schedule,
	public function deleteSchedule(){
		include "connect.php";
		$sql="DELETE FROM `scheduledshifts` WHERE `ScheduledShiftsID` = '$this->ScheduledShiftsID'";
		mysqli_query($conn, $sql);
	}	
}

 ?>