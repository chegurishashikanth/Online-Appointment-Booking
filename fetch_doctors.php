<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$specialization = $_GET['specialization'];

$sql = "SELECT name FROM doctors WHERE specialization='$specialization'";
$result = $conn->query($sql);

$doctors = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

echo json_encode($doctors);

$conn->close();
?>
