<?php
 
class Week{
	//Week data variables.
	
	var $WeekNum;
	var $MonthStart;
	var $MonthEnd;
	var $DayStart;
	var $DayEnd;
	var $Monday;
	var $Tuesday;
	var $Wednesday;
	var $Thursday;
	var $Friday;
	var $Saturday;
	var $Sunday;
	
	private function newWeek($WeekNum,$MonthStart,$MonthEnd, $DayStart,$DayEnd, $Monday, $Tuesday, $Wednesday, $Thursday, $Friday, $Saturday, $Sunday){
		$this->WeekNum = $WeekNum;
		$this->MonthStart = $MonthStart;
		$this->MonthEnd = $MonthEnd;
		$this->DayStart = $DayStart;
		$this->DayEnd = $DayEnd;
		$this->Monday = $Monday;
		$this->Tuesday = $Tuesday;
		$this->Wednesday = $Wednesday;
		$this->Thursday = $Thursday;
		$this->Friday = $Friday;
		$this->Saturday = $Saturday;
		$this->Sunday = $Sunday;
		$this->setNewWeekNum();		
		
		$sql="INSERT INTO weeks (WeekNum,MonthStart,MonthEnd, DayStart,DayEnd, Monday, Tuesday, Wednesday,Thursday,Friday,Saturday, Sunday) VALUES ($this->WeekNum,$this->MonthStart,$this->MonthEnd, $this->DayStart,$this->DayEnd, $this->Monday, $this->Tuesday, $this->Wednesday, $this->Thursday, $this->Friday, $this->Saturday, $this->Sunday)");
				
		mysqli_query($conn, $sql);
		echo '<center> Week Added Successfully. </center>';
	
	}
	
	private function setNewWeekNum(){
		$key = true;
		$ind = 1;		
		require_once "connect.php";
		
	while ($key){
		$sql ="SELECT * FROM `weeks` WHERE `WeekNum` ='".$ind."'";
		$result = mysqli_query($conn, $sql);
	
		if(mysqli_num_rows($result)>0){
			$ind++;
			}else{
			$this->WeekNum = $ind;
			$key = false;
			}	
		}
	}
	public function makeWeek($WeekNum){		
		
		$this->WeekNum = $WeekNum;
		
		include "connect.php";
		$sql ="SELECT MonthStart,MonthEnd, DayStart,DayEnd, Monday, Tuesday, Wednesday,Thursday,Friday,Saturday, Sunday FROM `weeks` WHERE `WeekNum` ='".$WeekNum."'";
		
		
		$result = mysqli_query($conn,$sql);
		while($row=$result->fetch_row()){
			$this->MonthStart=$row[0];
			$this->MonthEnd=$row[1];
			$this->DayStart=$row[2];
			$this->DayEnd=$row[3];
			$this->Monday=$row[4];
			$this->Tuesday=$row[5];
			$this->Wednesday=$row[6];
			$this->Thursday=$row[7];
			$this->Friday=$row[8];
			$this->Saturday=$row[9];
			$this->Sunday=$row[10];
			}
	}
	public function updateWeek(){
		
		include "connect.php";	
		$sql= "UPDATE `weeks` SET MonthStart = '".$this->MonthStart."', MonthEnd = '".$this->MonthEnd."', DayStart = '".$this->DayStart."', DayEnd = '".$this->DayEnd."',Monday = '".$this->Monday."', Tuesday = '".$this->Tuesday."', Wednesday = '".$this->Wednesday."', Thursday = '".$this->Thursday."',Friday = '".$this->Friday."',Saturday = '".$this->Saturday."', Sunday = '".$this->Sunday."' WHERE WeekNum` = '".$this->WeekNum."'";
		mysqli_query($conn, $sql);
		echo '<center> Employee Updated Successfully. </center>';	
	}
	
	
	public function deleteWeek(){
		include "connect.php";
		$sql="DELETE FROM `weeks` WHERE `WeekNum` = '".$this->WeekNum."'";
		mysqli_query($conn, $sql);
	}	
	
}

 ?>
