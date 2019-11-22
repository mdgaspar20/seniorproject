<?php

//insertS.php

$connect = new PDO('mysql:host=localhost;dbname=seniorproject', 'root', '');

if(isset($_POST["employeeID"]))
{
 $query = "
 INSERT INTO schedule 
 (employeeID, start_event, end_event) 
 VALUES (:employeeID, :start_event, :end_event)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':employeeID'  => $_POST['employeeID'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}


?>