<?php 
  include "../../init.php";
  $dots = "../../";

  if (Session::has('superadmin') && Session::has('isLogged')) {

    if($_SERVER['REQUEST_METHOD'] == "POST") {

      $newAppName = $_POST['appName'];

      $sql = DB::connection()->prepare("UPDATE settings SET appName = ?");
      $stmt = $sql->execute([$newAppName]);

      Session::set('app', $newAppName);

      if ($stmt) {  

        echo json_encode([
          'success' => 'ok',
          'message' => 'تم الحفظ'
        ]);

      }

    }

  }