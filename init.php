<?php

  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);

  $css = "assets/css/";
  $js = "assets/js/";
  $tpl = "components/templates/";

  $dots = '';
  
  spl_autoload_register(function ($class) { 
    global $dots;
    require_once $dots . 'src/' .$class .'.php';
    require_once $dots . 'src/functions.php';
  });

  // Start Session
  (new Session());