<?php 
  require_once '../../init.php';
  $dots = '../../';

  $data = json_decode(file_get_contents("php://input"), true);
  
  $fullName = $data['fullName'];
  $username = $data['username'];
  $password = $data['password'];


  $user = new User();

  $userData = [];

  if (!empty($data['password'])) {
    $userData = [
      'username' => $username,
      'fullName' => $fullName,
      'password' => password_hash($password, 1),
    ];
  } else {
    $userData = [
      'username' => $username,
      'fullName' => $fullName,
    ];
  }

  $edit = $user->update($data['id'], $userData);

  if($edit) {

    echo json_encode([
      'success' => 200,
      'message' => 'تم تعديل بيانات المستخدم بنجاح'
    ]);

  } else {

    echo json_encode([
      'success' => 404,
      'message' => 'اسم المستخدم موجود بالفعل'
    ]);

  }