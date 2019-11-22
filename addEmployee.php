	<?php
	require_once "connect.php";
	if(isset($_POST["submit"])){
	
	$fname=mysqli_real_escape_string($conn,$_POST["Fname"]);
			$lname=mysqli_real_escape_string($conn,$_POST["Lname"]);
			$deptNum=mysqli_real_escape_string($conn,$_POST["DeptNum"]);
			$role=mysqli_real_escape_string($conn,$_POST["Role"]);
			$employeeUser=mysqli_real_escape_string($conn,$_POST["EmployeeLogin"]);
			$email = mysqli_real_escape_string($conn, $_POST['Email']);
			$password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
			$password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
	if (empty($fname)) { echo "Enter Employee's first name"; }
	if (empty($lanme)) { echo "Enter Employee's last name"; }
	if (empty($employeeUser)) { echo "Enter Employee's LoginID"; }
	if (empty($deptNum)) { echo "Enter Employee's department"; }
	if (empty($email)) { echo "Email is required"; }
	if (empty($password_1)) { echo "Password is required"; }
	if ($password_1 != $password_2) {
		echo "passwords do not match";
	  }
		  //checking if user name exists
	$check="SELECT * FROM employee WHERE EmployeeLogin='$employeeUser' OR Email = '$email' LIMIT 1";
	$result=mysqli_query($conn,$check);
	$user=mysqli_fetch_assoc($result);

	if($user){
		if($user['EmployeeLogin'] == $employeeUser){
			echo "Employee already exists";
		}

		if ($user['Email'] === $email) {
		  echo "email already exists";
		}
	}

	$password=md5($password_1);
	$sql=mysqli_query($conn, "INSERT INTO employee (Fname, Lname, DeptNum, EmployeeLogin, Email, Password, Role)
	VALUES ('$fname','$lname','$deptNum','$employeeUser', '$email', '$password', '$role')");

	echo "Employee Added Successfully";
		header("location:addEmployee.php");


	}
	?>

	<!doctype html>
	<html>
	<head>
	<meta charset="utf-8">
	<title>Add Employee</title>
	<link rel="stylesheet" href="addEmployee.css">
	</head>

	<body>
		<div class="button-group2">
			<a href="admin.php"><input id="button3" type="button" name="Request" value="Back"></a>
			<a href="view.php"><input id="button2" type="button" name="Request" value="View Employees"></a>

		</div>
		<div class="container">
			<div class="header">
			<h1>Register Employee</h1>
			<br><br>
			</div>
			<form method="post" action="addEmployee.php">
				<div class="input-group">
					<label>First Name</label>
					<input type="text" name="Fname" required="require">
				</div>
				<br><br>
				<div class="input-group">
					<label>Last Name</label>
					<input type="text" name="Lname" required="require">
				</div>
				<br><br>
				<div class="input-group">
					<label>Department Number</label>
					<input type="text" name="DeptNum" required="require">
				</div>
				<br><br>
				<div class="input-group">
					<label>Employee Login</label>
					<input type="text" name="EmployeeLogin" required="require">
				</div>
				<br><br>
				<div class="input-group">
					<label>Email</label>
					<input type="email" name="Email" required="require">
				</div>
				<br><br>
				<div class="input-group">
					<label>Password</label>
					<input type="password" name="password_1" required="require">
				</div>
				<br><br>
				<div class="input-group">
					<label>Confirm Password</label>
					<input type="password" name="password_2" required="require">
				</div>
				<br><br>
				<div class="input-group">
				Select Role: <select name="Role" required="require">
			<option>---Select Role--</option>
			<option value="employee">Employee</option>
			<option value="manager">Manager</option>
			<option value="admin">Admin</option>
			</select>
			</div>
			<br><br>
			<div class="">
					<button  id="button1" type="submit" class="btn" name="submit"> <strong>Add</strong></button>
				</div>

				</form>
				</div>



	</body>
	</html>
