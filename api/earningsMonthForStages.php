<?php
  
  include '../init.php';

  $dots = '../';
  $month = filter($_GET['month'] ?? date('m'), 'string');

  $data = [
    'month' => $month,
    'stagesEarnings' => [
      'kages' => (int)(new Invoice())->getEarningsMonthFor('رياض', $month),
      'base' => (int)(new Invoice())->getEarningsMonthFor('ابتدائي', $month),
      'middle' => (int)(new Invoice())->getEarningsMonthFor('متوسط', $month),
      'secondary' => (int)(new Invoice())->getEarningsMonthFor('ثانوي', $month),
    ]
  ];
  
  echo json_encode($data);