<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=u_220213303_portfolio3", "u-220213303", "axLESwFgJz0bpg5");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["uid"] = $user['uid'];
        header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/dashboard.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}

?>