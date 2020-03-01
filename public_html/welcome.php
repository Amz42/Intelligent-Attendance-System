<?php
    include("connect.php");
    include("header1.php");
    error_reporting(0);
    if(!isset($_SESSION['loggedin'])){
        header("location:login.php");
    }
?>

<div class="container m-4">
	<h2>Dashboard </h2>
</div>
<div class="card-group">
  	<div class="card text-white bg-danger m-3 ml-5" style="max-width: 18rem;">
    	<h5 class="card-header">YOUR ADMIN ID</h5>
    	<div class="card-body">
      		<div class="well text-right mr-3"><h2> <?php echo $_SESSION['id'];  ?></h2> </div>
    	</div>
  	</div>
  	<div class="card text-white bg-primary m-3 ml-5" style="max-width: 18rem;">
    	<h5 class="card-header">TOTAL WORKERS</h5>
	    <?php  
	        $query = "SELECT * FROM workers";   
	        $res = mysqli_query($conn,$query);
	        $rows=mysqli_num_rows($res);
	    ?>
	    <div class="card-body">
	      <div class="well text-right mr-3"><h2> <?php echo $rows;  ?></h2> </div>
	    </div>
  	</div>
  	<?php
    	$query1 = "SELECT DISTINCT markdate FROM attendance";
    	$query1 = mysqli_query($conn,$query1);
    	$query1 = mysqli_num_rows($query1);
  	?>
  	<div class="card text-white bg-success m-3 ml-5" style="max-width: 18rem;">
    	<h5 class="card-header">TOTAL  WORKING DAYS </h5>
    	<div class="card-body">
      		<div class="well text-right mr-3"><h2> <?php echo $query1;  ?></h2> </div>
    	</div>
  	</div>
</div>