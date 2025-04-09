<?php
  require_once 'Repository.php';
  require_once 'database.php';

  $db = Database::connect();
  $sectionRepo = new Repository($db, 'sections');

  $sectionRepo->add([
      'designation' => 'Mathématiques',
      'description' => 'Section Mathématique appliquée'
  ]);

  

  $userRepo = new Repository($db, 'sections');
  $users = $userRepo->getAll();
  print_r($users);
  ?>
