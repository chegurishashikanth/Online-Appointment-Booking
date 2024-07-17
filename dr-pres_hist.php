<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prescriptions</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <nav>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<div class="user-info">';
                    echo '<img src="images/icons8-male-user-100.png" alt="User Image">';
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
        <main>
            <div class="header">Prescriptions</div>
            <table>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Problem</th>
                    <th>Suggestions</th>
                    <th>Medicines</th>
                </tr>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_test";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_SESSION['docname'])) {
                    $docname = $_SESSION['docname'];

                    $stmt = $conn->prepare("SELECT doctor_id FROM doctors WHERE name = ?");
                    $stmt->bind_param("s", $docname);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $doc_id = $row['doctor_id'];
                        $stmt = $conn->prepare("SELECT p.apt_id, t.pat_id, CONCAT(t.first_name, ' ', t.last_name) AS patient_name, p.disease, p.precautions, p.medicines 
                                                FROM prescription p 
                                                JOIN patients t ON p.pat_id = t.pat_id 
                                                WHERE p.doc_id = ?");
                        $stmt->bind_param("i", $doc_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["apt_id"] . "</td>";
                                echo "<td>" . $row["pat_id"] . "</td>";
                                echo "<td>" . $row["patient_name"] . "</td>";
                                echo "<td>" . $row["disease"] . "</td>";
                                echo "<td>" . $row["precautions"] . "</td>";
                                echo "<td>" . $row["medicines"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No prescriptions found for this doctor</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Doctor not found</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Please log in to view prescriptions</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </main>
    </div>
</body>

</html>
