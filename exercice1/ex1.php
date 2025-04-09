<?php require "Etudiant.php" ?>

<!DOCTYPE html>
<html>
<head>
    <title>Exercice Étudiants</title>
    <style>
        .note {
            padding: 5px;
            margin: 2px;
            text-align: center;
        }
        .red { background-color: #f8d7da; }    
        .green { background-color: #d4edda; } 
        .orange { background-color: #fff3cd; } 
        .result {
            background-color: #cce5ff;
            padding: 10px;
            margin-top: 10px;
        }
        .etudiant {
            float: left;
            width: 200px;
            margin: 10px;
        }
        form {
            clear: both;
            margin-top: 30px;
            padding: 15px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<form method="post">
        <h3>Ajouter un étudiant</h3>
        <label>Nom de l'étudiant :</label><br>
        <input type="text" name="nom" required><br><br>
        <label>Notes (séparées par des virgules) :</label><br>
        <input type="text" name="notes" required placeholder="Ex: 12,15,9"><br><br>
        <input type="submit" value="Ajouter">
    </form>
    <?php
    

    session_start();
    if (isset($_SESSION['etudiants'])) {
        $etudiants = $_SESSION['etudiants'];
    } else {
        $etudiants = [
            new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
            new Etudiant("Skander", [15, 9, 8, 16])
        ];
    }

    // Traitement du formulaire
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nomSaisi = trim($_POST["nom"]);
        $notesSaisies = explode(",", $_POST["notes"]);
        $notesPropres = [];

        // Nettoyage des notes 
        foreach ($notesSaisies as $note) {
            $note = trim($note);
            if (is_numeric($note)) {
                $notesPropres[] = floatval($note);
            }
        }

        // Vérifier si l'étudiant existe déjà
        $existe = false;
        foreach ($etudiants as $e) {
            if (strtolower($e->nom) == strtolower($nomSaisi)) {
                $existe = true;
                break;
            }
        }

        if (!$existe && count($notesPropres) > 0) {
            $etudiants[] = new Etudiant($nomSaisi, $notesPropres);
            $_SESSION['etudiants'] = $etudiants;
        } elseif ($existe) {
            echo "<p style='color:red;'> Étudiant '$nomSaisi' existe déjà !</p>";
        }
    }

    foreach ($etudiants as $etu) {
        echo "<div class='etudiant'>";
        echo "<strong>{$etu->nom}</strong><br>";
        $etu->afficherNotes();
        $moy = $etu->moyenne();
        $admis = $etu->estAdmis() ? " (Admis)" : " (Non admis)";
        echo "<div class='result'>Moyenne : " . round($moy, 2) . "$admis</div>";
        echo "</div>";
    }
    ?>

    
</body>
</html>
