<?php
  error_reporting(0);
  session_start();
  $name = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>AI Attendance System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <!--  Icons  -->
  <script src="https://kit.fontawesome.com/668dd02108.js" crossorigin="anonymous"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet">

</head>
<body>

<div class="m-4">
  <h2>
    <div class="well text-center" style="font-family: 'Black Ops One', cursive;">  
      Intelligent Attendance System
    </div>
  </h2>
</div>
<hr>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="welcome.php">Team Unique Solutions</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link " href="welcome.php">Home<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link " href="add.php">Add Workers<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link " href="details.php">View Attendance<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link " href="view_worker.php">Mark Attendance<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link " href="manage_worker.php">Manage Worker<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link pull-right" href="logout.php">
        <button class="btn btn-warning btn-sm">
          <span><i class="fas fa-sign-out-alt"></i></span> 
          Logout
        </button>
      </a>
      <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">
              <!-- user icon -->
              <i class="fas fa-user"></i>
              <?php echo "  | ".$_SESSION['username']?>
            </a>
        </li>
      </ul>
    </div>

  </div>
</nav>


</body>
</html>