<?php
session_start();
require_once "config.php";

$input_username = $_POST['username'];
$input_password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = :username";
$req = $pdo->prepare($sql);
$req->bindParam(':username', $input_username);
$req->execute();

$user = $req->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($input_password, $user['password'])) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }
    exit();
} else {
    $_SESSION['error'] = "Invalid username or password.";
    header("Location: login.php");
    exit();
}
?>