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
    $title = $_POST["title"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $phase = $_POST["phase"];
    $desc = $_POST["desc"];


    try {

        $uid = $_SESSION["uid"];
    	
        $stmt = $conn->prepare("SELECT * FROM projects WHERE title = :title");
        $stmt->bindParam(':title', $title);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Project with title '$title' already exists.";
        } else {
            $stmt = $conn->prepare("INSERT INTO projects (title, start_date, end_date, phase, description, uid) VALUES (:title, :start, :end, :phase, :desc, :uid)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->bindParam(':phase', $phase);
            $stmt->bindParam(':desc', $desc);
        	$stmt->bindParam(':uid', $uid);
            $stmt->execute();
            echo "Project added successfully.";
        }
    	header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/dashboard.php");
        exit();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
		header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/dashboard.php");
        exit();
}
?>