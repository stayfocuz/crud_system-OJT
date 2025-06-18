<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// Count pending edit requests
$pending_result = $conn->query("SELECT COUNT(*) AS total FROM edit_requests WHERE status='pending'");
$pending = $pending_result ? $pending_result->fetch_assoc()['total'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Clients</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 950px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            color: #212529;
        }
        h2 {
            color: #203a43;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004a99;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #203a43;
            color: #fff;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f3f3f3;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #bd2130;
        }
        .notification-btn {
            position: relative;
            margin-bottom: 20px;
        }
        .badge-notify {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: #fff;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin - Manage Clients</h2>
    <a href="create.php" class="btn btn-primary mb-3">➕ New Client</a>
    <a href="edit_requests_admin.php" class="btn btn-info mb-3 notification-btn">
        Edit Requests
        <?php if ($pending > 0): ?>
            <span class="badge-notify"><?php echo $pending; ?></span>
        <?php endif; ?>
    </a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT id, username, email, password, created_at FROM clients";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['password']}</td>
                <td>{$row['created_at']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Delete this client?');\">Delete</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
