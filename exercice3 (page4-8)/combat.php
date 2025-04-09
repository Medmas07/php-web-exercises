<?php require  "Pokemon.php"?>
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

        .img {
            display: inline-block;
        }
        .container0 {
            max-width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
            flex-wrap: wrap;
        }
        .container {
            max-width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
            flex-wrap: wrap;
        }
        .pokemon-card {
            width: 150px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
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
    
    
    </div>
    ";?>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pokemonChoice = $_POST['pokemon'];

        if ($pokemonChoice == 'pikachu') {
            $atk1 = new AttackPokemon(5, 10, 2, 30); 
            $pikachu = new Pokemon("Pikachu", "pikachu.gif", 50, $atk1);
        } else if ($pokemonChoice == 'water_pokemon') {
            $atk1 = new AttackPokemon(4, 12, 1.5, 50); 
            $bulbasaur = new Pokemon("water_pokemon", "water_pokemon.gif", 50, $atk1);
        }else if ($pokemonChoice == 'fire_pokemon') {
            $atk1 = new AttackPokemon(4, 12, 1.5, 50); 
            $pokemon = new Pokemon("fire_pokemon", "fire_pokemon.gif", 50, $atk1);
        }
    }
        $atk1 = new AttackPokemon(5, 10, 2, 30); 
        $atk2 = new AttackPokemon(4, 12, 1.5, 50); 
        
        $pikachu->whoAmI();
        
    
    ?>
    

</body>
</html>
