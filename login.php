<?php
ob_start(); // Prevent header issues
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = trim($_POST["username"]);
    $input_password = trim($_POST["password"]);
    if ($input_username !== "" && $input_password !== "") {
        $sql = "SELECT * FROM clients WHERE username='$input_username' AND password='$input_password'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            header("Location: profile.php?id=" . $user['id']);
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #9face6);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            margin-top: 80px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        h2 {
            text-align: center;
            font-weight: 700;
            color: #4a4e69;
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #5e60ce;
            border-color: #5e60ce;
        }
        .btn-primary:hover {
            background-color: #4ea8de;
            border-color: #4ea8de;
        }
        .alert {
            border-radius: 6px;
        }
        .btn-link {
            text-decoration: none;
            color: #5e60ce;
        }
        .btn-link:hover {
            color: #4ea8de;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🔐 Sign In</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Sign In</button>
    </form>
    <div class="text-center mt-3">
        <a href="register.php" class="btn btn-link">Don't have an account? Sign Up</a>
    </div>
</div>
</body>
</html>
