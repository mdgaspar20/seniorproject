<?php
require_once "connect.php";

$fname = $lname = $deptNum = $role="";

//check for inputs. Make sure they are valid(variables)
$fname_e = $lname_e = $deptNum_e = $role_e ="";

if(isset($_POST["EmployeeID"]) && !empty($_POST["EmployeeID"])){
	$employeeID=$_POST["EmployeeID"];
	
	$Name=trim($_POST["Fname"]);
	if(empty($Name)){
		$fname_e ="Please enter a name";
	}
	elseif(!filter_var($Name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-zA-Z\s]+$/")))){
		$fname_e="Please enter a valid name";
	}
	else{
		$fname=$Name;
	}
	
	$lName=trim($_POST["Lname"]);
	if(empty($lName)){
		$lname_e ="Please enter last name";
	}
	elseif(!filter_var($Name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-zA-Z\s]+$/")))){
		$lname_e="Please enter a valid name";
	}
	else{
		$lname=$lName;
	}
	   $Dept = trim($_POST["DeptNum"]);
    if(empty($Dept)){
        $deptNum_e = "Please enter a department number.";     
    } elseif(!ctype_digit($Dept)){
        $deptNum_e = "Please enter valid number.";
    } else{
        $deptNum = $Dept;
    }
	   $Role = trim($_POST["Role"]);
    if(empty($Role)){
        $role_e = "Please enter a role.";     
    } elseif(!filter_var($Name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-zA-Z\s]+$/")))){
		$role_e="Please enter a role";
    } else{
        $role = $Role;
    }
} 

?>