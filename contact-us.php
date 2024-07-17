<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $messageContent = $_POST['message'];

    $sql = "INSERT INTO contact (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$messageContent')";

    if ($conn->query($sql) === TRUE) {
        $message = "Feedback submitted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
            text-decoration: underline;
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

        .container {
            padding: 20px;
        }

        section {
            margin: 20px 0;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin-left: 350px;
        }

        section h2 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #116466;
            margin-bottom: 20px;
            text-align: center;
        }

        .content-area {
            display: flex;
            flex-direction: column;
        }

        .content-area input,
        .content-area textarea {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            color: black;
        }

        .content-area textarea {
            height: 100px;
            resize: vertical;
        }

        ::placeholder {
            color: #000000;
            font-size: 16px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            max-width: 200px;
            padding: 10px 20px;
            background-color: #116466;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px auto 0;
        }

        .submit-btn:hover {
            background-color: #66A5AD;
            color: black;
        }

        .logout-btn a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <button class="logout-btn"><a href="login.php"> Home </a></button>
        <button class="logout-btn"><a href="doc_app-hist.php"> About </a></button>
        <button class="logout-btn"><a href="contact-us.php"> Contact Us</a></button>
    </nav>

    <div class="container">
        <section>
            <h2>Feedback Form</h2>
            <form method="post" action="">
                <div class="content-area">
                    <input type="text" name="name" id="name" placeholder="Your Name" required>
                    <input type="text" name="phone" id="phone" placeholder="Phone Number" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <textarea name="message" id="message" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </section>
    </div>

    <?php if ($message != ""): ?>
    <script>
        alert('<?php echo $message; ?>');
    </script>
    <?php endif; ?>
</body>

</html>
