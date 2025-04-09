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
?>