<?php
require_once 'Session.php';
$session = new Session();

if (isset($_GET['reset'])) {
    $session->clearAll();
    header("Location: index.php");
    exit();
}

$visits = $session->get('visits');

if ($visits === null) {
    $session->set('visits', 1);
    $message = "Bienvenue à notre plateforme.";
} else {
    $visits++;
    $session->set('visits', $visits);
    $message = "Merci pour votre fidélité, c’est votre {$visits}ème visite.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>sessions – Gestion des visites</title>
</head>
<body>
    <h1><?= $message ?></h1>
    <form method="get" action="">
        <button type="submit" name="reset" value="1">Réinitialiser</button>
    </form>
</body>
</html>
