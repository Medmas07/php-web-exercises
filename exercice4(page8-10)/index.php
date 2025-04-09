<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['option'])) {
        $selected_option = $_POST['option'];

        if ($selected_option == 'Option1') {
            header('Location: page_option1.php'); 
            exit();
        } elseif ($selected_option == 'Option2') {
            header('Location: page_option2.php'); 
            exit();
        } elseif ($selected_option == 'Option3') {
            header('Location: page_option3.php'); 
            exit();
        }
    } else {
        $error = "Vous devez sélectionner une option.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>setup_liste_etudiant</title>
    <style>
        .error { color: red; }
        form {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            width: 300px;
            background: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        
    </style>
</head>
<body>
    <h2>Choisissez une option</h2>

    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

    <form action="" method="POST">
        <label for="option1">installe le db localement</label>
        <input type="radio" id="option1" name="option" value="Option1"><br><br>

        <!--<label for="option2">utiliser le db deployé sur le cloud</label>
        <input type="radio" id="option2" name="option" value="Option2"><br>

        <label for="option3">Option 3</label>
        <input type="radio" id="option3" name="option" value="Option3"><br>-->

        <button type="submit">Soumettre</button>
    </form>
</body>
</html>





