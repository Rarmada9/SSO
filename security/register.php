<?php
include "../config/config.php"; //conf file with database


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    // Retrieve the submitted username and password
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $hashedPassword2 = password_hash($password2, PASSWORD_DEFAULT);

    if($password != $password2){
        $message = "password dont match";
        echo $message;
    }else{

        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO core_users (name, password, username, created_at) VALUES (?, ?, ?,NOW())");
        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        // Execute the INSERT statement
        if ($stmt->execute()) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        // Close the prepared statement and database connection
        $stmt->close();






    }




    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="register.php">
        <div>
            <label for="username">email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password">Repeat Password:</label>
            <input type="password" id="password2" name="password2" required>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</body>
</html>