<?php
  session_start(); // Start the session

  if (isset($_POST["reset"])){
    $_SESSION["visits"] = 0; // Reset the session variable
  }

  if (!isset($_SESSION["visits"]) || $_SESSION["visits"] == 0) {
    $_SESSION["visits"] = 1; // Initialize the session variable
    $message = "Welcome to the page! This is your first visit.";
  } else {
    $_SESSION["visits"]++; // Increment the session variable
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
    <button type="submit" name="reset" value="1" >Set</button>
</body>
</html>