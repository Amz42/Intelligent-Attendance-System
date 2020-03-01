<?php
include("connect.php");
session_start();
if(!isset($_SESSION['username'])){
    header("location: welcome.php");
    exit;
}

$sql = "SELECT * from workers"; 
$res = mysqli_query($conn,$sql);

if(mysqli_num_rows($res) > 0){
    while($result = mysqli_fetch_array($res)){
        if($result['admin_id'] == $_SESSION['id'] )
        { 
          $worker_id = $result['worker_id']; 
          date_default_timezone_set('Asia/Kolkata');
          $Currentdate = date( 'Y-m-d', time () );
          $query = "SELECT * FROM attendance WHERE worker_id='$worker_id' AND markdate = '$Currentdate'";
          $rst = mysqli_query($conn,$query);
          $rst = mysqli_fetch_assoc($rst);
        ?>
        
        <tr>
            <td> <?php echo $result['u_id']?> </td>
            <td> <?php echo $worker_id ?> </td>
            <td> <?php echo $result['name']?> </td>
            <td> <?php echo $result['age']?> </td>
            <?php 
                if(!$rst['markdate']){
            ?>
            <td><div class="container">
                    

                    <div class="d-flex justify-content-left">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $worker_id;?>" onclick="markAttendanceJS(<?php echo $worker_id;?>)">Mark Present</button>
                        <button class="btn btn-danger ml-1" onclick="markAbsent(<?php echo $worker_id;?>)">Absent</button>
                        
                    </div>

                    

                    <!-- The Modal -->
                    <div class="modal" id="myModal<?php echo $worker_id;?>">
                    <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title" class="justify-content-right">Worker UID <?php echo $worker_id;?> </h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <h5 align="center"><?php echo $result['name']; ?></h5>
                    <div align="center" style="display: inline-block;">
                        <h5 align="center">
                            Detected ID: 
                            <span id="detected_person_<?php echo $worker_id;?>"></span>
                        </h5>    
                    </div>
                    
                    <div id="modal_div<?php echo $worker_id;?>" align="center" class="modal-body" align="center">
                        <video id="video_<?php echo $worker_id;?>" src="" align="center" autoplay muted></video>
                    </div>
                    <div id="make_expr_<?php echo $worker_id;?>" align="center"></div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-success" data-dismiss="modal" id="close_<?php echo $worker_id;?>" disabled>Close</button>
                    </div>

                    </div>
                    </div>
                    </div>


                </div>
            </td>
            <?php }
            else{ ?>
                <td><kbd>Marked</kbd></td>
                <?php
            } ?>
        </tr>
<?php    
    }
}
}
?>