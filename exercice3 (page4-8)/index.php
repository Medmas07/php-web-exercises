<?php require  "Pokemon.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            text-align: center; 
            margin: 20px;
            font-family:"Segoe UI",sans-serif;
            background-size:cover;	
            height:100vh;
            
        }
        .round { 
            background-color: #f8d7da; 
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
            
    </style>
</head>
<body>
    <?php 
    $atk1 = new AttackPokemon(5, 10, 2, 30); // Pikachu
    $atk2 = new AttackPokemon(4, 12, 1.5, 50); // Bulbizarre
    
    $pikachu = new Pokemon("Pikachu", "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png", 50, $atk1);
    $bulbasaur = new Pokemon("Bulbizarre", "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png", 50, $atk2);
    
    // Affichage des infos
    $pikachu->whoAmI();
    $bulbasaur->whoAmI();
    
    // Lancement du combat
    fight($pikachu, $bulbasaur);
    ?>
    

</body>
</html>
