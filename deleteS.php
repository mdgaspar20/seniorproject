<?php

//deleteS.php

if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=seniorproject', 'root', '');
 $query = "
 DELETE from schedule WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>
