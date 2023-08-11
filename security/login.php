<?php
include "../config/config.php"; //conf file with database


$returnApp = $_GET["app"]; //  https://sosadvanced.test/login
///echo $returnApp;
//$returnApp = "https://sosadvanced.test/login";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


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
<html>
<head>
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    .navbar img {
      width: 100px;
      height: auto;
    }

    .container {
      max-width: 400px;
      margin: 100px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
      text-align: center;
    }

    .container input[type="email"],
    .container input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      box-sizing: border-box;
    }

    .container input[type="submit"],
    .container input[type="button"] {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .container input[type="submit"] {
      background-color: rgb(96, 142, 52);
      color: #fff;
    }

    .container input[type="button"] {
      background-color: #aaa;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="navbar" style="background-color:rgb(96, 142, 52)">
    <img src="your_logo.png" alt="Logo">
  </div>

  <div class="container">
    <h2>Login</h2>
    <form method="post" action="login.php">
      <input type="email" id="email" name="email" required>
      <input type="password" id="password" name="password" required>
      <input type="hidden" id="return" name="return" value="<?php echo $returnApp ?>">
      <input type="submit" value="Login">
    </form>
    <input type="button" value="Back" onclick="goBack()">
  </div>

  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</body>
</html>
