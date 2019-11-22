	<?php
	//connection do databse
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'seniorproject';

	$conn = new mysqli($server, $user, $pass, $db);

	// show errors 
	mysqli_report(MYSQLI_REPORT_ERROR);

	?>