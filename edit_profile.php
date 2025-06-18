<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$client_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$success = false;

// Check if the edit request is approved
$can_edit = false;
$req_sql = "SELECT * FROM edit_requests WHERE client_id=$client_id AND status='approved'";
$req_result = $conn->query($req_sql);
if ($req_result && $req_result->num_rows > 0) $can_edit = true;

// Fetch user data
$user = null;
$sql = "SELECT * FROM clients WHERE id=$client_id";
$result = $conn->query($sql);
if ($result && $result->num_rows == 1) {
    $user = $result->fetch_assoc();
}

// Handle form submission
if ($can_edit && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $update_sql = "UPDATE clients SET username='$username', email='$email', password='$password' WHERE id=$client_id";
    if ($conn->query($update_sql)) {
        // Mark request as completed
        $conn->query("UPDATE edit_requests SET status='completed' WHERE client_id=$client_id AND status='approved'");
        $success = true;
        // Refresh user data
        $result = $conn->query($sql);
        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 500px; }
    </style>
</head>
<body>
<div class="container my-5">
    <h2>Edit Profile</h2>
    <?php if (!$can_edit): ?>
        <div class="alert alert-warning">You are not authorized to edit your profile. Please request admin approval.</div>
        <a href="profile.php?id=<?php echo $client_id; ?>" class="btn btn-secondary mt-3">Back to Profile</a>
    <?php elseif ($success): ?>
        <div class="alert alert-success">Profile updated successfully!</div>
        <a href="profile.php?id=<?php echo $client_id; ?>" class="btn btn-success mt-3">Back to Profile</a>
    <?php elseif ($user): ?>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($user['password']); ?>" required>
        </div>
        <button class="btn btn-primary">Update Profile</button>
        <a href="profile.php?id=<?php echo $client_id; ?>" class="btn btn-secondary">Cancel</a>
    </form>
    <?php endif; ?>
</div>
</body>
</html>