<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$servername = "localhost";
$username = "root";
$password = "";
$database = "sosadv_db_core";

$conn = new \mysqli($servername, $username, $password, $database); 

// Check connection
if ($conn -> connect_error) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$database = "sosadv_db_sos";

$conn2 = new \mysqli($servername, $username, $password, $database); 

// Check connection
if ($conn -> connect_error) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    
    exit();
}



  
?>

