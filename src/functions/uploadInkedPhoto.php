<?php

  require_once '../../init.php';
  $dots = '../../';


  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $extension = explode('/', $_FILES['inkedPhoto']['type'])[1];
    // Update the upload img and set has extension 
    $_FILES['inkedPhoto']['name'] = 'inkedPhoto' . '.' . $extension;

    $fileName = $_FILES['inkedPhoto']['name'];
    $fileTmpPath = $_FILES['inkedPhoto']['tmp_name'];

    if (file_exists('../../assets/images/inkedPhoto.png')) {
      unlink('../../assets/images/inkedPhoto.png');
    }
    
    move_uploaded_file($fileTmpPath, '../../assets/images/'. $fileName);
    header('location: ../../views/admin/settings');
    exit;
  }