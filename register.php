<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: sans-serif;
        }

        .navbar {
            padding: 10px 20px;
            color: white;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {}

        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .navbar ul li a:hover {
            text-decoration: none;
        }

        .logout-btn {
            background-color: #116466;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 550px;
        }

        .logout-btn:hover {
            background-color: #66A5AD;
        }

        .logout-btn a {
            color: white;
            text-decoration: none;
        }

        body {
            height: 100vh;
            width: 100%;
            background: linear-gradient(#116466, #66A5AD);
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            position: relative;
        }

        .container {
            width: 360px;
            height: 480px;
            margin: 8% auto;
            background: #ffffff;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #116466;
            margin-bottom: 50px;
        }

        .container form {
            width: 280px;
            position: absolute;
            top: 100px;
            left: 40px;
            transition: 0.5s;
        }

        form input {
            */ width: 90%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(113, 129, 133, 0.2);
            border-radius: 40px;
            font-size: 16px;
            color: #000000;
            padding: 20px 45px 20px 20px;
        }

        ::placeholder {
            color: #000000;
            font-size: 16px;
        }

        .btn-box {
            width: 100%;
            margin: 30px auto;
            text-align: center;
        }

        form button {
            background-color: #116466;
            border-radius: 6px;
            width: 110px;
            margin-top: 20px;
            height: 40px;
            color: #ffffff;
            cursor: pointer;
            border: none;
        }

        form button:hover {
            background-color: #66A5AD;
            transition: background-color 0.3s ease;
            color: black;
        }

        #form2 {
            left: 450px;
        }

        #form3 {
            left: 450px;
        }

        .step-row {
            width: 350px;
            height: 40px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            box-shadow: 0 -1px 5px -1px rgba(0, 0, 0, 0.1);
        }

        .step-col {
            width: 120px;
            text-align: center;
            color: white;
            position: relative;
        }

        #progress {
            position: absolute;
            height: 40px;
            width: 120px;
            background: #116466;
            transition: 1s;
        }

        #progress::after {
            content: ' ';
            height: 0;
            width: 0;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            position: absolute;
            right: -20px;
            top: 0;
            border-left: 20px solid #116466;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="form1" method="post">
            <h2>Register Here</h2>
            <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
            <div class="btn-box">
                Already registered? <a href="login.php">Login</a><br>
                <button type="button" id="next1">Next</button>
            </div>
        </form>
        <form id="form2">
            <h2>Enter Details</h2>
            <input type="email" name="email" id="email" placeholder="E-Mail" required>
            <input type="text" name="phone" id="phone" placeholder="Phone No" required>
            <div class="btn-box">
                <button type="button" id="back1">Back</button>
                <button type="button" id="next2">Next</button>
            </div>
        </form>
        <form id="form3" method="post" action="">
            <h2>Create Password</h2>
            <input type="hidden" name="first_name" id="hidden_first_name">
            <input type="hidden" name="last_name" id="hidden_last_name">
            <input type="hidden" name="email" id="hidden_email">
            <input type="hidden" name="phone" id="hidden_phone">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"
                required>
            <div class="btn-box">
                <button type="button" id="back2">Back</button>
                <button type="submit" id="submit">Submit</button>
            </div>
        </form>
        <div class="step-row">
            <div id="progress"></div>
            <div class="step-col"><small>Step 1</small></div>
            <div class="step-col"><small>Step 2</small></div>
            <div class="step-col"><small>Step 3</small></div>
        </div>
    </div>
    <script>
        var form1 = document.getElementById("form1");
        var form2 = document.getElementById("form2");
        var form3 = document.getElementById("form3");

        var next1 = document.getElementById("next1");
        var next2 = document.getElementById("next2");
        var back1 = document.getElementById("back1");
        var back2 = document.getElementById("back2");
        var submit = document.getElementById("submit");
        var progress = document.getElementById("progress");

        next1.onclick = function () {
            form1.style.left = "-450px";
            form2.style.left = "40px";
            progress.style.width = "240px";
        }

        back1.onclick = function () {
            form1.style.left = "40px";
            form2.style.left = "450px";
            progress.style.width = "120px";
        }

        next2.onclick = function () {
            form2.style.left = "-450px";
            form3.style.left = "40px";
            progress.style.width = "360px";

            document.getElementById("hidden_first_name").value = document.getElementById("first_name").value;
            document.getElementById("hidden_last_name").value = document.getElementById("last_name").value;
            document.getElementById("hidden_email").value = document.getElementById("email").value;
            document.getElementById("hidden_phone").value = document.getElementById("phone").value;
        }

        back2.onclick = function () {
            form2.style.left = "40px";
            form3.style.left = "450px";
            progress.style.width = "240px";
        }

        submit.onclick = function () {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;

            if (password !== confirm_password) {
                alert("Passwords do not match.");
            } else {
                form3.submit();
            }
        }
    </script>
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
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $check_query = "SELECT * FROM patients WHERE email='$email'";
        $result = $conn->query($check_query);
        if ($result->num_rows > 0) {
            echo "<script>alert('Email already registered. Please use a different one.');</script>";
        } else {
            if ($password === $confirm_password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO patients (first_name, last_name, email, phone, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$hashed_password')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Registration is complete'); window.location.href = 'login.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Passwords do not match.');</script>";
            }
        }
    }

    $conn->close();
    ?>

</body>

</html>