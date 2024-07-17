<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_test";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel_id'])) {
    $cancel_id = $_POST['cancel_id'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE appointments SET status = 'Cancelled' WHERE id = $cancel_id AND status = 'active'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Appointment cancelled successfully'); window.location.href = 'pat_app-hist.php';</script>";
    } else {
        echo "<script>alert('Error cancelling appointment: " . $conn->error . "'); window.location.href = 'pat_app-hist.php';</script>";
    }

    $conn->close();
    exit;
}
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

        .logout_button:hover {
            color: #66A5AD;
            opacity: 0.9;
        }

        .logout_button img {
            width: 40px;
            height: 40px;
            transition: 0.2s;
            filter: invert(78%) sepia(17%) saturate(45773%) hue-rotate(177deg) brightness(93%) contrast(92%);
            color: #116466;
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

        main {
            display: flex;
            justify-content: start;
            align-items: center;
            height: 100vh;
            margin: 10px;
            flex-direction: column;
            color: #116466;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th,
        td {
            border: none;
            text-align: left;
            padding: 8px;
            padding-left: 100px;
        }

        th {
            font-weight: bold;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }

        .cancel_button {
            background-color: #116466;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel_button:hover {
            background-color: #C4DFE6;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <nav>
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
            <div class="header">Appointment Details</div>
            <table>
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $username = $_SESSION['username'];
                $sql = "SELECT * FROM appointments WHERE username = '$username'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<tr><th>Doctor</th><th>Specialization</th><th>Fees</th><th>Date</th><th>Time</th><th>Status</th><th>Action</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["doctor"] . "</td>";
                        echo "<td>" . $row["specialization"] . "</td>";
                        echo "<td>" . $row["fees"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["time"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>";
                        if (strtolower($row["status"]) === "active") {
                            echo "<form id='cancelForm" . $row["id"] . "' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                            echo "<input type='hidden' name='cancel_id' value='" . $row["id"] . "'>";
                            echo "<button type='button' class='cancel_button' onclick='cancelAppointment(" . $row["id"] . ")'>Cancel</button>";
                            echo "</form>";
                        } else {
                            echo "-";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No appointments found</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </main>
    </div>

    <script>
        function cancelAppointment(id) {
            if (confirm("Are you sure you want to cancel this appointment?")) {
                document.getElementById("cancelForm" + id).submit();
            }
        }
    </script>
</body>

</html>
