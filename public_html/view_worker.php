<?php
    include("header1.php");
    include("connect.php");
    error_reporting(0);
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: welcome.php");
        exit;
    }
?>

<script defer src="scripts/face-api.min.js"></script>
<script defer src="scripts/main_script.js"></script>
<style type="text/css" link="styles/style.css"></style>
<div class="container m-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="well-text"><h3 class="text-center">Your Admin ID : <?php echo $_SESSION['id'];?></h3></div>
            <button class="btn btn-primary" onclick="display_workers()" id="refresh-table">
                <i class="fas fa-sync-alt"></i>
                Refresh
            </button>
            <!-- <a class="btn btn-secondary pull-right"  href="welcome.php"> Back </a> -->
            <div class="container m-4">
                <h3>List Of The Workers</h3>
                <table class="table table-striped">
                    <thead class="table-dark">
                        
                            <th>Table ID</th>
                            <th>Worker Id</th>
                            <th>Worker Name</th>
                            <th>Worker Age</th>
                            <th>Mark Attendance</th>
                        
                    </thead>
                    <tbody id="response"></tbody>


                </table>    
            </div>
            <form action="present.php" method="post">
                <input type="text" name="worker_id" hidden>
                <input type="submit" name="present_worker" hidden>
            </form>
            
        </div>
    </div>
</div>