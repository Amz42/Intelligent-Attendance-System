<?php
    include("connect.php");
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: welcome.php");
        exit;
    }
    $a = "A";
    $workerid = htmlspecialchars(($_POST['worker_id']));
    $adminid = $_SESSION['id'];
    $query = " INSERT INTO attendance (worker_id, admin_id,status) VALUES ( '$workerid',  '$adminid','$a')";
    if(mysqli_query($conn,$query)){
        echo "A";
    }
    else{
        echo "Absent marking Failed";
    }
?>