<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require_once "config.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute([':id' => $id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    echo "Student not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $section_id = $_POST['section_id'];

    $image = $student['image'];
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);
    }

    $sql = "UPDATE students SET name = :name, birthday = :birthday, image = :image, section_id = :section_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':birthday' => $birthday,
        ':image' => $image,
        ':section_id' => $section_id,
        ':id' => $id
    ]);

    header("Location: admin.php");
    exit();
}
?>

<h2>Edit Student</h2>
<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required><br>
    Birthday: <input type="date" name="birthday" value="<?= $student['birthday'] ?>" required><br>
    Image: <input type="file" name="image"><br>
    <img src="images/<?= $student['image'] ?>" width="100"><br>
    Section:
    <select name="section_id">
        <?php
        $sections = $pdo->query("SELECT * FROM sections")->fetchAll();
        foreach ($sections as $section) {
            $selected = $section['id'] == $student['section_id'] ? 'selected' : '';
            echo "<option value='{$section['id']}' $selected>{$section['designation']}</option>";
        }
        ?>
    </select><br><br>
    <button type="submit">Update Student</button>
</form>
<a href="admin.php">← Back to Dashboard</a>
