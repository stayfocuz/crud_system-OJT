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

// Get searched ID if any
$searched_id = isset($_GET['search_id']) ? intval($_GET['search_id']) : null;
$id_found = false;

// Fetch all clients
$sql = "SELECT id, username, email, password, created_at FROM clients";
$result = $conn->query($sql);
$clients = [];
if ($result) {
    while($row = $result->fetch_assoc()) {
        $clients[] = $row;
        if ($searched_id !== null && $row['id'] == $searched_id) {
            $id_found = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Clients</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        .truncate {
            max-width: 120px;      /* Adjust width as needed */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin - Manage Clients</h2>
    <a href="create.php" class="btn btn-primary mb-3">➕ New Client</a>
    <a href="edit_requests_admin.php" class="btn btn-outline-dark mb-3 notification-btn" title="Edit Requests">
    <i class="bi bi-bell-fill fs-5"></i>
    <?php if ($pending > 0): ?>
        <span class="badge-notify"><?php echo $pending; ?></span>
    <?php endif; ?>
</a>

        Edit Requests
        <?php if ($pending > 0): ?>
            <span class="badge-notify"><?php echo $pending; ?></span>
        <?php endif; ?>
    </a>
    <form class="mb-4 d-flex" method="get" action="">
        <input type="number" name="search_id" class="form-control me-2" placeholder="Search by ID" required>
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
    <?php if ($searched_id !== null && !$id_found): ?>
        <div class="alert alert-danger">no id match</div>
    <?php endif; ?>
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
        <?php foreach($clients as $row): 
            $highlight = ($searched_id !== null && $row['id'] == $searched_id) ? "table-warning" : "";
        ?>
            <tr class="<?php echo $highlight; ?>">
                <td><?php echo $row['id']; ?></td>
                <td><span class="truncate"><?php echo htmlspecialchars($row['username']); ?></span></td>
                <td><span class="truncate"><?php echo htmlspecialchars($row['email']); ?></span></td>
                <td><span class="truncate"><?php echo htmlspecialchars($row['password']); ?></span></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href='edit.php?id=<?php echo $row['id']; ?>' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete.php?id=<?php echo $row['id']; ?>' class='btn btn-danger btn-sm' onclick="return confirm('Delete this client?');">Delete</a>
                    <a href='view_client.php?id=<?php echo $row['id']; ?>' class='btn btn-info btn-sm'>View</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>