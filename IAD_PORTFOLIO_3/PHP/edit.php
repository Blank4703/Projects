<?php
session_start();
try {
    $conn = new PDO("mysql:host=localhost;dbname=u_220213303_portfolio3;port=80", "u-220213303", "axLESwFgJz0bpg5");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_POST['pid'];

// Then, prepare the update statement with bound parameters
	$stmt = $conn->prepare("UPDATE projects SET title = :title, phase = :phase, start_date = :start_date, end_date = :end_date, description = :description WHERE pid = :pid");

// Bind the input parameters to the prepared statement
	$stmt->bindParam(':title', $_POST['ed-title']);
	$stmt->bindParam(':phase', $_POST['ed-phase']);
	$stmt->bindParam(':start_date', $_POST['ed-start']);
	$stmt->bindParam(':end_date', $_POST['ed-end']);
	$stmt->bindParam(':description', $_POST['ed-desc']);
	$stmt->bindParam(':pid', $pid);

// Execute the update statement
	$stmt->execute();
	header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/dashboard.php");
    exit();
} else {
    header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/dashboard.php");
    exit();
}
?>