<?php
  include('header.php');
    error_reporting(0);
  session_start();
  //$_SESSION['loggedin'] = false;
  if(isset($_SESSION['username'])){
    header("location: welcome.php");
    exit;
  }
  require_once "connect.php";

  $username = $password = "";
  $username_err = $password_err = "";

  if($_POST["login_submit"])
  {
    if(empty(trim($_POST['username'])))
    {
      $username_err = "Please enter the username.....";
    }
    elseif(empty(trim($_POST['password'])))
    {
      $password_err = "Please enter password......";
    }
    else
    {
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
    }
  }
  if(empty($username_err) && empty($password_err))
  {
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$param_username);
    $param_username = $username;
    // executing statement
    if(mysqli_stmt_execute($stmt))
    {
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) == 1)
      {
        mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
        if(mysqli_stmt_fetch($stmt))
        {
          if(password_verify($password,$hashed_password))
          {
            // all good ,,allow user to login
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id ;
            $_SESSION['loggedin'] = true;
            
            // redirect to welcome page
            header("location: welcome.php");


          }
        }
      }
    }
  }
?>

<div class="container mt-4">
  <h4>Please Login Here...... </h4>
  <hr>

  <form action="" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" name="username" class="form-control" placeholder="Enter Username" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="text-danger"><?php echo $username_err; ?></div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter Password" id="exampleInputPassword1">
    </div>
    <div class="text-danger"><?php echo $password_err; ?></div>
    <div class="form-group form-check mt-2">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label " for="exampleCheck1">Check me out</label>
    </div>
    <input  type="submit" name="login_submit" class="btn btn-dark mt-2">
  </form>   
</div>
