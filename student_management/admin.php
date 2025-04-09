<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require_once "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        h2 {
            margin-top: 40px;
            margin-bottom: 20px;
            font-size: 24px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table td img {
            display: block;
            margin: 0 auto;
        }

        .btn-add {
            display: inline-block;
            margin: 10px auto;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-add:hover {
            background-color: #218838;
            transform: scale(1.05);
            text-decoration: none;
            color: white;
        }

        .logout-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
            color: #dc3545;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
            color: #bd2130;
        }
    </style>

</head>
<body>
    <h1>Welcome Admin: <?= htmlspecialchars($_SESSION['username']) ?></h1>

    <a class="logout-link" href="logout.php">🚪 Logout</a>

    <h2>📘 Students</h2>


    <table id="studentsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Image</th>
                <th>Section</th>
                <th>Actions</th>
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
                <td>
                    <a href='edit_student.php?id={$row['id']}'>✏️</a> | 
                    <a href='delete_student.php?id={$row['id']}' onclick=\"return confirm('Are you sure?')\">🗑️</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#studentsTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>    


    
    <div style="text-align:center;">
        <a class="btn-add" href="add_student.php">➕ Add New Student</a>
    </div>

    <h2>📚 Sections</h2>
    <table id="sectionsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Designation</th>
                <th>Description</th>
                <th>Actions</th>
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
                <td>
                    <a href='edit_section.php?id={$row['id']}'>✏️</a> | 
                    <a href='delete_section.php?id={$row['id']}' onclick=\"return confirm('Are you sure?')\">🗑️</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#sectionsTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <div style="text-align:center;">
        <a class="btn-add" href="add_section.php">➕ Add New Section</a>
    </div>

    <script>
        $(document).ready(function () {
            $('#studentsTable').DataTable();
            $('#sectionsTable').DataTable();
        });
    </script>
</body>
</html>
