<?php
error_reporting(0);
    include("connect.php");
    include("header1.php");
    if(!isset($_SESSION['username'])){
        header("location: welcome.php");
        exit;
    }

    if(isset($_POST['view'])) {
     $workerid = $_POST['workerid'];
 
        $sql = "SELECT * from attendance WHERE worker_id='$workerid'  "; 
        $res = mysqli_query($conn,$sql);
  

    $query = "SELECT * FROM workers WHERE worker_id = '$workerid'";
    $query = mysqli_query($conn,$query);

    $rows=mysqli_num_rows($res);
    $res1 = mysqli_fetch_assoc($query);
}
    /*if(mysqli_num_rows($res1) > 0){
    }*/
?>

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
<center>
<div class="container m-4 "> <center><h3>Attendance Record </h3></center></div><br>
<div class="container m-4" id="msg" style="display: block;"><center><h3><kbd>No Data to Display</kbd></h3></center></div>
<div class="container m-4" id="head" style="display: block;"> 

                
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
    <label style="self-align:left;" for="wage"></label>
    <input type="number" placeholder="Enter per day wage of the worker" name="wage" class="form-control" id="oneday" ><br>
    <button type='submit' class="btn btn-success" name="findwage" onclick= "displaywage()">Ok</button>

<div id="answer">
<center>
 <h4 id="finalanswer"></h4>
 </center>
</div>
</div>
<br>
<br>
</center>


<script>

function displaywage(){
  var wage = document.getElementById('oneday').value;
  if(wage==""){wage=0;}
  wid = <?php echo $workerid; ?>;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("finalanswer").innerHTML = "TOTAL AMOUNT PAYABLE: "+this.responseText;

    }
  };
  xhttp.open("POST", "payment.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(`wage=${wage}&workerid=${wid}`);
}
headd = document.getElementById("head");
message = document.getElementById("msg");
var req = "<?php echo $rows; ?>";

if(req=="0")
{ 
headd.style.display="none";
message.style.display="block";
}

else{
    headd.style.display="block";
    message.style.display="none";
}
</script>