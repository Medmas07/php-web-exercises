<?php
  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
      header("Location: login.php");
      exit();
  }

  require_once "config.php";

  if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
      $stmt->execute([':id' => $id]);
      header("Location: admin.php");
      exit();}
  else {
      echo "Student ID not provided.";
  }
?>