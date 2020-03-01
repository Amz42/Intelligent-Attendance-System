<?php
    include("connect.php");
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: welcome.php");
        exit;
    }

    $workerid = htmlspecialchars(($_POST['worker_id_delete']));
    for($i=1;$i<=10;$i++){
        $path = "images/$workerid-$i.jpg";        
        unlink($path);
    }
    $query = "DELETE FROM workers WHERE worker_id = '$workerid'";
    $query = mysqli_query($conn,$query);
    $query1 = "DELETE FROM attendance WHERE worker_id = '$workerid'";
    $query1 = mysqli_query($conn,$query1);
    if($query && $query1){
        echo "Worker Deleted";
    }else{
        echo "Deletion Failed";
    }
?>