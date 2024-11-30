<?php
  include "../../init.php";
  require_once "../../libs/ultramsg/ultramsg.class.php";

  $dots = "../../";

  if($_SERVER['REQUEST_METHOD'] == "POST")  {
    
    $token = "76tol2rxx4w7i0pi";
    $instanceID = "instance94916";
  
    $client = new UltraMsg\WhatsAppApi($token, $instanceID);
  
    $to = $_POST['number'];
    $image = "http://myschool.great-site.net/uploads/" . $_POST['id'] . '.png';

    $media = "data:image/png;base64,".base64_encode(file_get_contents($image)); 

    $api = $client->sendImageMessage($to, $media, Session::get('settings')->invoiceMsg);
      
    header('content-type: application/json');

    echo json_encode([$api]);

  }