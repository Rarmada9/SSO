<?php 

if(!isset($_SESSION['username'])){
    $logged = false;
}else{
    $logged = true;
}

?>




<style>
        /* Basic styling for the navbar */
        .navbar {
            background-color: #f8f8f8;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Style for the logo */
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        
        /* Style for the dropdown menu */
        .dropdown {
            position: relative;
        }
        
        .dropdown-button {
            padding: 8px 12px;
            background-color: #f8f8f8;
            color: #333;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown-content a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        
        /* Style for the buttons */
        .navbar-buttons {
            margin-left: auto;
        }
        
        .navbar-buttons a {
            padding: 8px 16px;
            margin-left: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .navbar-buttons button:first-child {
            margin-left: 0;
        }
    </style>

    <div class="navbar">
        <div class="logo">App1</div>
        <?php if($logged == true){ ?>
        <div class="dropdown">
            <button class="dropdown-button">App 1</button>
            <div class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div>
        <?php } ?>
        <div class="navbar-buttons">
            <a href="http://sso.test/App/dashboard.php">Return Dashboard</a>
            <?php if($logged == true){ ?>
            <a href="http://sso.test/security/logout.php">logout</a>
            <?php }else{ ?>
            <a href="http://sso.test/security/login.php">login</a>
            <?php } ?>
        </div>
    </div>