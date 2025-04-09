<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<h1>Admin Dashboard</h1>
<p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> (Admin)</p>
<a href="logout.php">Logout</a>
<p>This is the admin dashboard. Only admins can see this page.</p>