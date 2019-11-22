	<?php
	// Include config file
	require_once "connect.php";
	 
	// Define variables and initialize with empty values
	$fname = $lname= $deptNum = $employeeLogin = $email = $role = "";
	$fname_e = $lname_e= $deptNum_e= $employeeLogin_e = $role_e = $email_e = "";
	// Processing form data when form is submitted
	if(isset($_POST["EmployeeID"]) && !empty($_POST["EmployeeID"])){
		// Get hidden input value
		$EmployeeID = $_POST["EmployeeID"];
		
		// Validate name
		  $input_fname = trim($_POST["fname"]);
		if(empty($input_fname)){
			$fname_e = "Please enter employee's first name.";
		} elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			$fname_e = "Please enter a valid name.";
		} else{
			$fname = $input_fname;
		}
			 // Validate last name
		$input_lname = trim($_POST["lname"]);
		if(empty($input_lname)){
			$lname_e = "Please enter employee's last name.";
		} elseif(!filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			$lname_e = "Please enter a valid name.";
		} else{
			$lname = $input_lname;
		}
		
			// Validate user id
		$input_login = trim($_POST["employeeLogin"]);
		if(empty($input_login)){
			$employeeLogin_e = "Please enter employee's login.";
		} elseif(!filter_var($input_login, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			$employeeLogin_e = "Please enter a valid userID.";
		} else{
			$employeeLogin = $input_login;
		}
		//validate email address
		$input_email=trim($_POST["email"]);
		if(empty($input_email)){
		$email_e="Please enter employee's email address";
		} elseif(!filter_var($input_email,FILTER_VALIDATE_EMAIL)){
			$email_e="Please enter valid email address";
		} else {
			$email=$input_email;
		}
		// Validate department
		$input_dept = trim($_POST["deptNum"]);
		if(empty($input_dept)){
			$deptNum_e = "Please enter a department number.";
		} elseif(!ctype_digit($input_dept)){
			$deptNum_e = "Please enter a positive integer value.";
		} else{
			$deptNum = $input_dept;
		}
		// Select Role
		if(empty($_POST["role"])){
			$role_e="Please select a role";
		}
		else{
			$role=($_POST["role"]);
		}
		
		// Check input errors before inserting in database
		 if(empty($fname_e) && empty($lname_e) && empty($deptNum_e) && empty($employeeLogin_e) && empty($role_e) && empty($email_e)){
			// Prepare an update statement
			$sql = "UPDATE employee SET Fname=?, Lname=?, DeptNum=?, EmployeeLogin=?, Email=?, Role=? WHERE EmployeeID=?";
			 
			if($stmt = mysqli_prepare($conn, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ssssssi", $param_fname, $param_lname, $param_deptNum, $param_login, $param_email, $param_role, $param_id);
				
				// Set parameters
			   $param_fname = $fname;
				$param_lname= $lname;
				$param_deptNum= $deptNum;
				$param_login= $employeeLogin;
				$param_email= $email;
				$param_role= $role;
				$param_id = $EmployeeID;
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Records updated successfully. Redirect to landing page
					header("location: view.php");
					exit();
				} else{
					echo "Something went wrong. Please try again later.";
				}
			}
			 
			// Close statement
			mysqli_stmt_close($stmt);
		}
		
		// Close connection
		mysqli_close($conn);
	} else{
		// Check existence of employeeID parameter before processing further
		if(isset($_GET["EmployeeID"]) && !empty(trim($_GET["EmployeeID"]))){
			// Get URL parameter
			$EmployeeID =  trim($_GET["EmployeeID"]);
			
			// Prepare a select statement
			$sql = "SELECT * FROM employee WHERE EmployeeID = ?";
			if($stmt = mysqli_prepare($conn, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "i", $param_id);
				
				// Set parameters
				$param_id = $EmployeeID;
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					$result = mysqli_stmt_get_result($stmt);
		
					if(mysqli_num_rows($result) == 1){
				 
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						
						// Retrieve individual field value
						$fname = $row["Fname"];
						$lname = $row["Lname"];
						$deptNum = $row["DeptNum"];
						$employeeLogin = $row["EmployeeLogin"];
						$email = $row["Email"];
						$role = $row["Role"];
					} else{
					echo "Something went wrong. Please try again later.";
				}
			}
			
			// Close statement
			mysqli_stmt_close($stmt);
			
			// Close connection
			mysqli_close($conn);
		}  else{
			
	}
		}
	}
	?>
	 
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Update Record</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<style type="text/css">
			.wrapper{
				width: 500px;
				margin: 0 auto;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="page-header">
							<h2>Update Employee Records</h2>
						</div>
						<p>Please edit the input values and submit to update the record.</p>
						<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
						   <div class="form-group <?php echo (!empty($fname_e)) ? 'has-error' : ''; ?>">
								<label>First Name</label>
								<input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
								<span class="help-block"><?php echo $fname_e;?></span>
							</div>
		 <div class="form-group <?php echo (!empty($lname_e)) ? 'has-error' : ''; ?>">
								<label>Last Name</label>
								<input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
								<span class="help-block"><?php echo $lname_e;?></span>
							</div>
		<div class="form-group <?php echo (!empty($deptNum_e)) ? 'has-error' : ''; ?>">
								<label>Department Number</label>
								<input type="text" name="deptNum" class="form-control" value="<?php echo $deptNum; ?>">
								<span class="help-block"><?php echo $deptNum_e;?></span>
							</div>
		 <div class="form-group <?php echo (!empty($employeeLogin_e)) ? 'has-error' : ''; ?>">
								<label>Employee Login</label>
								<input type="text" name="employeeLogin" class="form-control" value="<?php echo $employeeLogin; ?>">
								<span class="help-block"><?php echo $employeeLogin_e;?></span>
							</div>
		<div class="form-group <?php echo (!empty($email_e)) ? 'has-error' : ''; ?>">
								<label>Email</label>
								<input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
								<span class="help-block"><?php echo $email_e;?></span>
							</div>
		<div class="form-group">
		<label>Current Employee's Role</label>
		<p>
		 <?php echo $role; ?>
		</p>  
							</div>	 
		<div class="form-group <?php echo(!empty($role_e)) ? 'has-error' : ''; ?>">
						<label>Select Employee's Role</label>
					<select name="role">
				<option>---Select Role--</option>
				<option value="employee">Employee</option>
				<option value="manager">Manager</option>
				<option value="admin">Admin</option>
					</select>
							</div>
							<input type="hidden" name="EmployeeID" value="<?php echo $EmployeeID; ?>"/>
							<input type="submit" class="btn btn-primary" value="Submit">
							<a href="viewManager.php" class="btn btn-default">Cancel</a>
						</form>
					</div>
				</div>        
			</div>
		</div>
	</body>
	</html>
