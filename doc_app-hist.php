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
        echo "<script>alert('Appointment cancelled successfully'); window.location.href = 'doc_app-hist.php';</script>";
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
    <title>Doctors List</title>
    <style>
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
            background-color: transparent;
            color: #116466;
            border: none;
            cursor: pointer;
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
            filter: invert(78%) sepia(17%) saturate(1773%) hue-rotate(177deg) brightness(93%) contrast(92%);
            opacity: 0.9;
            color: #66A5AD;
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

        .prescribe_button {
            background-color: #ff6f61;
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

        .prescribe_button:hover {
            background-color: #ff8b7b;
            color: black;
        }
    </style>
</head>


<body>
    <div class="container">
        <div class="box">
            <nav>
                <ul>
                    <li><a href="doc-home.php">Dashboard</a></li>
                    <li><a href="#">Appointments</a></li>
                    <li><a href="#">Prescription List</a></li>
                </ul>
            </nav>
        </div>
        <main>
            <div class="header">Appointments</div>
            <table>
                <tr>
                    <th>Patient ID</th>
                    <th>Appointment ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Fees</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Current Status</th>
                    <th>Action</th>
                    <th>Prescribe</th>
                </tr>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_test";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if (isset($_SESSION['docname'])) {
                    $doctor_name = $_SESSION['docname'];
                    $sql = "SELECT a.patient_id, a.id AS appointment_id, a.doc_id, CONCAT(p.first_name, ' ', p.last_name) AS name, p.phone, a.fees, a.date, a.time, a.status
                            FROM appointments AS a
                            INNER JOIN patients AS p ON a.patient_id = p.pat_id
                            WHERE a.doctor = '$doctor_name'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["patient_id"] . "</td>";
                            echo "<td>" . $row["appointment_id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["fees"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["time"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo "<td>";
                            if ($row["status"] === 'Active') {
                                echo "<form id='cancelForm" . $row["appointment_id"] . "' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                                echo "<input type='hidden' name='cancel_id' value='" . $row["appointment_id"] . "'>";
                                echo "<button type='button' class='cancel_button' onclick='cancelAppointment(" . $row["appointment_id"] . ")'>Cancel</button>";
                                echo "</form>";
                            } else {
                                echo "-";
                            }
                            echo "</td>";
                            echo "<td>";
                            $prescriptionCheckSql = "SELECT * FROM prescription WHERE apt_id = ? AND pat_id = ?";
                            $prescriptionCheckStmt = $conn->prepare($prescriptionCheckSql);
                            $prescriptionCheckStmt->bind_param("ii", $row["appointment_id"], $row["patient_id"]);
                            $prescriptionCheckStmt->execute();
                            $prescriptionResult = $prescriptionCheckStmt->get_result();

                            if ($prescriptionResult->num_rows > 0) {
                                echo "Prescribed";
                            } else {
                                echo "<form id='prescribeForm" . $row["appointment_id"] . "' action='dr-prescribe.php' method='post'>";
                                echo "<input type='hidden' name='appointment_id' value='" . $row["appointment_id"] . "'>";
                                echo "<input type='hidden' name='patient_id' value='" . $row["patient_id"] . "'>";
                                echo "<input type='hidden' name='doc_id' value='" . $row["doc_id"] . "'>";
                                echo "<button type='submit' class='prescribe_button'>Prescribe</button>";
                                echo "</form>";
                            }

                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No appointments found</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Session variable not set</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </main>
    </div>
</body>
<script>
    function cancelAppointment(id) {
        if (confirm("Are you sure you want to cancel this appointment?")) {
            document.getElementById("cancelForm" + id).submit();
        }
    }
</script>

</html>