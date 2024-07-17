<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_test";

$message = ""; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["specialization"]) && isset($_POST["doc-list"]) && isset($_POST["appointment-fees"]) && isset($_POST["appointment-date"]) && isset($_POST["appointment-time"])) {
        $specialization = $_POST["specialization"];
        $doctor = $_POST["doc-list"];
        $fees = $_POST["appointment-fees"];
        $date = $_POST["appointment-date"];
        $time = $_POST["appointment-time"];
        $username = $_SESSION['username'];

        $sql_check = "SELECT * FROM appointments WHERE doctor = ? AND date = ? AND time = ?";
        $stmt = $conn->prepare($sql_check);
        $stmt->bind_param("sss", $doctor, $date, $time);
        $stmt->execute();
        $result_check = $stmt->get_result();

        if ($result_check->num_rows > 0) {
            // This block intentionally left blank to remove the message
        } else {
            $sql = "INSERT INTO appointments (username, doctor, specialization, fees, date, time) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $username, $doctor, $specialization, $fees, $date, $time);
            if ($stmt->execute()) {
                $sql_update_pat_id = "UPDATE appointments AS a
                                      JOIN patients AS u ON a.username = u.first_name
                                      SET a.patient_id = u.pat_id";
                $conn->query($sql_update_pat_id);

                $sql_update_doc_id = "UPDATE appointments AS a
                                      JOIN doctors AS d ON a.doctor = d.name
                                      SET a.doc_id = d.doctor_id";
                $conn->query($sql_update_doc_id);

                $message = "Appointment booked successfully!";
            } else {
                $message = "Error: Appointment could not be booked.";
            }
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Appointment</title>
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

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            margin-left: 360px;
        }

        label {
            font-size: 18px;
            font-family: Arial, sans-serif;
            display: inline-block;
            margin-right: 10px;
        }

        select {
            font-size: 18px;
            width: 400px;
            height: 40px;
            margin-bottom: 20px;
        }

        #doc-list {
            margin-left: 50px;
        }

        input[type="text"][readonly] {
            font-size: 18px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 3px;
            width: 400px;
            background-color: #f0f0f0;
            color: #333;
            margin-left: 72px;
        }

        input[type="date"] {
            font-size: 18px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 3px;
            width: 400px;
            background-color: #f0f0f0;
            color: #333;
            margin-left: 75px;
            margin-top: 20px;
        }

        select.time-select {
            font-size: 18px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 3px;
            width: 400px;
            background-color: #f0f0f0;
            color: #333;
            margin-left: 75px;
            margin-top: 20px;
        }

        button.confirm {
            background-color: #116466;
            border-radius: 6px;
            width: 350px;
            margin-top: 35px;
            margin-left: 160px;
            height: 40px;
        }

        button.confirm:hover {
            background-color: #024590;
            transition: background-color 0.3s ease;
        }

        button.confirm a {
            color: rgb(247, 245, 245);

        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .user-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .user-info img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }

        .user-info p {
            color: #fff;
            font-size: 18px;
            margin-top: 10px;
            text-align: center;
            margin-bottom: 75px;
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
                    echo '<img src="images\icons8-male-user-100.png" alt="User Image">';
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
            <div class="book">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <h1>Book Appointment</h1><br>
                    <label for="specialization">Specialization:</label>
                    <select id="specialization" name="specialization">
                        <option value="" selected disabled hidden>Select an option</option>
                        <option value="general">General</option>
                        <option value="cardiology">Cardiology</option>
                        <option value="neurology">Neurology</option>
                        <option value="oncology">Oncology</option>
                    </select><br>
                    <label for="doc-list">Doctors:</label>
                    <select id="doc-list" name="doc-list" onchange="updateDoctorFees()">
                        <option value="" selected disabled hidden>Select a specialization first</option>
                    </select><br>
                    <label for="appointment-fees">Fees:</label>
                    <input type="text" id="appointment-fees" name="appointment-fees" readonly><br>
                    <label for="appointment-date">Date:</label>
                    <input type="date" id="appointment-date" name="appointment-date" min="<?php echo date('Y-m-d'); ?>"
                        max="<?php echo date('Y-m-d', strtotime('+7 day')); ?>"><br>
                    <label for="appointment-time">Time:</label>
                    <select id="appointment-time" name="appointment-time" class="time-select">
                        <option value="" selected disabled hidden>Select a time</option>
                        <option value="11:00">11:00 AM</option>
                        <option value="13:00">1:00 PM</option>
                        <option value="15:00">3:00 PM</option>
                        <option value="17:00">5:00 PM</option>
                    </select><br>
                    <button class="confirm" onclick="submitForm(event)">Book Appointment</button>
                </form>
                <div id="message"><?php echo $message; ?></div>
            </div>
        </main>
        <script>
            function submitForm(event) {
                event.preventDefault();
                var specialization = document.getElementById("specialization").value;
                var doctor = document.getElementById("doc-list").value;
                var fees = document.getElementById("appointment-fees").value;
                var date = document.getElementById("appointment-date").value;
                var time = document.getElementById("appointment-time").value;

                var xhr = new XMLHttpRequest();

                xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", true);

                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText); 
                        if (xhr.responseText === "Appointment booked successfully!") {
                            window.location.href = "pat-home.php";
                        }
                    }
                };

                var formData = "specialization=" + encodeURIComponent(specialization) +
                    "&doc-list=" + encodeURIComponent(doctor) +
                    "&appointment-fees=" + encodeURIComponent(fees) +
                    "&appointment-date=" + encodeURIComponent(date) +
                    "&appointment-time=" + encodeURIComponent(time);

                xhr.send(formData);
            }

            document.getElementById('specialization').addEventListener('change', function () {
                var specialization = this.value;
                var doctorDropdown = document.getElementById('doc-list');
                doctorDropdown.innerHTML = '<option value="" selected disabled hidden>Select a doctor</option>';
                if (specialization !== "") {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'fetch_doctors.php?specialization=' + specialization, true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                            var doctors = JSON.parse(xhr.responseText);
                            if (doctors.length > 0) {
                                doctors.forEach(function (doctor) {
                                    var option = document.createElement('option');
                                    option.value = doctor.name;
                                    option.textContent = doctor.name;
                                    doctorDropdown.appendChild(option);
                                });
                            } else {
                                doctorDropdown.innerHTML = '<option value="" disabled>No doctors available for this specialization</option>';
                            }
                        }
                    };
                    xhr.send();
                }
            });

            function updateDoctorFees() {
                var doctor = document.getElementById('doc-list').value;
                var feesInput = document.getElementById('appointment-fees');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_doctor_fees.php?doctor=' + doctor, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        var fees = xhr.responseText;
                        feesInput.value = fees;
                    }
                };
                xhr.send();
            }
        </script>
    </div>
</body>

</html>
