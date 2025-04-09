<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $designation = $_POST['designation'];
    $description = $_POST['description'];

    $sql = "INSERT INTO sections (designation, description) VALUES (:designation, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':designation' => $designation,
        ':description' => $description,
    ]);

    header("Location: admin.php");
    exit();
}
?>

<h2>Add New Section</h2>
<form method="POST" enctype="multipart/form-data">
    Designation: <input type="text" name="designation" required><br>
    Description: <input type="text" name="description" required><br>
    <button type="submit">Add Section</button>
</form>
<a href="admin.php">← Back to Dashboard</a>
