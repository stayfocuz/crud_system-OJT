<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$user = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM clients WHERE id = $id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: #f8f9fa;
        }
        .center-viewport {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
<div class="center-viewport">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Client Information</h2>
            <?php if ($user): ?>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>ID:</strong> <?php echo $user['id']; ?></li>
                    <li class="list-group-item"><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
                    <li class="list-group-item"><strong>Password:</strong> <?php echo htmlspecialchars($user['password']); ?></li>
                    <li class="list-group-item"><strong>Created At:</strong> <?php echo $user['created_at']; ?></li>
                </ul>
            <?php else: ?>
                <div class="alert alert-danger text-center">Client not found.</div>
            <?php endif; ?>
            <a href="index.php" class="btn btn-secondary w-100">Back to Admin</a>
        </div>
    </div>
</div>
</body>
</html>