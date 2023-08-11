<?php
include "../config/config.php"; //conf file with database


$returnApp = $_GET["app"]; //  https://sosadvanced.test/login
echo $returnApp;
//$returnApp = "https://sosadvanced.test/login";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $returnApp = $_POST['return'];

    $stmt = $conn->prepare("SELECT * FROM core_users u WHERE u.username LIKE ?");  //check user
    $stmt->bind_param("s", $email);
    $stmt->execute();


    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $storedHashedPassword = $row["password"];
            $storedId = $row["id"];
        }
    } else {
        echo "No results found.";
        die();
    }


    if (password_verify($password, $storedHashedPassword)) {

        $token = generateToken(); //create and save token to core db
        $stmt = $conn->prepare("UPDATE core_users SET token = ? WHERE id = ?");
        $stmt->bind_param("ss", $token, $storedId);
        $stmt->execute();

        $stmt = $conn2->prepare("UPDATE user SET token = ? WHERE email LIKE ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        $_SESSION['id'] = $storedId;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        $_SESSION['token'] = $token;

        $returnlink = $returnApp . "/".$token;
        
        header("Location: $returnlink"); 

        echo "Login successful!";
    } else {
        // Passwords don't match
        echo "Invalid password";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        /* Form container */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
        }

        /* Form input fields */
        .form-container input[type="email"],
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }

        /* Form submit button */
        .form-container input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: #fff;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Form submit button on hover */
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include  "../templates/navbar.php"; ?>

    <div class="form-container">
        <form method="post" action="login.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="hidden" id="return" name="return" value="<?php echo $returnApp ?>">

            <input type="submit" value="Login">
        </form>
    </div>



  
</body>
</html>