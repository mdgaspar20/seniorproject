<?php
include "EmployeeClass.php";
	 $fname='Jason';
	 $lname='Lyle';
	 $DeptNum=1;
	 $EmployeeLogin='Jmlyle';
	 $Email='Email@Email.com';
	 $password='password';
	 $role='admin';
	 
	 
	 
$testEmployee = new employee();
$testEmployee->newEmployee($fname,$lname,$DeptNum,$EmployeeLogin, $Email, $password,$role);
//$testEmployee->newEmployee($fname, $lname, $DeptNum,$EmployeeLogin,$Email,$password, $role);
//$testEmployee->deleteEmployee(2);
$testEmployee->printEmp();

 ?>
