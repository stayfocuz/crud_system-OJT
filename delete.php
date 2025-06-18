<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$id = $_GET["id"];
$sql = "DELETE FROM clients WHERE id=$id";
$conn->query($sql);
header("Location: index.php");
exit();
?>
<a href="index.php" class="btn btn-secondary">Cancel</a>