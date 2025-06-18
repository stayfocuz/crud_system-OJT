<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);

if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE edit_requests SET status='approved' WHERE id=$id");
}
if (isset($_GET['reject'])) {
    $id = intval($_GET['reject']);
    $conn->query("UPDATE edit_requests SET status='rejected' WHERE id=$id");
}

$result = $conn->query("SELECT er.*, c.username FROM edit_requests er JOIN clients c ON er.client_id = c.id WHERE er.status='pending'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Requests</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Pending Edit Requests</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Client</th>
                <th>Reason</th>
                <th>Requested At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="?approve=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                    <a href="?reject=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Back to Admin</a>
</div>
</body>
</html>