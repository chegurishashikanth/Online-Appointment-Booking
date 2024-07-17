<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navigation Bar</title>
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            height: 100vh;
            background-color: white;
        }

        .box {
            width: fit-content;
            height: 100%;
            background-color: #116466;
            color: #fff;
            position: relative;
            text-align: left;
            z-index: 1;
            opacity: 1;
            left: 0;
            pointer-events: fill;
            transition: 0.3s;
        }

        nav {
            padding-top: 100px;
        }

        nav ul {
            margin: 0px 30px;
        }

        nav ul li {
            list-style: none;
            margin-bottom: 30px;
            transition: 0.2s;
        }

        nav ul li:hover {
            background-color: #C4DFE6;
            border-radius: 8px;
        }

        nav ul li a {
            color: #fff;
            font-size: 20px;
            padding: 10px 30px;
            display: block;
            text-decoration: none;
        }

        nav ul li a:hover {
            color: black;
            font-size: 20px;
            padding: 10px 30px;
            display: block;
            text-decoration: none;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .logout_button {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #116466; 
            background-color: transparent; 
            border: none;
            cursor: pointer;
        }
        .logout_button:hover{
			color:#66A5AD;
            opacity: 0.9;
			
		}
        .logout_button img {
            width: 40px;
            height: 40px;
            transition: 0.2s;
            filter: invert(78%) sepia(17%) saturate(45773%) hue-rotate(177deg) brightness(93%) contrast(92%);
			color:#116466;
        }
        .logout_button img:hover {
            opacity: 0.9; 
            filter: invert(78%) sepia(17%) saturate(1773%) hue-rotate(177deg) brightness(93%) contrast(92%);
            color: #66A5AD;
            
        }

        .icons {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 80px;
            margin-left: 15px;
        }

        .icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0px 0px;
            margin-left: 300px;


        }

        .icon img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
            filter: invert(78%) sepia(17%) saturate(50000%) hue-rotate(177deg) brightness(93%) contrast(92%);
        }

        .icon:hover img {
            filter: invert(78%) sepia(17%) saturate(1773%) hue-rotate(177deg) brightness(93%) contrast(92%);
        }

        .icon span {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .icon:hover span {
			color: #66A5AD;
		}

        .user-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .user-info img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }

        .user-info p {
            color: #fff;
            font-size: 18px;
            margin-top: 10px;
            text-align: center;
            margin-bottom: 75px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <nav>
            <?php
                if (isset($_SESSION['docname'])) {
                    echo '<div class="user-info">';
                    echo '<img src="images\icons8-male-user-100.png" alt="User Image">';
                    echo '<p>' . $_SESSION['docname'] . '</p>';
                    echo '</div>';
                }
                ?>
                <ul>
                    <li><a href="doc-home.php">Dashboard</a></li>
                    <li><a href="doc_app-hist.php">Appointment History</a></li>
                    <li><a href="dr-pres_hist.php">Prescriptions</a></li>
                </ul>
            </nav>
        </div>
        <main>
        <button class="logout_button">
            <img src="images/logout_5509651.png" alt="Logout">
            <span><a href="login.php">Logout</a></span>
        </button>
            <div class="icons">
                <div class="row">
                    <a href="doc_app-hist.php" class="icon">
                        <img src="images/icons8-booking-100.png" alt="Book Appointment">
                        <span>View Appointments</span>
                    </a>
                </div>
                <div class="row">
                    <a href="dr-pres_hist.php" class="icon">
                        <img src="images/icons8-treatment-100.png" alt="Prescriptions">
                        <span>Prescriptions</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>