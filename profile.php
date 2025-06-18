<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$user = null;
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
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
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .container {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            margin-top: 60px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #e8716d;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .list-group-item {
            border: none;
            background: #fff5f0;
            margin-bottom: 8px;
            border-radius: 6px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: none;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>User Profile</h2>
    <?php if ($user): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> <?php echo $user['id']; ?></li>
            <li class="list-group-item"><strong>Username:</strong> <?php echo $user['username']; ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?php echo $user['email']; ?></li>
            <li class="list-group-item"><strong>Password:</strong> <?php echo $user['password']; ?></li>
            <?php if (isset($user['created_at'])): ?>
                <li class="list-group-item"><strong>Created At:</strong> <?php echo $user['created_at']; ?></li>
            <?php endif; ?>
        </ul>
        <?php
        // Check if there is an approved edit request
        $can_edit = false;
        $req_sql = "SELECT * FROM edit_requests WHERE client_id={$user['id']} AND status='approved'";
        $req_result = $conn->query($req_sql);
        if ($req_result && $req_result->num_rows > 0) $can_edit = true;
        ?>
        <?php if ($can_edit): ?>
            <a href="edit_profile.php?id=<?php echo $user['id']; ?>" class="btn btn-warning mt-3">Edit Profile</a>
        <?php else: ?>
            <a href="request_edit.php?id=<?php echo $user['id']; ?>" class="btn btn-info mt-3">Request Edit</a>
        <?php endif; ?>

        <?php
        // Fetch latest edit request for this client
        $status = null;
        $status_text = '';
        $status_class = '';
        $req_sql = "SELECT status FROM edit_requests WHERE client_id={$user['id']} ORDER BY created_at DESC LIMIT 1";
        $req_result = $conn->query($req_sql);
        if ($req_result && $req_result->num_rows > 0) {
            $row = $req_result->fetch_assoc();
            if ($row['status'] == 'approved') {
                $status_text = 'Approved';
                $status_class = 'bg-success';
            } elseif ($row['status'] == 'pending') {
                $status_text = 'Waiting for Response';
                $status_class = 'bg-warning text-dark';
            } elseif ($row['status'] == 'rejected') {
                $status_text = 'Rejected';
                $status_class = 'bg-danger';
            }
        }
        ?>
        <?php if ($status_text): ?>
            <span class="badge <?php echo $status_class; ?>">
                <?php echo $status_text; ?>
            </span>
        <?php endif; ?>
    <?php else: ?>
        <div class="alert alert-danger mt-3">User not found.</div>
    <?php endif; ?>
    <a href="register.php" class="btn btn-secondary mt-4 w-100">⬅ Back to Register</a>
</div>
</body>
</html>
