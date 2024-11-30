<?php

  require_once '../../init.php';
  $dots = '../../';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userName = Session::get('username');
    $passwordFromDB = DB::connection()->query("SELECT * FROM users WHERE username = '$userName' ", 5)->fetch()->password;
    $passwordFromPost = filter($_POST['password'], 'string');

    if(password_verify($passwordFromPost, $passwordFromDB)) {

      // Delete images from uploads directory
      $imagesNames = DB::connection()->query('SELECT `image`	FROM `invoices`', 5)->fetchAll();

      foreach ($imagesNames as $image) {
        $imageFile = '../../uploads/' . $image->image; 
      
        if (file_exists($imageFile)) {
          @unlink($imageFile);
        }
        
      }

      
      // Delete data form database
      DB::connection()->query("DELETE FROM users WHERE username != '$userName'");
      DB::connection()->query("SET foreign_key_checks = 0;");
      DB::connection()->query("LOCK TABLES `invoices` WRITE; TRUNCATE TABLE `invoices`; UNLOCK TABLES;");
      DB::connection()->query("LOCK TABLES `installments` WRITE; TRUNCATE TABLE `installments`; UNLOCK TABLES;");
      DB::connection()->query("LOCK TABLES `students` WRITE; DELETE FROM `students`; UNLOCK TABLES;");
      DB::connection()->query("SET foreign_key_checks = 1;");

      
  
      echo json_encode([
        'success' => 200, 
        'message' => 'تم حذف جميع البيانات بنجاح !'
      ]);

    } else {

      echo json_encode([
        'success' => 404, 
        'message' => 'كلمة السر غير صحيحة'
      ]);

    }
    
  }