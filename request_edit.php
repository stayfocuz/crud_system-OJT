<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);

$success = false;
$client_id = intval($_GET['id']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reason = $conn->real_escape_string($_POST["reason"]);
    $sql = "INSERT INTO edit_requests (client_id, reason) VALUES ($client_id, '$reason')";
    $conn->query($sql);
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Request Profile Edit</h2>
    <?php if ($success): ?>
        <div class="alert alert-success">Your request has been sent to the admin.</div>
    <?php else: ?>
    <form method="post">
        <div class="mb-3">
            <label>Reason for Edit</label>
            <textarea name="reason" class="form-control" required></textarea>
        </div>
        <button class="btn btn-primary">Send Request</button>
    </form>
    <?php endif; ?>
    <a href="profile.php?id=<?php echo $client_id; ?>" class="btn btn-secondary mt-3">Back to Profile</a>
</div>
</body>
</html>