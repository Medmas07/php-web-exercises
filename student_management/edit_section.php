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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Section</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f8fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ffc107;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #e0a800;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>🛠️ Edit Section</h2>
    <form method="POST">
        <label>Designation:</label>
        <input type="text" name="designation" value="<?= htmlspecialchars($section['designation']) ?>" required>

        <label>Description:</label>
        <textarea name="description" rows="4"><?= htmlspecialchars($section['description']) ?></textarea>

        <button type="submit">Update Section</button>
    </form>
    <a href="admin.php">← Back to Dashboard</a>
</div>

</body>
</html>
