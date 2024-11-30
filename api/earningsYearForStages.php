<?php
  
  include '../init.php';

  $dots = '../';

  $yearEarnings = [];

  for ($i= 1; $i < 13; $i++) { 
    $monthEarnings = [
      'month' => (int)$i,
      'earnings' => (new Invoice())->getYearEarnings($i) ?? 0
    ];
    array_push($yearEarnings, $monthEarnings);
  }
  
  header('content-type: application/json');
  echo json_encode($yearEarnings);