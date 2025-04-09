<?php
session_start();

if (!isset($_SESSION['mysql_credentials'])) {
    header('Location: page_option1.php');
    exit();
}

$mysql_user = $_SESSION['mysql_credentials']['user'];
$mysql_pass = $_SESSION['mysql_credentials']['pass'];

try {
    $pdo = new PDO('mysql:host=localhost', $mysql_user, $mysql_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS etudiant_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE etudiant_db");  
    

    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS student (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            birthday DATE NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $pdo->exec($createTableSQL);

    $pdo->exec("
        INSERT INTO student (name, birthday)
        SELECT * FROM (SELECT 'Aymen' AS name, '1982-02-07' AS birthday) AS tmp
        WHERE NOT EXISTS (SELECT 1 FROM student WHERE name = 'Aymen' AND birthday = '1982-02-07')
        LIMIT 1;
    ");

    $pdo->exec("
        INSERT INTO student (name, birthday)
        SELECT * FROM (SELECT 'Skander' AS name, '2018-07-11' AS birthday) AS tmp
        WHERE NOT EXISTS (SELECT 1 FROM student WHERE name = 'Skander' AND birthday = '2018-07-11')
        LIMIT 1;
    ");
    
    

    echo "<h2 style='color: green; text-align: center;'>Installation réussie !</h2>";
    echo "<div style='text-align: center; margin-top: 20px;'>";
   // echo "<a href='ajouterEtudiant.php' style='margin: 10px; padding: 10px; background: #4CAF50; color: white; text-decoration: none;'>Ajouter un étudiant</a>";
    echo "<a href='listEtudiants.php' style='margin: 10px; padding: 10px; background: #2196F3; color: white; text-decoration: none;'>Liste des étudiants</a>";
    echo "</div>";

} catch (PDOException $e) {
    $error = "Erreur de connexion à MySQL. Veuillez vérifier vos identifiants ou  la connexion";
    echo $error;
    exit();
}
?>