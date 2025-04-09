<?php 
require  "Pokemon.php";
class PlantPokemon extends Pokemon{
    public function attackFire(FirePokemon $target){
        $rand=rand(1,100);
        if($rand <= $this->attackPokemon->probabilitySpecialAttack){
            $baseDamage = rand($this->attackPokemon->attackMinimal,$this->attackPokemon->attackMaximal);
            $damage=$baseDamage*$this->attackPokemon->specialAttack;
            $damage*=0.5;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
            <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
            <div>{$this->name} utilise une attaque SPÉCIALE et inflige {$damage} dégâts à {$target->getName() } !  le damage est moitié car plante attaque feu</div>
            </div>";

        }else {
            $damage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage*=0.5;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
                <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
                <div>{$this->name} attaque normalement et inflige {$damage} dégâts à {$target->getName()} ! le damage est moitié car plante attaque feu</div>
            </div>";

        }
        $target->setHp($target->getHp() - $damage);

    }
    public function attackWater(WaterPokemon $target)
    {
        $rand = rand(1, 100);
        if ($rand <= $this->attackPokemon->probabilitySpecialAttack) {
            $baseDamage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage = $baseDamage * $this->attackPokemon->specialAttack;
            $damage *=2;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
            <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
            <div>{$this->name} utilise une attaque SPÉCIALE et inflige {$damage} dégâts à {$target->getName() } !  le damage est doublé car plante vs eau</div>
            </div>";

        } else {
            $damage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage*=2;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
                <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
                <div>{$this->name} attaque normalement et inflige {$damage} dégâts à {$target->getName()} ! le damage est doublé car plante attaque water</div>
            </div>";

        }
       

        $target->setHp($target->getHp() - $damage);
    }
}

class WaterPokemon extends Pokemon{
    public function attackFire(FirePokemon $target) {
        $rand = rand(1, 100);
        if ($rand <= $this->attackPokemon->probabilitySpecialAttack) {
            $baseDamage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage = $baseDamage * $this->attackPokemon->specialAttack;
            $damage *=2;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
            <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
            <div>{$this->name} utilise une attaque SPÉCIALE et inflige {$damage} dégâts à {$target->getName() } !  le damage est doublé car eau vs feu</div>
            </div>";

        } else {
            $damage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage*=2;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
                <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
                <div>{$this->name} attaque normalement et inflige {$damage} dégâts à {$target->getName()} ! le damage est doublé car eau vs feu</div>
            </div>";

        }
       

        $target->setHp($target->getHp() - $damage);
    }
    public function attackPlant(PlantPokemon $target) {
        $rand = rand(1, 100);
        if ($rand <= $this->attackPokemon->probabilitySpecialAttack) {
            $baseDamage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage = $baseDamage * $this->attackPokemon->specialAttack;
            $damage *=0.5;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
            <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
            <div>{$this->name} utilise une attaque SPÉCIALE et inflige {$damage} dégâts à {$target->getName() } !  le damage est doublé car eau vs plante</div>
            </div>";

        } else {
            $damage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage*=0.5;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
                <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
                <div>{$this->name} attaque normalement et inflige {$damage} dégâts à {$target->getName()} ! le damage est doublé car eau vs plante</div>
            </div>";

        }
       

        $target->setHp($target->getHp() - $damage);
    }
}

class FirePokemon extends Pokemon{
    public function attackPlant(PlantPokemon $target) {
        $rand = rand(1, 100);
        if ($rand <= $this->attackPokemon->probabilitySpecialAttack) {
            $baseDamage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage = $baseDamage * $this->attackPokemon->specialAttack;
            $damage *=2;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
            <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
            <div>{$this->name} utilise une attaque SPÉCIALE et inflige {$damage} dégâts à {$target->getName() } !  le damage est doublé car feu vs plante</div>
            </div>";

        } else {
            $damage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage*=2;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
                <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
                <div>{$this->name} attaque normalement et inflige {$damage} dégâts à {$target->getName()} ! le damage est doublé car feu vs plante</div>
            </div>";

        }
       

        $target->setHp($target->getHp() - $damage);
    }
    public function attackWater(WaterPokemon $target) {
        $rand = rand(1, 100);
        if ($rand <= $this->attackPokemon->probabilitySpecialAttack) {
            $baseDamage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage = $baseDamage * $this->attackPokemon->specialAttack;
            $damage *=0.5;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
            <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
            <div>{$this->name} utilise une attaque SPÉCIALE et inflige {$damage} dégâts à {$target->getName() } !  le damage est doublé car feu vs eau</div>
            </div>";

        } else {
            $damage = rand($this->attackPokemon->attackMinimal, $this->attackPokemon->attackMaximal);
            $damage*=0.5;
            echo "<div style='display: flex; flex-direction: column; align-items: center; text-align: center; width: 45%;'>
                <span style='font-size: 20px; font-weight: bold;'>{$rand}</span>
                <div>{$this->name} attaque normalement et inflige {$damage} dégâts à {$target->getName()} ! le damage est doublé car feu vs eau</div>
            </div>";

        }
       

        $target->setHp($target->getHp() - $damage);
    }
}



?>