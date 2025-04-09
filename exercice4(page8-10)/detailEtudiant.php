<?php
if (!isset($_GET['id'])) {
    die("ID étudiant non spécifié.");
}

$id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=etudiant_db', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM student WHERE id = $id";
$result = $pdo->query($sql);
$etudiant = $result->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    die("Étudiant non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails étudiant</title>
</head>
<body >
    <div class="container">
        <div >
            <h2 ><?= htmlspecialchars($etudiant['name']) ?></h2>
            <p><strong>Date de naissance :</strong> <?= $etudiant['birthday'] ?></p>
            <a href="index.php" >← Retour à la liste</a>
        </div>
    </div>
</body>
</html>
