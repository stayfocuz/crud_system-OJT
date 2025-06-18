<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$success = false;
$user_id = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    if ($username !== "" && $email !== "" && $password !== "") {
        $sql = "INSERT INTO clients (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql)) {
            $success = true;
            $user_id = $conn->insert_id;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }
        .container {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
            color: #333;
        }
        h2 {
            text-align: center;
            color: #2575fc;
            font-weight: 700;
            margin-bottom: 25px;
        }
        .btn-primary {
            background-color: #2575fc;
            border-color: #2575fc;
        }
        .btn-primary:hover {
            background-color: #1a5edb;
            border-color: #1a5edb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: none;
        }
        label {
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2>User Registration</h2>
    <?php if ($success): ?>
        <div class="alert alert-success">Registration successful!</div>
        <a href="profile.php?id=<?php echo $user_id; ?>" class="btn btn-success w-100 mt-3">View Profile</a>
    <?php endif; ?>
    <?php if (!$success): ?>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required maxlength="100">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required maxlength="100">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required maxlength="100">
        </div>
        <button class="btn btn-primary w-100">Register</button>
    </form>
    <div class="text-center mt-3">
        <a href="login.php" class="btn btn-link">Already have an account? Log In</a>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
