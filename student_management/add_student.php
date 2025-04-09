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

    $sql = "INSERT INTO students (name, birthday, image, section_id) VALUES (:name, :birthday, :image, :section_id)";
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

<h2>Add New Student</h2>
<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br>
    Birthday: <input type="date" name="birthday" required><br>
    Image: <input type="file" name="image" accept="image/*"><br>
    Section:
    <select name="section_id" required>
        <?php
        $stmt = $pdo->query("SELECT * FROM sections");
        while ($section = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$section['id']}'>{$section['designation']}</option>";
        }
        ?>
    </select><br><br>
    <button type="submit">Add Student</button>
</form>
<a href="admin.php">← Back to Dashboard</a>
