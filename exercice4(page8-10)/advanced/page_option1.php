<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['mysql_user']) && isset($_POST['mysql_pass'])) {
    $_SESSION['mysql_credentials'] = [
        'user' => trim($_POST["mysql_user"]),
        'pass' => $_POST["mysql_pass"]
    ];
    
    header('Location: database_install.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Configuration MySQL</title>
    <style>
        .error { color: red; }
        form {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            width: 300px;
            background: #f9f9f9;
        }
        h3 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .note {
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form method="post">
        <h3>Identifiants MySQL</h3>
        <p>Veuillez entrer vos identifiants de base de données :</p>
        
        <label>Utilisateur MySQL:</label>
        <input type="text" name="mysql_user" required>
        
        <label>Mot de passe MySQL:</label>
        <input type="password" name="mysql_pass">
        
        <input type="submit" value="Installer la base de données">
        
        <div class="note">
            <strong>Note :</strong> Ces identifiants ne seront pas stockés et ne sont utilisés que pour l'installation.
        </div>
    </form>
</body>
</html>