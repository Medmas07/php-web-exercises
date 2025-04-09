<?php
    
   /* class AttackPokemon{

    }
    
    class Pokemon{
        private $name;
        private $imgUrl;
        private $hp;
        private $attackPokemon;
        public function __construct($name,$imgUrl,$hp,$attackPokemon)
        {
            
        }
    }*/
    
?>
<?php

class AttackPokemon {
    public $attackMinimal;
    public $attackMaximal;
    public $specialAttack;
    public $probabilitySpecialAttack;

    public function __construct($attackMinimal, $attackMaximal, $specialAttack, $probabilitySpecialAttack) {
        $this->attackMinimal = $attackMinimal;
        $this->attackMaximal = $attackMaximal;
        $this->specialAttack = $specialAttack;
        $this->probabilitySpecialAttack = $probabilitySpecialAttack;
    }
}

class Pokemon {
    private $name;
    private $imgUrl;
    private $hp;
    private $attackPokemon;

    public function __construct($name, $imgUrl, $hp, AttackPokemon $attackPokemon) {
        $this->name = $name;
        $this->imgUrl = $imgUrl;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    // Getters et setters
    public function getName() {
        return $this->name;
    }

    public function getImgUrl() {
        return $this->imgUrl;
    }

    public function getHp() {
        return $this->hp;
    }

    public function setHp($hp) {
        $this->hp = max(0, $hp);
    }

    public function isDead() {
        return $this->hp <= 0;
    }

    public function whoAmI() {
        echo "Nom : " . $this->name . "<br>";
        echo "HP : " . $this->hp . "<br>";
        echo "<img src='" . $this->imgUrl . "' width='100'><br><br>";
    }
    public function whoAmI2() {
        echo "Nom : " . $this->name . "<br>" ;
        echo "HP : " . $this->hp ;
    }

    public function attack(Pokemon $target) {
        $rand = rand(1, 100);
        if ($rand <= $this->attackPokemon->probabilitySpecialAttack) {
            $baseDamage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage = $baseDamage * $this->attackPokemon->specialAttack;
            echo $this->name . " utilise une attaque SPÉCIALE et inflige " . $damage . " dégâts à " . $target->getName() . "!<br>";
        } else {
            $damage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            echo $this->name . " attaque normalement et inflige " . $damage . " dégâts à " . $target->getName() . "!<br> ";
        }
       

        $target->setHp($target->getHp() - $damage);
    }
}

function affiche_pokemon(Pokemon $p1, Pokemon $p2) {
    $detailId = "detail_" . $p1->getName();
    echo "
    <div class='container'>
        <div class='pok'>
            <img src='" . $p1->getImgUrl() . "' width='100'>
            <a href='javascript:void(0)' onclick='toggleDiv(\"$detailId\")'>WhoAmI</a>
        </div>
        <div id='$detailId' style='display:none;'>
            <p>" . $p1->whoAmI2() . "</p>
        </div>
        <div class='pok'>
            <img src='" . $p2->getImgUrl() . "' width='100'>
            <a href='javascript:void(0)' onclick='toggleDiv(\"$detailId\")'>WhoAmI</a>
        </div>
        <div id='$detailId' style='display:none;'>
            <p>" . $p2->whoAmI2() . "</p>
        </div>
    </div>";
}

function fight(Pokemon $p1, Pokemon $p2) {
    $round = 1;
    while (!$p1->isDead() && !$p2->isDead()) {
        echo "<div class='round' ><hr><strong >ROUND $round</strong><br>";
        $p1->attack($p2);

        if (!$p2->isDead()) {
            $p2->attack($p1);
        }
        echo "</div><br>";
        affiche_pokemon($p1,$p2);
        $round++;
    }

    echo "<hr><strong>Résultat du combat :</strong><br>";
    if ($p1->getHp() > $p2->getHp()) {
        echo $p1->getName() . " est le vainqueur !<br>";
    } elseif ($p2->getHp() > $p1->getHp()) {
        echo $p2->getName() . " est le vainqueur !<br>";
    } else {
        echo "Match nul !<br>";
    }
}




?>
