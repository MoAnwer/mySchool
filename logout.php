<?php

  require_once 'init.php';

  Session::destroy();
  header('location: views/index');
  exit();