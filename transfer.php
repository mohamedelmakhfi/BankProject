
<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
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
			width: 72%;
			/* Set your desired width */
			margin: 20px auto;
			/* Center the line horizontally and add some margin */
		}
    </style>
  <?php
    define('bankname', 'Bankmed');
    $error = "";
    if (isset($_POST['userLogin']))
    {
      $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];
       
        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if($result->num_rows>0)
        { 
          session_start();
          $data = $result->fetch_assoc();
          $_SESSION['userId']=$data['id'];
          $_SESSION['user'] = $data;
          header('location:index.php');
         }
        else
        {
          $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
        }
    }

   ?>
</head>
<body style="background:#fff;background-size: 100%">
<nav class="navbar navbar-expand-lg  fixed-top">
 <a class="navbar-brand" href="#">
    <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="accounts.php">Accounts</a></li>
      <li class="nav-item ">  <a class="nav-link" href="statements.php">Account Statements</a></li>
      <li class="nav-item active">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li>


    </ul>
    <?php include 'sideButton.php'; ?>
  </div>
</nav><br><br><br>
<div class="container">
  <br><br>
<div class="titree text-center">
Funds Transfer
    </div>

<hr>  
  <div class="card-body">
      <form method="POST">
          <div class="alert alert-primary w-50 mx-auto">
            <h4 class="text-center">New Transfer</h4>
            <hr>
            <h5 class="text-center mt-3 mb-3">Your Balance : <?php echo $userData['balance']; ?> DH</h5>

            <input type="text" name="otherNo" class="form-control " placeholder="Enter Receiver Account number" required>
            <button type="submit" name="get" class="btn btn-primary btn-block my-1">Get Account Info</button>
          </div>
      </form>
      <?php if (isset($_POST['get'])) 
      {
        $array2 = $con->query("select * from otheraccounts where accountNo = '$_POST[otherNo]'");
        $array3 = $con->query("select * from userAccounts where accountNo = '$_POST[otherNo]'");
        {
          if ($array2->num_rows > 0) 
          { $row2 = $array2->fetch_assoc();
            echo "<div class='alert alert-primary w-50 mx-auto'>
                  <form method='POST'>
                    Account No.
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control' value='$row2[holderName]' readonly required>
                    Account Holder Bank Name.
                    <input type='text' class='form-control' value='$row2[bankName]' readonly required>
                    Enter Amount for tranfer.
                    <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                    <button type='submit' name='transfer' class='btn btn-primary btn-block  my-1'>Tranfer</button>
                  </form>
                </div>";
          }elseif ($array3->num_rows > 0) {
           $row2 = $array3->fetch_assoc();
            echo "<div class='alert alert-primary w-50 mx-auto'>
                  <form method='POST'>
                    Account No.
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control' value='$row2[name]' readonly required>
                    Account Holder Bank Name.
                    <input type='text' class='form-control' value='".bankname."' readonly required>
                    Enter Amount for tranfer.
                    <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                    <button type='submit' name='transferSelf' class='btn btn-primary btn-block my-1'>Tranfer</button>
                  </form>
                </div>";
          }
          else
            echo "<div class='alert alert-primary w-50 mx-auto'>Account No. $_POST[otherNo] Does not exist</div>";
        }
      } 
      ?>
    <br>
    <h5 class="titree text-center">Transfer History</h5>
    <hr><br>
    <?php
    if (isset($_POST['transferSelf']))
    {
      $amount = $_POST['amount'];
      setBalance($amount,'debit',$userData['accountNo']);
      setBalance($amount,'credit',$_POST['otherNo']);
      makeTransaction('transfer',$amount,$_POST['otherNo']);
      echo "<script>alert('Transfer Successfull');window.location.href='transfer.php'</script>";
    }
    if (isset($_POST['transfer']))
    {
      $amount = $_POST['amount'];
      setBalance($amount,'debit',$userData['accountNo']);
      makeTransaction('transfer',$amount,$_POST['otherNo']);
      echo "<script>alert('Transfer Successfull');window.location.href='transfer.php'</script>";
    }
      $array = $con->query("select * from transaction where userId = '$userData[id]' AND action = 'transfer' order by date desc");
      if ($array ->num_rows > 0) 
      {
         while ($row = $array->fetch_assoc()) 
         {
            if ($row['action'] == 'transfer') 
            {
              echo "<div class='alert alert-primary text-center'>Transfer have been made for  $row[debit] DH from your account at $row[date] in  account no.$row[other]</div>";
            }

         }
      }
      else
        echo "<div class='alert alert-danger'>You have made no transfer yet.</div>";
    ?>  
  </div>
  

</div>
<div class="card cardd">
   <?php echo bankname ?>
  </div>
</body>
</html>