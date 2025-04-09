<?php
  session_start(); 

  if (isset($_POST["reset"])){
    $_SESSION["visits"] = 0; 
  }

  if (!isset($_SESSION["visits"]) || $_SESSION["visits"] == 0) {
    $_SESSION["visits"] = 1; 
    $message = "Welcome to the page! This is your first visit.";
  } else {
    $_SESSION["visits"]++; 
    $message = "You have visited this page " . $_SESSION["visits"] . " times.";
  }



?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session training</title>
</head>
<body>
  <h2> <?php echo $message ; ?> </h2>
  <form action = sessionPage.php method="post">
    <button type="submit" name="reset" value="1" >reset</button>
</body>
</html>