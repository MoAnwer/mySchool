<?php

  include '../../init.php';
  $dots = "../../";

  if(isset($_FILES['backupFile'])) {
    $fileName = $_FILES['backupFile']['name'];
    $fileTmpPath = $_FILES['backupFile']['tmp_name'];
    $data = file_get_contents($fileTmpPath);


    $q = DB::connection()->query($data . "ALTER TABLE `installments` CHANGE `paid_1` `paid_1` DECIMAL(11,0) NULL DEFAULT '0', CHANGE `paid_2` `paid_2` DECIMAL(11,0) NULL DEFAULT '0', CHANGE `paid_3` `paid_3` DECIMAL(11,0) NULL DEFAULT '0', CHANGE `paid_4` `paid_4` DECIMAL(11,0) NULL DEFAULT '0', CHANGE `paid_5` `paid_5` DECIMAL(11,0) NULL DEFAULT '0', CHANGE `paid_6` `paid_6` DECIMAL(11,0) NULL DEFAULT '0';");
    
    if ($q) {
  
      echo 'تم الإستيراد بنجاح <i class ="bi bi-check-circle-fill"></i>';
  
    } else {
  
      echo 'حدث مشكلة في الإستيراد<i class="bi bi-x-circle-fill"></i>';
  
    }
  }
  