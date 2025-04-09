
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
    protected $name;
    protected $imgUrl;
    protected $hp;
    public $attackPokemon;

    public function __construct($name, $imgUrl, $hp, AttackPokemon $attackPokemon) {
        $this->name = $name;
        $this->imgUrl = $imgUrl;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

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
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
            <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
            <div>{$this->name} utilise une attaque SPÉCIALE et inflige {$damage} dégâts à {$target->getName()} !</div>
            </div>";

        } else {
            $damage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
            <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
            <div>{$this->name} attaque normalement et inflige {$damage} dégâts à {$target->getName()} !</div>
        </div>";

        }
       

        $target->setHp($target->getHp() - $damage);
    }
     public function getStatsHTML() {
        return "
        <div class='pokemon'>
            <h3>{$this->name}</h3>
            <img src='{$this->imgUrl}' width='100'><br>
            <div class='stats'>
                Points : {$this->hp}<br>
                Min Attack Points : {$this->attackPokemon->attackMinimal}<br>
                Max Attack Points : {$this->attackPokemon->attackMaximal}<br>
                Special Attack : {$this->attackPokemon->specialAttack}<br>
                Probability Special Attack : {$this->attackPokemon->probabilitySpecialAttack}
            </div>
        </div>";
    }
}

function affiche_pokemon(Pokemon $p1, Pokemon $p2) {
   /* echo "<div class='container1'>";
    echo $p1->getStatsHTML();
    echo $p2->getStatsHTML();
    echo "</div>";*/
    echo "<div style='display: flex; justify-content: center; gap: 20px;'>";

    echo "<div style='border: 1px solid #ccc; border-radius: 10px; padding: 10px; width: 300px;'>";
    echo "<img src='{$p1->getImgUrl()}' style='width: 40%;height:40%;'><br>";
    echo "<strong>{$p1->getName()}</strong><br>";
    echo "Points : {$p1->getHp()}<br>";
    echo "Min Attack Points : {$p1->attackPokemon->attackMinimal}<br>";
    echo "Max Attack Points : {$p1->attackPokemon->attackMaximal}<br>";
    echo "Special Attack : {$p1->attackPokemon->specialAttack}<br>";
    echo "Probability Special Attack : {$p1->attackPokemon->probabilitySpecialAttack}%<br>";
    echo "</div>";

    echo "<div style='border: 1px solid #ccc; border-radius: 10px; padding: 10px; width: 300px;'>";
    echo "<img src='{$p2->getImgUrl()}' style='width: 40%; height:40%;'><br>";
    echo "<strong>{$p2->getName()}</strong><br>";
    echo "Points : {$p2->getHp()}<br>";
    echo "Min Attack Points : {$p2->attackPokemon->attackMinimal}<br>";
    echo "Max Attack Points : {$p2->attackPokemon->attackMaximal}<br>";
    echo "Special Attack : {$p2->attackPokemon->specialAttack}<br>";
    echo "Probability Special Attack : {$p2->attackPokemon->probabilitySpecialAttack}%<br>";
    echo "</div>";

    echo "</div>";

   

}

function fight(Pokemon $p1, Pokemon $p2) {
    $round = 1;
    while (!$p1->isDead() && !$p2->isDead()) {
        affiche_pokemon($p1,$p2);
        echo "<div style='background-color: #f4bcbc; margin: 20px auto; padding: 10px; width: 80%; border-radius: 8px;'>
        <strong >ROUND $round</strong><br>
        <div style='display: flex; justify-content: space-around;'>";
        $p1->attack($p2);

        if (!$p2->isDead()) {
            $p2->attack($p1);
        }
        echo "</div></div><br>";
        
        $round++;
    }

    echo "<div style='background-color:rgb(59, 183, 96);'><strong style='font-size:50px;'>Résultat du combat :</strong><br>";
    if ($p1->getHp() > $p2->getHp()) {
        echo $p1->getName() . " est le vainqueur !<br>";
        echo "<img src='{$p1->getImgUrl()}' style='height:70%;width:70%'>";
    } elseif ($p2->getHp() > $p1->getHp()) {
        echo $p2->getName() . " est le vainqueur !<br>";
        echo "<img src='{$p2->getImgUrl()}' style='height:70%;width:70%'>";
    } else {
        echo "Match nul !<br>";
    }
    echo "</div>";
}




?>
