<?php

//loadS.php

$connect = new PDO('mysql:host=localhost;dbname=seniorproject', 'root', '');

$data = array();

$query = "SELECT * FROM schedule ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'employeeID'   => $row["employeeID"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>