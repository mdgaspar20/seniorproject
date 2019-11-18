<?php



class Days{
	//Days data variables.
	
	var $DayName;
	var $DayNum;
	

	
	//Public function to set the values in an Day.
	public function makeDays($DayNum){		
		
		$this->DayNum = $DayNum;
		
		include "connect.php";
		$sql ="SELECT DayName FROM `days` WHERE `DayNum` ='".$DayNum."'";
		$result= mysqli_query($conn, $sql);
		
		while ($row = $result->fetch_row()) {
			$this->DayName = $row[0];
			
		}	
	}
}
 ?>