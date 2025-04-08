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
    </style>
</head>
<body>
    <?php
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

    
    $etudiants = [
        new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
        new Etudiant("Skander", [15, 9, 8, 16])
    ];

    // Affichage
    foreach ($etudiants as $etu) {
        echo "<div class='etudiant'>";
        echo "<strong>{$etu->nom}</strong><br>";
        $etu->afficherNotes();
        $moy = $etu->moyenne();
        $admis = $etu->estAdmis() ? " (Admis)" : " (Non admis)";
        echo "<div class='result'>Votre moyenne est " . round($moy, 2) . "$admis</div>";
        echo "</div>";
    }
    ?>

</body>
</html>
