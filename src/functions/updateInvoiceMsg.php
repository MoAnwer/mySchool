<?php 
  include "../../init.php";
  $dots = "../../";

  if (Session::has('superadmin') && Session::has('isLogged')) {

    if($_SERVER['REQUEST_METHOD'] == "POST") {

      $newInvoiceMsg = $_POST['msg'];

      $sql = DB::connection()->prepare("UPDATE settings SET InvoiceMsg = ?");
      $stmt = $sql->execute([$newInvoiceMsg]);

      $setting = DB::connection()->query('SELECT * FROM settings', 5)->fetch();

      Session::set('settings', $setting);

      if ($stmt) {  

        echo json_encode([
          'success' => 'ok',
          'message' => 'تم الحفظ'
        ]);

      }

    }

  }