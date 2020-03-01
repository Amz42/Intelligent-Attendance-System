<?php
error_reporting(0);
    include("connect.php");
    include("header1.php");
    if(!isset($_SESSION['username'])){
        header("location: welcome.php");
        exit;
    }

     $workerid = $_POST['workerid'];

      $sql = "SELECT * from attendance WHERE worker_id='$workerid'  "; 

        $res = mysqli_query($conn,$sql);
  

    $query = "SELECT * FROM workers WHERE worker_id = '$workerid'";
    $query = mysqli_query($conn,$query);

    $rows=mysqli_num_rows($res);
    $res1 = mysqli_fetch_assoc($query);
    /*if(mysqli_num_rows($res1) > 0){
    }*/
?>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

.photo,.info {
  display:inline;
}
</style>

<div class="card bg-secondary mt-4">
 <center>
      <img src="images/<?php echo $workerid.'-5.jpg'; ?>" alt="<?php echo $res1['name']; ?>" style="width:20%; height=20%;display:inline;">
      </center>
    <div>
      <div class="card-body text-center">
      <h3>Worker Name: <?php echo $res1['name']; ?></h1>
      <h3>Worker ID : <?php echo $workerid; ?></h3>
      <h3>Age : <?php echo $res1['age']; ?></h3>
    </div>
    </div>
</div>





<!-- Attendance Record -->  

<div class="container m-4 "> <center><h3>Attendance Record </h3></center></div><br>
<div class="container m-4"><h5>Select Date to Display Particular data</h5></div>
<div class="container m-4"><b>From:</b>
<input type="date"  name="startdate" id="startdate">&nbsp;&nbsp;&nbsp;&nbsp;
<b>To:</b>
<input type="date" name="enddate" id="enddate">
&nbsp;&nbsp;
<Button type="submit" name="displayworkers" class="btn btn-dark" onclick="displayattn()">Go</Button>
</div>



                
    <table class="table table-striped">
        <thead class="table-dark">
            
                <th>Unique Id</th>
                <th>Date </th>
                <th>Attendance Status</th>
            
        </thead>
        <tbody id="response">
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


        </tbody>



    </table>   
     
</div>

<!-- Payment Adding -->
<div class = "container m-4">
<h3><center>Payment Records</center></h3>
<div class="container m-4"><h5>Select Date to calculate custom wage</h5></div>
<div class="container m-4"><b>From:</b>
<input type="date"  name="startdatewage" id="startdatewage">&nbsp;&nbsp;&nbsp;&nbsp;
<b>To:</b>
<input type="date" name="enddatewage" id="enddatewage">
&nbsp;&nbsp;
</div>
    <div class="d-flex">
    <input type="number" placeholder="Enter one day wage of the worker" name="wage" class="form-control" id="oneday" >    <button type='submit' class="btn btn-success" name="findwage" style="margin-left: 20px;" onclick= "displaywage()">Calculate</button></div>

<div id="answer">
<center>
 <h4 id="finalanswer"></h4>
 </center>
</div>
</div>
<br>
<br>

<script type="text/javascript">
   function displaywage(){
  var wage = document.getElementById('oneday').value;
  var startdate=document.getElementById('startdatewage').value;
  var enddate=document.getElementById('enddatewage').value;
  wid = <?php echo $workerid; ?>;
  var xhttp = new XMLHttpRequest();
  if(startdate!="" && enddate!="")
  {
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("finalanswer").innerHTML = this.responseText;

    }
  };
  xhttp.open("POST", "payment.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(`startdate=${startdate}&enddate=${enddate}&wage=${wage}&workerid=${wid}`);
}}

</script>

<script type="text/javascript">

function displayattn(){
    var startdate=document.getElementById('startdate').value;
    var enddate=document.getElementById('enddate').value;
    var wid = <?php echo $workerid; ?>;

    var xhttp1 = new XMLHttpRequest();
    if(startdate!="" && enddate!="")
    {
    xhttp1.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("response").innerHTML = this.responseText;
        }
    };
    xhttp1.open("POST", "filterattn.php", true);
    xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp1.send(`startdate=${startdate}&enddate=${enddate}&workerid=${wid}`);
}
}






</script>

