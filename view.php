<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Records</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="page-header clearfix">
<h2 class="pull-left">Employees Details</h2>
<a href="addEmployee.php" class="btn btn-success pull-right">Add New Employee</a>
<a href="admin.php" class="btn btn-success pull-right">Home</a>
<a href="logout.php" class="btn btn-success pull-right">Logout</a>

   </div>
 <?php
 require_once "connect.php";
    // Attempt select query execution
    $sql = "SELECT * FROM employee";
      if($result = mysqli_query($conn, $sql)){
         if(mysqli_num_rows($result) > 0){
            echo "<table class='table table-bordered table-striped'>";
              echo "<thead>";
                echo "<tr>";
                  echo "<th>Employee ID</th>";
                  echo "<th>First Name</th>";
                  echo "<th>Last Name</th>";
                  echo "<th>Department No.</th>";
                  echo "<th>Employee Login</th>";
				  echo "<th>Action</th>";
                  echo "</tr>";
              echo "</thead>";
               echo "<tbody>";
while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                  echo "<td>" . $row['EmployeeID'] . "</td>";
                  echo "<td>" . $row['Fname'] . "</td>";
                  echo "<td>" . $row['Lname'] . "</td>";
			      echo "<td>" . $row['DeptNum'] . "</td>";
		          echo "<td>" . $row['EmployeeLogin'] . "</td>";
                  echo "<td>";
    
    echo "<a href='update.php?id=". $row['EmployeeID'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
    echo "<a href='delete.php?id=". $row['EmployeeID'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                echo "</td>";
                   echo "</tr>";
      }
            echo "</tbody>";                            
              echo "</table>";
    mysqli_free_result($result);
        } else{
     echo "<p class='lead'><em>No records found.</em></p>";
             }
        } else{
     echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
     }
     mysqli_close($conn);
   ?>
</div>
</div>        
</div>
</div>
</body>
</html>