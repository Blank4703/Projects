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

	$stmt = $conn->prepare("DELETE FROM projects WHERE pid = :pid");
	$stmt->bindParam(':pid', $pid);

	$stmt->execute();
	header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/dashboard.php");
    exit();
} else {
    header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/dashboard.php");
    exit();
}
?>