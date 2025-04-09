<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section_id = $_POST['section_id'];

    $imageName = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $imageName);
    }

    $sql = "INSERT INTO students (name, birthday, image, section_id) 
            VALUES (:name, :birthday, :image, :section_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':birthday' => $birthday,
        ':image' => $imageName,
        ':section_id' => $section_id
    ]);

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Student</title>
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
        input[type="date"],
        input[type="file"],
        select {
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
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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
    <h2>🎓 Add New Student</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="birthday">Birthday:</label>
        <input type="date" name="birthday" required>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*">

        <label for="section_id">Section:</label>
        <select name="section_id" required>
            <?php
            $stmt = $pdo->query("SELECT * FROM sections");
            while ($section = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$section['id']}'>{$section['designation']}</option>";
            }
            ?>
        </select>

        <button type="submit">Add Student</button>
    </form>

    <a href="admin.php">← Back to Dashboard</a>
</div>

</body>
</html>
