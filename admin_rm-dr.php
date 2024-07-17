<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctor List</title>
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
            justify-content: start;
            align-items: baseline;
            height: 100vh;
            margin-left: 400px;
            flex-direction: column; 
            padding: 20px;
        }

        .doctor-list {
            width: 100%; 
            max-width: 500px; 
            margin: auto; 
            text-align: center; 
        }

        .doctor-list h1 {
            margin-bottom: 20px; 
        }

        form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; 
            margin-bottom: 20px; 
        }

        label {
            font-size: 18px; 
        }

        input[type="text"] {
            padding: 10px; 
            font-size: 16px;
            width: 300px; 
            margin-bottom: 10px; 
        }

        button[type="submit"] {
            padding: 12px 20px; 
            font-size: 16px; 
            background-color: #116466; 
            color: white; 
            border: none; 
            border-radius: 5px;
            cursor: pointer; 
            transition: background-color 0.3s; 
            width: 200px;
        }

        button[type="submit"]:hover {
            background-color: #66A5AD;
            transition: background-color 0.3s ease;
            color:black;
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
            <div class="doctor-list">
                <h1>Doctor List</h1>
                <form action="" method="get">
                    <label for="email">Enter Email:</label>
                    <input type="text" id="email" name="email">
                    <button type="submit">Delete </button>
                </form>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_test";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_GET["email"]) && !empty($_GET["email"])) {
                    $email = $_GET["email"];

                    $sql = "DELETE FROM doctors WHERE email='$email'";
                    if (mysqli_query($conn, $sql)) {
                        echo "Doctor with email $email deleted successfully.";
                    } else {
                        echo "Error deleting doctor: " . mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </main>
</body>

</html>