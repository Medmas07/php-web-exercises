<?php
require_once 'Session.php';
$cookie = new Session();

if (isset($_GET['reset'])) {
    $cookie->clearAll();
    header("Location: index.php");
    exit();
}

$visits = $cookie->get('visits');

if ($visits === null) {
    $cookie->set('visits', 1);
    $message = "Bienvenue à notre plateforme.";
} else {
    $visits++;
    $cookie->set('visits', $visits);
    $message = "Merci pour votre fidélité, c’est votre {$visits}ème visite.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cookies – Gestion des visites</title>
</head>
<body>
    <h1><?= $message ?></h1>
    <form method="get" action="">
        <button type="submit" name="reset" value="1">Réinitialiser</button>
    </form>
</body>
</html>
