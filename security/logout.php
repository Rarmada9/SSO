<?php 
include "../config/config.php"; //conf file with database


$returnApp = $_GET["app"];




// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // User is logged in, unset and destroy the session

    unset($_SESSION['username']);

    $storedId =$_SESSION['id']; 

    $stmt = $conn->prepare("UPDATE core_users SET token = NULL WHERE id = ?");
    $stmt->bind_param("s", $storedId);
    $stmt->execute();
    $stmt->close();
    session_destroy();
    echo $returnApp;
    
    header("Location:" .$returnApp ); 
    die();
    
}else{

    header("Location: https://www.yoursite.com/new_index.php");
    exit();
}

exit();