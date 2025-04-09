<?php
session_start();

if (!isset($_SESSION['mysql_credentials'])) {
    echo "Session expirée. Veuillez relancer l'installation.";
    exit();
}

$mysql_user = $_SESSION['mysql_credentials']['user'];
$mysql_pass = $_SESSION['mysql_credentials']['pass'];

unset($_SESSION['mysql_credentials']);

try {
    $pdo = new PDO('mysql:host=localhost;dbname=etudiant_db', $mysql_user, $mysql_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
$colonnes = ['id', 'name', 'birthday'];
$sort = in_array($_GET['sort'] ?? '', $colonnes) ? $_GET['sort'] : 'id';
$order = ($_GET['order'] ?? 'asc') === 'desc' ? 'desc' : 'asc';

$sql = "SELECT * FROM student ORDER BY $sort $order";
$stmt = $pdo->query($sql);
$etudiants = $stmt->fetchAll();

$nextOrder = $order === 'asc' ? 'desc' : 'asc';

function getArrow($column, $sort, $order) {
    if ($column === $sort) {
        return $order === 'asc' ? '↑' : '↓';
    }
    return '';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
</head>
<body >

<div class="container">
    <h2 >Liste des étudiants</h2>
    <table border="1" cellpadding="8" >
        <head  >
            <tr>
                <th><a href="?sort=id&order=<?= $nextOrder ?>" >ID <?= getArrow('id', $sort, $order) ?></a></th>
                <th><a href="?sort=name&order=<?= $nextOrder ?>">Nom <?= getArrow('name', $sort, $order) ?></a></th>
                <th><a href="?sort=birthday&order=<?= $nextOrder ?>">Date de naissance <?= getArrow('birthday', $sort, $order) ?></a></th>
                <th>Détail</th>
            </tr>
        </head>
        <body>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?= $etudiant['id'] ?></td>
                    <td><?= htmlspecialchars($etudiant['name']) ?></td>
                    <td><?= $etudiant['birthday'] ?></td>
                    <td>
                        <a href="detailEtudiant.php?id=<?= $etudiant['id'] ?>" >&#9432</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </body>
    </table>
</div>

</body>
</html>
