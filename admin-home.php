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
        .logout_button {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #116466; 
            border: none;
            cursor: pointer;
			background-color: transparent;
			
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
			filter: invert(78%) sepia(17%) saturate(1773%) hue-rotate(177deg) brightness(93%) contrast(92%);
            opacity: 0.9; 
			color: #66A5AD;
            
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-left: 200px;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <nav>
                <ul>
                    <li><a href="admin-home.php">Dashboard</a></li>
                    <li><a href="admin_doc-list.php">Doctor List</a></li>
                    <li><a href="admin-pat-list.php">Patient list</a></li>
                    <li><a href="admin-app-hist.php">Appointments</a></li>
                    <li><a href="admin_pres.php">Prescriptions</a></li>
                    <li><a href="admin_add-dr.php">Add Doctor</a></li>
                    <li><a href="admin_rm-dr.php">Remove Doctor</a></li>
                    <li><a href="contact-us-admin.php">Queries</a></li>
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
                    <a href="admin_doc-list.php" class="icon">
                        <img src="images/medical-team.png" alt="Book Appointment">
                        <span>Doctor List</span>
                    </a>
                    <a href="" class="icon">
                        <img src="images/icons8-patient-100.png" alt="Patient List">
                        <span>Patient List</span>
                    </a>
                    <a href="admin-app-hist.php" class="icon">
                        <img src="images/icons8-treatment-100.png" alt="Prescriptions">
                        <span>Appointment Details</span>
                    </a>
                </div>
                <div class="row">
                    <a href="admin_add-dr.php" class="icon">
                        <img src="images/icons8-add-administrator-100.png" alt="add-doctor">
                        <span>Add Doctor</span>
                    </a>
                    <a href="admin_rm-dr.php" class="icon">
                        <img src="images/icons8-remove-100.png" alt="remove-doctor">
                        <span>Remove Doctor</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
