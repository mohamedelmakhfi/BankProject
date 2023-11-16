<?php
session_start();
if (!isset($_SESSION['managerId'])) {
  header('location:login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php
  define('bankname', 'MCB Bank');
  if (isset($_GET['delete'])) {
    if ($con->query("delete from useraccounts where id = '$_GET[delete]'")) {
      header("location:mindex.php");
    }
  } ?>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      /* Set a light background color */
    }

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

    .card {
      margin-top: 20px;
    }

    .table th,
    .table td {
      text-align: center;
    }

    .table th {
      background-color: #007BFF;
      /* Dark background color for table header */
      color: #ffffff;
      /* White text for table header */
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f8f9fa;
      /* Alternate row color for better readability */
    }

    .btn {
      margin-right: 5px;
    }

    .cardd {
      background-color: #007BFF;
      /* Dark background color for card footer */
      color: #f8f9fa;
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
  <nav class="navbar navbar-expand-lg n fixed-top">
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
        <li class="nav-item "> <a class="nav-link" href="maddnew.php">Add New Account</a></li>
      </ul>
      <?php include 'msideButton.php'; ?>

    </div>
  </nav><br><br><br>
  <div class="container">
    <br><br>
    <div class="titree text-center">
      All accounts
    </div>
    <hr>
      <div class="card-body">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Holder Name</th>
              <th scope="col">Account No.</th>
              <th scope="col">Branch Name</th>
              <th scope="col">Current Balance</th>
              <th scope="col">Account type</th>
              <th scope="col">Contact</th>
              <th scope="col">----------------------------</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            $array = $con->query("select * from useraccounts,branch where useraccounts.branch = branch.branchId");
            if ($array->num_rows > 0) {
              while ($row = $array->fetch_assoc()) {
                $i++;
            ?>
                <tr>
                  <th scope="row"><?php echo $i ?></th>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['accountNo'] ?></td>
                  <td><?php echo $row['branchName'] ?></td>
                  <td><?php echo $row['balance'] ?> DH</td>
                  <td><?php echo $row['accountType'] ?></td>
                  <td><?php echo $row['number'] ?></td>
                  <td>
                    <a href="show.php?id=<?php echo $row['id'] ?>" class='btn btn-info btn-sm' data-toggle='tooltip' title="View More info">View</a>
                    <a href="mindex.php?delete=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm' data-toggle='tooltip' title="Delete this account" onclick="return confirm('Are you sure you want to delete this account?')">Delete</a>

                  </td>

                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>

      </div>
      <div class="card cardd ">
        <?php echo "Bankmed"; ?>
      </div>
</body>

</html>