<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_test";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $appointment_id = $_POST['appointment_id'];
    $patient_id = $_POST['patient_id'];
    $doc_id = $_POST['doc_id'];
    $disease = isset($_POST['disease']) ? $_POST['disease'] : '';
    $precautions = isset($_POST['precautions']) ? $_POST['precautions'] : '';
    $medicines = isset($_POST['medicines']) ? $_POST['medicines'] : '';

    if (empty($disease) || empty($precautions) || empty($medicines)) {
        echo "<script>alert('Please fill in all fields!');</script>";
    } else {
        $sql = "INSERT INTO prescription (disease, precautions, medicines, apt_id, pat_id, doc_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiii", $disease, $precautions, $medicines, $appointment_id, $patient_id, $doc_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Prescription is forwarded'); window.location.href = 'doc_app-hist.php';</script>";
        } else {
            echo "<script>alert('Error inserting prescription details!');</script>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page with Navbar and Sections</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        section h2 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #333;
        }

        .content-area {
            display: flex;
            flex-direction: column;
        }

        .content-area textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            resize: vertical;
        }

        .prescribe-btn {
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

        .prescribe-btn:hover {
            background-color: #66A5AD;
        }

        .logout-btn a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <button class="logout-btn"><a href="doc_app-hist.php">Back</a></button>
    </nav>

    <div class="container">
        <form id="prescriptionForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <section>
                <h2>Disease</h2>
                <div class="content-area">
                    <textarea name="disease" id="disease" placeholder="Write about the disease..."></textarea>
                </div>
            </section>

            <section>
                <h2>Precautions</h2>
                <div class="content-area">
                    <textarea name="precautions" id="precautions" placeholder="Write about the precautions..."></textarea>
                </div>
            </section>

            <section>
                <h2>Medicines</h2>
                <div class="content-area">
                    <textarea name="medicines" id="medicines" placeholder="Write about the medicines..."></textarea>
                </div>
            </section>

            <input type="hidden" name="appointment_id" value="<?php echo isset($_POST['appointment_id']) ? $_POST['appointment_id'] : ''; ?>">
            <input type="hidden" name="patient_id" value="<?php echo isset($_POST['patient_id']) ? $_POST['patient_id'] : ''; ?>">
            <input type="hidden" name="doc_id" value="<?php echo isset($_POST['doc_id']) ? $_POST['doc_id'] : ''; ?>">

            <button class="prescribe-btn">Prescribe</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var disease = document.getElementById('disease').value;
            var precautions = document.getElementById('precautions').value;
            var medicines = document.getElementById('medicines').value;
            if (disease.trim() === '' || precautions.trim() === '' || medicines.trim() === '') {
                alert('Please fill in all fields!');
            } else {
                document.getElementById('prescriptionForm').submit();
            }
        }

        document.querySelector('.prescribe-btn').addEventListener('click', function (event) {
            event.preventDefault();
            validateForm();
        });
    </script>
</body>
</html>