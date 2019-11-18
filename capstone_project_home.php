<?php
session_start();
$conn=mysqli_connect('localhost','root','','seniorproject');
//getting login info
if(isset($_POST['login'])){
  $EmployeeLogin=mysqli_real_escape_string($conn,$_POST['EmployeeLogin']);
  $Password=mysqli_real_escape_string($conn,$_POST['Password']);
  $Password=md5($Password);
  if(empty($EmployeeLogin)&&empty($Password)){
  $error= 'Fields are Mandatory';
  }
  else{
	  $result=mysqli_query($conn, "SELECT*FROM employee
	  WHERE EmployeeLogin='$EmployeeLogin' AND Password='$Password'");
	  $row=mysqli_fetch_assoc($result);
	  $count=mysqli_num_rows($result);
	  if($count==1){
		  $_SESSION['employee']=array(
		  'EmployeeLogin'=>$row['EmployeeLogin'],
		  'Password'=>$row['Password'],
		  'Role'=>$row['Role']);
		  $role=$_SESSION['employee']['Role'];
		  switch($role){
			  case 'user':
			  header('location:capstone_project_employee.php');
			  break;
			  case 'admin':
			  header('location:no.php');
			  break;
			  case 'manager':
			  header('location:capstone_project_manager.php');
		  break;}
	  }

	  else{
		  $error='Your Password or Username is Incorrect';
	  }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="capstone_project_home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>

    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link active" href="admin_login.php">Admin</a>
      </li>
    </ul>
    <h1>Welcome to WASA</h1>

  <div class="container">
    <h3>About Us</h3>
    <p>We are a team of people who who care about the society needs and determine to provide free solutions which would otherwise cost large sum of money</p>
    <p>We are committed to provide service that is free and suitable for every one.</p>
    <p>We welcome you to use our software and leave us a feedback on things we need to improve </p>
    <p>Please sign in.</p>
<?php if(isset($error)){ echo $error; }?>
    <form class="login" action="" method="post">
      <label for="EmployeeLogin"><strong> Username: </strong></label>
      <input type="text" name="EmployeeLogin" required="required" placeholder="Username"><br>
      <label for="Password"><strong>Password:</strong></label>
      <input type="password" name="Password" required="required" placeholder="password"><br>
      <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
  </div>


  </body>
</html>
