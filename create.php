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
    <style>
    .truncate {
        max-width: 200px;      /* Adjust width as needed */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: middle;
    }
    </style>
</head>
<body>
<div class="container my-5">
    <h2>New Client</h2>
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
            <input type="text" name="password" class="form-control" required maxlength="100">
        </div>
        <button class="btn btn-primary">Create</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<div class="container my-5">
    <h2>Clients List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM clients";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><span class='truncate'>" . htmlspecialchars($row['username']) . "</span></td>";
                    echo "<td><span class='truncate'>" . htmlspecialchars($row['email']) . "</span></td>";
                    echo "<td><span class='truncate'>" . htmlspecialchars($row['password']) . "</span></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No clients found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>