<?php

//updateS.php

$connect = new PDO('mysql:host=localhost;dbname=seniorproject', 'root', '');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE scheudle
 SET employeeID=:employeeID, start_event=:start_event, end_event=:end_event 
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':employeeID'  => $_POST['employeeID'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>