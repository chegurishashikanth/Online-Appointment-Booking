<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctors List</title>
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

        main {
            display: flex;
            justify-content: start;
            align-items: baseline;
            height: 100vh;
            margin: 10px;
            flex-direction: column;
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
            color: #333;
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
            <div class="header">Doctors List</div>
            <table>
                <tr>
                    <th>Doctor ID</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Fees</th>
                    <th>E-Mail</th>
                    <th>Password</th>
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


                $sql = "SELECT doctor_id,name, specialization, fees, email, password FROM doctors";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["doctor_id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["specialization"] . "</td>";
                        echo "<td>" . $row["fees"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["password"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>0 results</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </main>
    </div>
</body>

</html>