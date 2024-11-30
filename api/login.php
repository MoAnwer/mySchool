<?php
  
  include '../init.php';

  $dots = '../';

  $user = new User();

  $username = filter($_POST['username'], 'string');

  $password = filter($_POST['password'], 'string');

  $loginAction = $user->login($username, $password, false);



  header('content-type: application/json');

  if ($loginAction) {
    
    echo json_encode(
      [
        'responseCode' => 200,
        'responseMsg' => 'استعلام ناجح !',
        'message' => 'تم تسجيل الدخول بنجاح !!',
        'token' => Session::get('isLogged'),
        'timestamp' => date('Y-m-d H:i:sA'),
      ]
    );

  } else {
    header('HTTP/1.1 403');

    echo json_encode([
      'responseCode' => 403,
      'timestamp' => date('Y-m-d H:i:sA'),
      'resposenMsg' => 'فشل',
      'message' => 'تحقق من  كلمة السر او اسم المستخدم',
      'token' => Session::get('isLogged'),
      'timestamp' => date('Y-m-d H:i:sA'),
    ]);

  }