<?php 
  include('connect.php');
  error_reporting(0);
  $s = 'P';
  $oneday = $_POST['wage'];   
  $workerid=$_POST['workerid'];
  $sdate = $_POST['startdate'];
  $edate = $_POST['enddate'];
  $sql = "SELECT * FROM attendance WHERE worker_id ='$workerid' AND status = '$s' AND markdate BETWEEN '$sdate' AND '$edate' ";
  $res = mysqli_query($conn,$sql);
  $rows = mysqli_num_rows($res);
  $answer = $oneday*$rows;
  echo "TOTAL AMOUNT PAYABLE: ".$answer."<br>"."TOTAL DAYS PRESENT: ".$rows;
?>