<?php

  class DB {

    public static function connection() {
      $conn = new PDO('mysql:host=localhost;dbname=numberone;charset=utf8;user=root');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    }
  }