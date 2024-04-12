<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=u_220213303_portfolio3;port=80", "u-220213303", "axLESwFgJz0bpg5");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["usern"];
    $password = $_POST["pass"];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo "Email already exists";
        exit();
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo "Username already exists";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':email', $email);
    echo '<script>alert("Registration Complete!")</script>';
    $stmt->execute();
    header("Location:http://220213303.cs2410-web01pvm.aston.ac.uk/login.html");
    exit();
}
?>