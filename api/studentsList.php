<?php

  include '../init.php';

  $dots = '../';

  $students = (new Student)->all();

  header('content-type: application/json');
  
  if (Session::has('isLogged') && password_verify('logToken', Session::get('isLogged'))) {

    echo json_encode([
      'code' => 200,
      'message' => 'نجاح',
      'timestamp' => date('Y-m-d H:i:sA'),
      'token' => Session::get('isLogged'),
      'students' => $students,
    ]);

  } else {

    header('HTTP/1.1 403');
    echo json_encode([
      'code' => 403,
      'timestamp' => date('Y-m-d H:i:sA'),
      'message' => 'فشل , انت لاتملك الصلاحية لعرض هذه الصفحة',
    ]);

  }