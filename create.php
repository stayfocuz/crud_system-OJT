<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "INSERT INTO clients (username, email, password) VALUES ('$username', '$email', '$password')";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>New Client</h2>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Create</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>