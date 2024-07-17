<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient List</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap');

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
            margin-left: 200px;
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
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: none;
            text-align: left;
            padding: 8px;
            padding-left: 20px;
        }

        th {
            background-color: #66A5AD;
            color: #333;
            font-weight: bold;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
            text-decoration: none;
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
        <button class="logout_button">
            <img src="images/logout_5509651.png" alt="Logout">
            <span><a href="login.php">Logout</a></span>
        </button>
        <main>
            <div class="header">Appointment History</div>
            <table>
                <tr>
                    <th>Patient Id</th>
                    <th>Doctor Id</th>
                    <th>Appointment Id</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Specialization</th>
                    <th>Fees</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
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
                $sql = "SELECT id,patient_id,doc_id,username,doctor,specialization,fees,date,time,status FROM appointments";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["patient_id"] . "</td>
                                <td>" . $row["doc_id"] . "</td>
                                <td>" . $row["username"] . "</td>
                                <td>" . $row["doctor"] . "</td>
                                <td>" . $row["specialization"] . "</td>
                                <td>" . $row["fees"] . "</td>
                                <td>" . $row["date"] . "</td>
                                <td>" . $row["time"] . "</td>
                                <td>" . $row["status"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No records found</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </main>
    </div>
</body>

</html>