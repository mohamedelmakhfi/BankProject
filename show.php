<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>

  <?php 
  define('bankname', 'Bankmed');
  if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
    {
      header("location:mindex.php");
    }
  } ?>

<style>
    .navbar {
      background-color: #007BFF;
      /* Dark background color for the navbar */
    }

    .navbar-brand {
      color: #ffffff !important;
      /* White text for the brand */
    }

    .navbar-nav .nav-link {
      color: #ffffff !important;
      /* White text for navbar links */
    }
    .table th,
    .table td {
      text-align: center;
      border: none;
    }

    .table th {
      background-color: #007BFF;
      /* Dark background color for table header */
      color: #ffffff;
      /* White text for table header */
    }
    .table td {
      background-color: #fff;
      /* Dark background color for table header */
      color: black;
      font-weight: bold;
      /* White text for table header */
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f8f9fa;
      /* Alternate row color for better readability */
    }

    .titree {
      color: #007BFF;
      font-size: 24px;
      font-weight: bold;
    }
    .cardd {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      color: #ffffff;
      text-align: center;
    }
    hr {
			border: none;
			height: 3px;
			background-color: #007bff;
			/* Blue color */
			width: 96%;
			/* Set your desired width */
			margin: 20px auto;
			/* Center the line horizontally and add some margin */
		}
  </style>
</head>
<body style="background:#fff;background-size: 100%">
<nav class="navbar navbar-expand-lg fixed-top">
 <a class="navbar-brand" href="#">
    <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link active" href="mindex.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<?php 
  $array = $con->query("select * from useraccounts,branch where useraccounts.id = '$_GET[id]' AND useraccounts.branch = branch.branchId");
  $row = $array->fetch_assoc();
 ?>
<div class="container">
<div class="titree text-center">
    Account profile for : <p class="text-dark"> <?php echo $row['name']; ?></p>
  </div>  
  <hr>
  <div class="card-body">
  <table class="table table-bordered">
    <tbody>
        <tr>
            <th>Name</th>
            <td><?php echo $row['name'] ?></td>
        </tr>
        <tr>
            <th>Account No</th>
            <td><?php echo $row['accountNo'] ?></td>
        </tr>
        <tr>
            <th>Branch Name</th>
            <td><?php echo $row['branchName'] ?></td>
        </tr>
        <tr>
            <th>Branch Code</th>
            <td><?php echo $row['branchNo'] ?></td>
        </tr>
        <tr>
            <th>Current Balance</th>
            <td><?php echo $row['balance'] ?> DH</td>
        </tr>
        <tr>
            <th>Account Type</th>
            <td><?php echo $row['accountType'] ?></td>
        </tr>
        <tr>
            <th>CNIC</th>
            <td><?php echo $row['cnic'] ?></td>
        </tr>
        <tr>
            <th>City</th>
            <td><?php echo $row['city'] ?></td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td><?php echo $row['number'] ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $row['address'] ?></td>
        </tr>
    </tbody>
</table>
  </div>
  <hr>

<div class="card cardd">
    <?php echo bankname; ?>
  </div>
</body>
</html>