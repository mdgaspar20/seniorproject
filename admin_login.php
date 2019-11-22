	<?php
	//connection to database
	$conn=mysqli_connect('localhost','root','','seniorproject');
	session_start();

	//getting login info
	if(isset($_POST['login'])){
	 //check both login and password inputs aren't empty
	  if(empty($_POST['EmployeeLogin']) && empty($_POST['Password'])){
	  $error= 'Both Fields are Mandatory'; //display error message
	  }
	  else{
		  //login based on credentials
	  $EmployeeLogin=mysqli_real_escape_string($conn,$_POST['EmployeeLogin']);
	  $Password=mysqli_real_escape_string($conn,$_POST['Password']);
	  $Password=md5($Password);
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
				  case 'employee':
				  header('location:no.php');
				  break;
				  case 'admin':
				  header('location:admin.php');
				  break;
				  case 'manager':
				  header('location:no.php');
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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="admin_login.css">
	  </head>
	  <body>
	  <ul class="nav">
		  <li class="nav-item">
			<a class="nav-link active" href="capstone_home.php">Employee Sign-in</a>
		  </li>
		</ul>
		<div class="container">
		  <h1>Welcome Admin</h1>
		  <?php if(isset($error)){ echo $error; }?>
		  <form class="login" action="" method="post">
			<label for="EmployeeLogin"><strong>Username:</strong></label>
			<input type="text" name="EmployeeLogin" placeholder="Username"><br>
			<label for="Password"><strong>Password:</strong>&nbsp;</label>
			<input type="password" name="Password" value=""><br>
			<button type="submit" name="login" class="btn btn-primary">Login</button>
		  </form>

		</div>
		  </body>
	</html>
