<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_test";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_patient = "SELECT * FROM patients WHERE email = '$email'";
    $result_patient = $conn->query($sql_patient);

    if ($result_patient->num_rows > 0) {
        $row_patient = $result_patient->fetch_assoc();
        $hashed_password_patient = $row_patient['password'];

        if (password_verify($password, $hashed_password_patient)) {
            $full_name_patient = $row_patient['first_name'];
            $_SESSION['username'] = $full_name_patient;
            header("Location: pat-home.php");
            exit();
        } else {
            echo "<script>alert('Invalid password. Please try again.');</script>";
        }
    } else {
        $sql_doctor = "SELECT * FROM doctors WHERE email = '$email' AND password = '$password'";
        $result_doctor = $conn->query($sql_doctor);

        if ($result_doctor->num_rows > 0) {
            $row_doctor = $result_doctor->fetch_assoc();
            $_SESSION['docname'] = $row_doctor['name'];
            header("Location: doc-home.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: flex-end;
            background-color: #116466;
            padding: 10px 20px;
            color: white;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin-left: 20px;
        }

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
            margin-left: 20px;
        }

        .logout-btn:hover {
            background-color: #66A5AD;
        }

        .logout-btn a {
            color: white;
            text-decoration: none;
        }

        .hero {
            height: 100vh;
            width: 100%;
            background: linear-gradient(#116466, #66A5AD);
            position: absolute;
        }

        .input-field input {
            width: 90%;
            height: 100%;
            border: none;
            outline: none;
            border: 4px solid rgba(113, 129, 133, 0.2);
            border-radius: 40px;
            font-size: 16px;
            color: #000000;

            padding: 20px 45px 20px 20px;
        }

        .input-field input::placeholder {
            color: #000000;
        }

        .form-box {
            width: 380px;
            height: 480px;
            position: relative;
            margin: 6% auto;
            background: white;
            padding: 5px;
            overflow: hidden;
            color: #1a1717;
            padding: 30px 40px;
            backdrop-filter: blur(20px);
            margin-top: 50px;
        }

        .button-box {
            display: flex;
            justify-content: space-between;
            width: 380px;
            margin: 35px auto;
            position: relative;
            box-shadow: 0 0 20px 9px #ff61241f;
            border-radius: 30px;
            overflow: hidden;
        }

        .toggle-btn {
            flex: 1;
            padding: 10px 30px;
            cursor: pointer;
            background: transparent;
            border: 0;
            outline: none;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        #btn {
            top: 0;
            left: 0;
            position: absolute;
            width: 130px;
            height: 100%;
            background: #116466;
            border-radius: 30px;
            transition: left 0.5s;
            z-index: 0;
        }

        .social-icons {
            margin: 30px auto;
            text-align: center;
        }

        .social-icons img {
            width: 30px;
            margin: 0 12px;
            box-shadow: 0 0 20px 0 #7f7f7f3d;
            cursor: pointer;
            border-radius: 50%;
        }

        .input-group {
            top: 180px;
            position: absolute;
            width: 280px;
            transition: left 0.5s;
            left: 50px;
        }

        .input-field {
            width: 100%;
            padding: 10px 0;
            margin: 5px 0;
            border-left: 0;
            border-radius: 40px;
            border-top: 0;
            border-right: 0;
            outline: none;
            background: transparent;
        }

        .submit-btn {
            width: 85%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin: auto;
            background-color: #116466;
            border: 0;
            outline: none;
            border-radius: 30px;
            color: #fff;
        }

        .submit-btn:hover {
            background-color: #66A5AD;
            transition: background-color 0.3s ease;
            color: black;
        }

        .check-box {
            margin: 30px 10px 30px 0;
        }

        span {
            color: #777;
            font-size: 12px;
            bottom: 68px;
            position: absolute;
        }

        #login-form {
            left: 50px;
        }

        #doctor-form {
            left: -400px;
        }

        #admin-form {
            left: -400px;
        }

        h2 {
            color: #116466;
            text-align: center;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <button class="logout-btn"><a href="login.php"> Home </a></button>
        <button class="logout-btn"><a href="doc_app-hist.php"> About </a></button>
        <button class="logout-btn"><a href="contact-us.php"> Contact Us</a></button>
    </nav>

    <div class="hero">
        <div class="form-box">
            <h2>Login Here</h2>
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="slide('login')">Patient</button>
                <button type="button" class="toggle-btn" onclick="slide('register')">Doctor</button>
                <button type="button" class="toggle-btn" onclick="slide('admin')">Admin</button>
            </div>
            <form id="login-form" class="input-group" method="POST" action="">
                <div class="input-field"> <input type="text" placeholder="Email" required name="email"></div>
                <div class="input-field"><input type="password" placeholder="Enter Password" required name="password">
                </div>
                Not Registered? <a href="register.php">Register Here</a><br>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">Log in</button>
            </form>
            <form id="doctor-form" class="input-group" method="POST" action="">
                <div class="input-field"> <input type="text" placeholder="E-Mail" required id="Doctor id" name="email">
                </div>
                <div class="input-field"><input type="password" placeholder="Enter Password" required id="password"
                        name="password">
                </div>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="submit" class="submit-btn">Login</button>
            </form>
            <form id="admin-form" class="input-group">
                <div class="input-field"><input type="text" placeholder="Admin ID" required id="adminId"></div>
                <div class="input-field"><input type="password" placeholder="Enter Password" required
                        id="adminPassword">
                </div>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <button type="button" class="submit-btn" onclick="checkAdminCredentials()">Admin Login</button>
            </form>
        </div>
    </div>
    <script>
        var forms = {
            "login": document.getElementById("login-form"),
            "register": document.getElementById("doctor-form"),
            "admin": document.getElementById("admin-form")
        };
        var toggleBtn = document.getElementById("btn");

        function slide(form) {
            Object.keys(forms).forEach(key => {
                if (key === form) {
                    forms[key].style.left = "50px";
                } else {
                    forms[key].style.left = "-400px";
                }
            });
            switch (form) {
                case "login":
                    toggleBtn.style.left = "0";
                    break;
                case "register":
                    toggleBtn.style.left = "130px";
                    break;
                case "admin":
                    toggleBtn.style.left = "260px";
                    break;
            }
        }

        function checkAdminCredentials() {
            const adminId = document.getElementById("adminId").value;
            const adminPassword = document.getElementById("adminPassword").value;

            console.log("Admin ID:", adminId);
            console.log("Admin Password:", adminPassword);

            if (adminId === "azhar" && adminPassword === "27272727") {
                window.location.href = "admin-home.php";
            } else {
                alert("Invalid admin ID or password.");
            }
        }

    </script>
</body>

</html>