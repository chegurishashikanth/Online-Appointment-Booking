<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Doctor</title>
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
            margin-left: 150px;
        }

        label {
            font-size: 18px;
            font-family: Arial, sans-serif;
            display: inline-block;
            margin-right: 10px;
            width: 150px;
            text-align: right;
            margin-right: 10px;
        }

        select {
            font-size: 18px;
            width: 405px;
            height: 40px;
            margin-top: 20px;
            margin-left: 74px;
        }

        #doc-list {
            margin-left: 50px;
        }

        input[type="text"][readonly] {
            font-size: 18px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 3px;
            width: 380px;
            background-color: #f0f0f0;
            color: #333;
            margin-left: 72px;
        }

        input[type="text"],
        [type="email"],
        [type="password"] {
            font-size: 18px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 3px;
            width: 403px;
            background-color: #f0f0f0;
            color: #333;
            margin-left: 75px;
            margin-top: 20px;
        }

        button.confirm {
            background-color:#116466;
            border-radius: 6px;
            width: 300px;
            height: 40px;
            margin-top: 45px;
            margin-left: 280px;
            color:#fff;
        }

        button.confirm:hover {
            background-color:  #66A5AD;
            transition: background-color 0.3s ease;
        }

        button.confirm a {
            color: white;
        }

        button.confirm a:hover {
            color: black;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #116466;
            margin-left:200px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-container label {
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container select {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_test";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $specialization = $_POST['specialization'];
        $fees = $_POST['fees'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql_check = "SELECT * FROM doctors WHERE email='$email'";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            echo '<script>alert("Doctor already exists!");</script>';
        } else {
            $sql = "INSERT INTO doctors (name, specialization, fees, email, password)
                VALUES ('$name', '$specialization', '$fees', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Doctor details have been added!");</script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    ?>


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
            <div class="book">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h1>Add Doctor</h1>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name"><br>

                    <label for="specialization">Specialization:</label>
                    <select id="specialization" name="specialization">
                        <option value="" selected disabled hidden>Select an option</option>
                        <option value="general">General</option>
                        <option value="cardiology">Cardiology</option>
                        <option value="neurology">Neurology</option>
                        <option value="oncology">Oncology</option>
                    </select><br>

                    <label for="fees">Fees:</label>
                    <input type="text" id="fees" name="fees"> <br>

                    <label for="email">E-Mail</label>
                    <input type="email" id="email" name="email"> <br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password"> <br>

                    <button type="submit" class="confirm">Add Doctor</button>
                </form>
            </div>
        </main>

        <?php
        $conn->close();
        ?>

</body>

</html>