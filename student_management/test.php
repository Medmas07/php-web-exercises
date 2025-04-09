<?php

require_once 'config.php'; 

$username = 'Mouhamed';
$email = 'mouhamed.admin@example.com';
$password = password_hash("password123", PASSWORD_DEFAULT);
$role = 'user';

$sql = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':username' => $username,
    ':email' => $email,
    ':password' => $password,
    ':role' => $role
]);

echo "User inserted with hashed password.";

?>