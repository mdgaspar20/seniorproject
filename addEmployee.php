<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Employee</title>
</head>

<body>
<?php 

if(isset($_POST["submit"])){
require_once "connect.php";
		$fname=$_POST["Fname"];
		$lname=$_POST["Lname"];
		$employeeID=$_POST["EmployeeID"];
		$depNum=$_POST["DeptNum"];
		$role=$_POST["Role"];
		$employeeUser=$_POST["EmployeeLogin"];
		$password= $_POST["Password"];
		$EncryptPassword=md5($password);
$sql=mysqli_query($conn, "INSERT INTO employee (EmployeeID,Fname,Lname,DeptNum,EmployeeLogin,Password,Role) 
VALUES ('$employeeID','$fname','$lname','$depNum','$employeeUser','$EncryptPassword','$role')");	
	
	echo '<center> Employee Added Successfully. </center>';

}
?>
<table bgcolor="#f2f2f2" style="padding:50px" align="center" width="550px">
<form action="" method="post">
<tr><td align="center" colspan="2"><h1>Add Employee</h1></td></tr>
<tr>
<td> Employee ID: </td><td><input type="text" name="EmployeeID" required="required"></td>
</tr>
<tr>
<td> First Name: </td><td><input type="text" name="Fname" required="required"></td>
</tr>
<td> Last Name: </td><td><input type="text" name="Lname" required="required"></td>
</tr>
<tr>
<td> Department Number: </td><td><input type="text" name="DeptNum" required="required"></td>
</tr>
<tr>
<tr>
<td> Employee Login: </td><td><input type="text" name="EmployeeLogin" required="required"></td>
</tr>
<tr>
<td> Password: </td><td><input type="password" name="Password" required="required"></td>
</tr>
<td> Role: </td><td><input type="text" name="Role" required="required"></td>
</tr>

<tr>
<td align="center" colspan"2"><input type="submit" name="submit"></td></tr>

</form>
</table>
	<a href="admin.php"><input type="button" name="Request" value="Back to Admin Page"></a>
	<a href="view.php"><input type="button" name="Request" value="View Employees"></a>
</body>
</html>

