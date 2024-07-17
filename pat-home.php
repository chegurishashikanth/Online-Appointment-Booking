<?php
session_start();
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
        .menu_icon_box {
            display: none;
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
        .logout_button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #116466; 
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
            color: #66A5AD;
            filter: invert(78%) sepia(17%) saturate(1773%) hue-rotate(177deg) brightness(93%) contrast(92%);

        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .icons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            margin-left: 360px;
        }

        .icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 40px 70px;
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
            color: #C4DFE6;
        }

        .icon:hover span {
            color: #66A5AD;
        }


        .icon span {
            font-size: 18px;
            font-weight: bold;
            color: #333;
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
                if (isset($_SESSION['username'])) {
                    echo '<div class="user-info">';
                    echo '<img src="images\icons8-male-user-100.png" alt="User Image">';
                    echo '<p>' . $_SESSION['username'] . '</p>';
                    echo '</div>';
                }
                ?>
                <ul>
                    <li><a href="pat-home.php">Dashboard</a></li>
                    <li><a href="pat_book-app.php">Book Appointment</a></li>
                    <li><a href="pat_app-hist.php">Appointment History</a></li>
                    <li><a href="pat_pres.php">Prescriptions</a></li>
                </ul>
            </nav>
        </div>
        <button class="logout_button">
            <img src="images/logout_5509651.png" alt="Logout">
            <span>Logout</span>
        </button>
        <main>
            <div class="icons">
                <div class="row">
                    <a href="pat_book-app.php" class="icon">
                        <img src="images/icons8-booking-100.png" alt="Book Appointment">
                        <span>Book Appointment</span>
                    </a>
                    <a href="pat_app-hist.php" class="icon">
                        <img src="images/icons8-history-100.png" alt="Appointment History">
                        <span>Appointment History</span>
                    </a>
                </div>
                <div class="row">
                    <a href="pat_pres.php" class="icon">
                        <img src="images/icons8-treatment-100.png" alt="Prescriptions">
                        <span>Prescriptions</span>
                 </a> 
                </div>
            </div>
        </main>
    </div>
</body>

</html>