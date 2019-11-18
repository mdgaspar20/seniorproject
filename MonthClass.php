<?php



class Month{
	//Month data variables.
	
	var $MonthNum;
	var $MonthName;
	var $DaysNum;

	
	//Public function to set the values in an Month.
	public function makeMonth($MonthNum){		
		
		$this->MonthNum = $MonthNum;
		
		include "connect.php";
		$sql ="SELECT MonthName,DaysNum FROM `month` WHERE `MonthNum` ='".$MonthNum."'";
		$result= mysqli_query($conn, $sql);
		
		while ($row = $result->fetch_row()) {
			$this->MonthName = $row[0];
			$this->DaysNum = $row[1];
		}	
	}
}

 ?>