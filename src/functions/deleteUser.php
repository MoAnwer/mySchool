<?php

  require_once '../../init.php';
  $dots = '../../';

  $userID = filter($_POST['id'], 'int');

  (new User())->delete($userID);

  header('location: ../../views/admin/dashboard');
  exit();