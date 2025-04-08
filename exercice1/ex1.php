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
        <input type="text" name="nom" ><br><br>
        <label>Notes (séparées par des virgules) :</label><br>
        <input type="text" name="notes"  placeholder="Ex: 12,15,9"><br><br>
        <input type="submit" value="Ajouter">
    </form>
    
    <?php
    session_start(); 
    class Etudiant {
        public $nom;
        public $notes;

        public function __construct($nom, $notes) {
            $this->nom = $nom;
            $this->notes = $notes;
        }

        public function afficherNotes() {
            foreach ($this->notes as $note) {
                $class = "";
                if ($note < 10) {
                    $class = "red";
                } elseif ($note > 10) {
                    $class = "green";
                } else {
                    $class = "orange";
                }
                echo "<div class='note $class'>$note</div>";
            }
        }

        public function moyenne() {
            return array_sum($this->notes) / count($this->notes);
        }

        public function estAdmis() {
            return $this->moyenne() >= 10;
        }
    }
    // bach manday3ouch table étudiants à chaque auctualisation
    if (isset($_SESSION['etudiants'])) {
        $etudiants = $_SESSION['etudiants'];
    } else {
        $etudiants = [
            new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
            new Etudiant("Skander", [15, 9, 8, 16])
        ];
        $_SESSION['etudiants'] = $etudiants;
    }
    // Traitement du formulaire
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
       
        if(isset($_POST['nom_supp'])){
            $nom_supp = $_POST["nom_supp"];
           
            $i=-1;
            foreach ($etudiants as $e) {
                $i++;
                if (strtolower($e->nom) == strtolower($nom_supp)) {
                    
                    break;
                }
            }
            if($i==-1){
                echo "<p style='color:red;'> Étudiant '$nom_supp' n'existe pas  !</p>";
            }
            else{
                array_splice($etudiants, $i, 1); 
                if (isset($_SESSION['etudiants'])) {
                    $_SESSION['etudiants'] = $etudiants;
                }
            }
        }
        else{
            $nomSaisi = trim($_POST["nom"]);
            $notesSaisies = explode(",", $_POST["notes"]);
            $notesPropres = [];
            // ynadef l'input
            foreach ($notesSaisies as $note) {
                $note = trim($note);
                if (is_numeric($note)) {
                    $notesPropres[] = floatval($note);
                }
            }
            // ychouf kan l'étudiant mawjoud
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
        }

        
    ?>
    <form method="post">
        <h3>supprimer un étudiant</h3>
        <label>Nom de l'étudiant :</label><br>
        <input type="text" name="nom_supp" required><br><br>
        <input type="submit" value="supprimer">
    </form>

    
</body>
</html>
