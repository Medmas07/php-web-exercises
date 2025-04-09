<?php 
session_start();
require  "Pokemon.php";
require_once "SpecialPokemon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            text-align: center;
            margin: 20px;
            font-family: "Segoe UI", sans-serif;
            background-size: cover;
            height: 100vh;
        }
        .round { 
            background-color:rgb(233, 108, 108); 
        }  

        .container {
            max-width: 100%; 
            margin: auto; 
            padding: 20px; 
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
        } 

       
        .container0 {
            background-color: rgb(29, 204, 183);
            padding: 20px;
            border-radius: 10px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .pokemon-card {
            width: 150px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
        }
        .container1 {
            display: flex;
            justify-content: center;
            border: 1px solid #ccc;
            gap: 20px;
            padding: 20px;
        }
        
        .pokemon-card img {
            width: 100px;
            height: 100px;
        }
        
    </style>
</head>
<body>
    <?php 
    
    echo "
    <div id='container0' >
    <div id='container1' style= 'background:rgb(29, 204, 183); '>les combattants
    </div>
    <h1>Choisissez vos Pokémon pour le combat !</h1>

        <div class='container'>
            <div class='pokemon-card'>
                <img src='pikachu.gif' alt='Pikachu'>
                <h3>Pikachu</h3>
                <form method='POST'>
                    <input type='hidden' name='pokemon' value='pikachu'>
                    <button type='submit'>Choisir</button>
                </form>
            </div>

            <div class='pokemon-card'>
                <img src='water_pokemon.gif' alt='water_pokemon'>
                <h3>water_pokemon</h3>
                <form method='POST'>
                    <input type='hidden' name='pokemon' value='water_pokemon'>
                    <button type='submit'>Choisir</button>
                </form>
            </div>
            <div class='pokemon-card'>
                <img src='fire_pokemon.gif' alt='fire_pokemon'>
                <h3>fire_pokemon</h3>
                <form method='POST'>
                    <input type='hidden' name='pokemon' value='fire_pokemon'>
                    <button type='submit'>Choisir</button>
                </form>
            </div>
            <div class='pokemon-card'>
                <img src='plant_pokemon.gif' alt='plant_pokemon'>
                <h3>plant_pokemon</h3>
                <form method='POST'>
                    <input type='hidden' name='pokemon' value='plant_pokemon'>
                    <button type='submit'>Choisir</button>
                </form>
            </div>

        </div>

    <br>
    </div>
    ";?>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!isset($_SESSION['selected_pokemon'])){
            $_SESSION['selected_pokemon']=[];
        }
        $pokemonChoice = $_POST['pokemon'];

        if (count($_SESSION['selected_pokemon']) < 2 && !in_array($pokemonChoice, $_SESSION['selected_pokemon'])) {
            $_SESSION['selected_pokemon'][] = $pokemonChoice;  
        }
    
        if (count($_SESSION['selected_pokemon']) == 2) {
            $pokemons = [];
            foreach ($_SESSION['selected_pokemon'] as $choice) {
                if ($choice == 'pikachu') {
                    $atk1 = new AttackPokemon(5, 10, 2, 30); 
                    $pokemons[] = new Pokemon("Pikachu", "pikachu.gif", 50, $atk1);
                } elseif ($choice == 'water_pokemon') {
                    $atk2 = new AttackPokemon(4, 12, 1.5, 50); 
                    $pokemons[] = new WaterPokemon("water_pokemon", "water_pokemon.gif", 50, $atk2);
                }else if ($choice == 'fire_pokemon') {
                    $atk3 = new AttackPokemon(4, 12, 1.5, 50); 
                    $pokemons[] = new FirePokemon("fire_pokemon", "fire_pokemon.gif", 50, $atk3);
                }else if ($choice == 'plant_pokemon') {
                    $atk4 = new AttackPokemon(4, 12, 1.5, 50); 
                    $pokemons[] = new PlantPokemon("plant_pokemon", "plant_pokemon.gif", 100, $atk4);
                }
            }
            fight($pokemons[0],$pokemons[1]);
            
            $_SESSION['selected_pokemon'] = [];
        }else {
            echo "<p>Vous avez sélectionné " . count($_SESSION['selected_pokemon']) . " Pokémon. Choisissez un autre Pokémon.</p>";
        }
    }
    
        
        
    
    ?>
    

</body>
</html>
