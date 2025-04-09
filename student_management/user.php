<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<h1>User Dashboard</h1>
<p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> (User)</p>
<a href="logout.php">Logout</a>
