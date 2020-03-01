<?php
    include("header1.php");
    include("connect.php");
    error_reporting(0);

    if(!isset($_SESSION['loggedin'])){  header("location:login.php");   }

    $user = $_SESSION['id'];
    $sdate = $_POST['startdate'];
    $edate = $_POST['enddate'];

    $sql = "SELECT * from attendance WHERE admin_id='$user' AND markdate BETWEEN '$sdate' AND '$edate' "; 
    $res = mysqli_query($conn,$sql);
    $rows=mysqli_num_rows($res);
?>


<div class="container m-4"><div class="well text"><h3>Attendance Records </h3> </div></div>
<form method="post" action="">
    <center>
        <div class="container m-4"><h5>Select Date to Display data</h5></div>
        <div class="container m-4">
            <b>From:</b> <input type="date"  name="startdate" id="startdate">&nbsp;&nbsp;&nbsp;&nbsp;
            <b>To:</b> <input type="date" name="enddate" id="enddate">&nbsp;&nbsp;
            <Button type="Submit" name="displayworkers" class="btn btn-dark" onclick="displayattd()">Go</Button>
        </div>
    </center>
</form>
<div class="container m-4" id="msg" style="display: block;"><center><h3><kbd>No Data to Display</kbd></h3></center></div>
<div class="container m-4" id="head" style="display: block;"> 
    <table class="table table-striped">
        <thead class="table-dark">
            <th>Unique Id</th>
            <th>Admin Id</th>
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
                <td> <?php echo $result['admin_id']?> </td>
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

<script>
    headd = document.getElementById("head");
    message = document.getElementById("msg");
    var req = "<?php echo $rows; ?>";
    if(req=="0"){ 
    headd.style.display="none";
    message.style.display="block";
    }else{
        headd.style.display="block";
        message.style.display="none";
    }
</script>

<script>
    function convertdate(date){
        var day = date.slice(0,2);
        var month = date.slice(3,5);
        var year = date.slice(6,10);
        return year+"-"+month+"-"+day;
    }
    
    function displayattd(){
        var startdate=document.getElementById('startdate');
        var enddate=document.getElementById('enddate');
        var sdate = convertdate(toString(startdate));
        var edate = convertdate(toString(enddate));
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("response").HTML = this.responseText;
            }
        };
        xhttp.open("POST", "details.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`startdate=${sdate}&enddate=${edate}`);
    }
</script>