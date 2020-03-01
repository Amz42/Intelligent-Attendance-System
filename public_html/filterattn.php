<?php

include('connect.php');


$sdate = $_POST['startdate'];
$edate = $_POST['enddate'];

$workerid = $_POST['workerid'];

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

fwrite($myfile, $workerid);
fwrite($myfile, $sdate);
fwrite($myfile, $edate);

fclose($myfile);

$sql = "SELECT * from attendance WHERE worker_id='$workerid' AND markdate BETWEEN '$sdate' AND '$edate' "; 

$res = mysqli_query($conn,$sql);

$rows=mysqli_num_rows($res);

?>

<?php 
        if(mysqli_num_rows($res) > 0){
            while($result = mysqli_fetch_array($res)){
                
        ?>
        
        <tr>
            <td> <?php echo $result['worker_id']?> </td>
            <td> <?php echo $result['markdate']?> </td>
            <td> <?php echo $result['status']?> </td>
        </tr>
        

        <?php 
            }
        }           
        ?> 
     
