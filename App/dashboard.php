<?php 
include "../config/config.php"; //conf file with database

if(!isset($_SESSION['username'])){
    header("Location: ../security/login.php"); 
}else{
    //header("Location: http://sso_project_1.test/?id=2489&user=tom");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <style>
        .center {
            display: flex;
            justify-content: center;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php include  "../templates/navbar.php"; ?>

    <div class="center">
        <a href="http://sso_project_1.test/?token=<?php print_r($_SESSION['token']); ?>&id=<?php print_r($_SESSION['id']); ?>">
        <button class="button">Button 1</button>
        </a>
        <a href="http://sso_project_2.test/?token=<?php print_r($_SESSION['token']); ?>&id=<?php print_r($_SESSION['id']); ?>" >
        <button class="button">Button 2</button>
        </a>
    </div>
    
 
</body>
</html>