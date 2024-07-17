<?php
session_start();
require ('fpdf/fpdf.php');

if (isset($_GET['generate_receipt'])) {
    if (isset($_GET['apt_id'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_test";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $apt_id = $_GET['apt_id'];
        $patient_username = $_SESSION['username'];

        $sql = "SELECT p.apt_id, p.doc_id, p.disease, p.precautions, p.medicines, d.name as doctor_name, t.pat_id, t.first_name, t.last_name, a.fees
                FROM prescription p
                JOIN doctors d ON p.doc_id = d.doctor_id
                JOIN patients t ON p.pat_id = t.pat_id
                JOIN appointments a ON p.apt_id = a.id
                WHERE p.apt_id = ? AND t.first_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $apt_id, $patient_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);

            $title = 'Central Hospital';
            $titleWidth = $pdf->GetStringWidth($title);
            $pdf->SetX(($pdf->GetPageWidth() - $titleWidth) / 2);
            $pdf->Cell($titleWidth, 10, $title);
            $pdf->Ln();
            $pdf->Ln();

            $pdf->Cell(40, 10, 'Appointment Receipt');
            $pdf->Ln();
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(40, 10, 'Appointment ID: ' . $row['apt_id']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Doctor ID: ' . $row['doc_id']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Doctor Name: ' . $row['doctor_name']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Patient ID: ' . $row['pat_id']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Patient Name: ' . $row['first_name'] . ' ' . $row['last_name']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Disease: ' . $row['disease']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Precautions: ' . $row['precautions']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Medicines: ' . $row['medicines']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Fees: ' . $row['fees']);

            $pdf->Output('I', 'Appointment_Receipt.pdf');
        } else {
            echo "No data found for this appointment.";
        }

        $conn->close();
    }
    exit;
}
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

        .receipt_button {
            background-color: #116466;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .receipt_button:hover {
            background-color: #C4DFE6;
            color: #116466;
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
        <main>
            <div class="header">Prescriptions</div>
            <table>
                <tr>
                    <th>Appointment ID</th>
                    <th>Doctor ID</th>
                    <th>Doctor</th>
                    <th>Problem</th>
                    <th>Suggestions</th>
                    <th>Medicines</th>
                    <th>Receipt</th>
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

                if (isset($_SESSION['username'])) {
                    $patient_username = $_SESSION['username'];

                    echo "<script>console.log('Session Username: " . $patient_username . "');</script>";

                    $sql = "SELECT p.apt_id, p.doc_id, p.disease, p.precautions, p.medicines, d.name
                            FROM prescription p
                            JOIN doctors d ON p.doc_id = d.doctor_id
                            JOIN patients t ON p.pat_id = t.pat_id
                            WHERE t.first_name = ?";
                    $stmt = $conn->prepare($sql);
                    if (!$stmt) {
                        die("Prepare statement failed: " . $conn->error);
                    }
                    $stmt->bind_param("s", $patient_username);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["apt_id"] . "</td>";
                            echo "<td>" . $row["doc_id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["disease"] . "</td>";
                            echo "<td>" . $row["precautions"] . "</td>";
                            echo "<td>" . $row["medicines"] . "</td>";
                            echo '<td>
                                    <form action="" method="get" target="_blank">
                                        <input type="hidden" name="apt_id" value="' . $row["apt_id"] . '">
                                        <button type="submit" name="generate_receipt" class="receipt_button">Receipt</button>
                                    </form>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No prescriptions found</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Please log in to view your prescriptions</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </main>
    </div>
</body>

</html>
