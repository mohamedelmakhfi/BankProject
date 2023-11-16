<?php
session_start();
if (!isset($_SESSION['userId'])) {
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

  <style>
    body {
      background: url('images/bankbackground.jpg');
      background-size: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }


    @keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.welcome-container {
    text-align: center;
    padding: 20px;
    background-color: #007BFF;
    color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: fadeIn 3s ease-in-out;
}

.welcome-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

.welcome-description {
    font-size: 16px;
    line-height: 1.5;
    animation: fadeIn 1s ease-in-out 0.5s; /* Delay the description animation */
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

    .cardd {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      color: #ffffff;
      text-align: center;
      animation: fadeIn 3s ease-in-out;
      border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    }
    .tt {
      border-top-left-radius: 50px;
    border-top-right-radius: 50px;
    }
  </style>
</head>

<body>
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
          <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item "> <a class="nav-link" href="accounts.php">Accounts</a></li>
        <li class="nav-item "> <a class="nav-link" href="statements.php">Account Statements</a></li>
        <li class="nav-item "> <a class="nav-link" href="transfer.php">Funds Transfer</a></li>


      </ul>
      <?php include 'sideButton.php'; ?>
    </div>


  </nav><br><br><br>

  <div class="welcome-container">
    <div class="welcome-title">Welcome to Your Account</div>
    <div class="welcome-description">
      You can view all transactions, transfer money, and access information about your account. Feel free to contact us for any assistance.
    </div>
  </div>
  <div class="card-body cardd">
    <a href="mailto:mohamedelmakhfi6@gmail.com.com" class="btn btn-primary btn-block tt">Contact Us</a>
    <p class=" small">&copy; 2023 Bankmed. All rights reserved.</p>

</div>

</body>

</html>