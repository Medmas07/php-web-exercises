<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
require_once "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h1>Welcome User: <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <a href="logout.php">Logout</a>

    <h2>📘 Students</h2>
    <table id="studentsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Image</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $pdo->query("SELECT students.*, sections.designation 
                             FROM students 
                             JOIN sections ON students.section_id = sections.id");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['birthday']}</td>
                <td><img src='images/{$row['image']}' width='50'></td>
                <td>{$row['designation']}</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
    

    <h2>📚 Sections</h2>
    <table id="sectionsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Designation</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $pdo->query("SELECT * FROM sections");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['designation']}</td>
                <td>{$row['description']}</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#studentsTable').DataTable();
            $('#sectionsTable').DataTable();
        });
    </script>
</body>
</html>
