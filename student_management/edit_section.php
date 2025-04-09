<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require_once "config.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM sections WHERE id = :id");
$stmt->execute([':id' => $id]);
$section = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$section) {
    echo "Section not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $designation = $_POST['designation'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE sections SET designation = :designation, description = :description WHERE id = :id");
    $stmt->execute([
        ':designation' => $designation,
        ':description' => $description,
        ':id' => $id
    ]);

    header("Location: admin.php");
    exit();
}
?>

<h2>Edit Section</h2>
<form method="POST">
    Designation: <input type="text" name="designation" value="<?= htmlspecialchars($section['designation']) ?>" required><br>
    Description: <textarea name="description"><?= htmlspecialchars($section['description']) ?></textarea><br><br>
    <button type="submit">Update Section</button>
</form>
<a href="admin.php">← Back to Dashboard</a>
