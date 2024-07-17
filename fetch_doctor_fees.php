<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$doctor = $_GET['doctor'];

$sql = "SELECT fees FROM doctors WHERE name='$doctor'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['fees'];
} else {
    echo "Doctor not found";
}

$conn->close();
?>
