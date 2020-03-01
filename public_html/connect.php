<?php
/*
This file contain Data Base connection And configuaration

*/

define('DB_SERVER','localhost');
define('DB_USERNAME','id10115467_aman');
define('DB_PASSWORD','aman1234');
define('DB_NAME','id10115467_login');

// try connecting database

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//check conn

if($conn == false)
{
    echo "Error: Cannot connect to Server.....";
}
else{
    //echo "sucess";
}
?>