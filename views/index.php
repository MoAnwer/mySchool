<?php

  require_once '../init.php';
  $dots = '../';

  User::authCheck() ? header('location: admin/dashboard') : true;
  Session::has('user') && Session::has('isLogged') ? header('location: student-data') : true;

  Component::header([
    'title' => 'تسجيل دخول',
    'bodyClass' => 'bg-gradient-primary'
  ]);

  $user = '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = (new User())->login($_POST['username'], $_POST['password']);
  }

  ?>  
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 col-sm-12 mx-auto">
      <?=$user?>
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-4">
                    <div class="profile-img mx-auto" style="width:150px">
                      <img src="http://myschool.great-site.net/assets/images/undraw_profile_2.svg">
                    </div>
                    <div class="text-center">
                        <!-- <h1 class="h3 text-gray-900 my-4">تسجيل دخول</h1> -->
                        <hr>
                    </div>
                    <form class="user" action="" method="POST">
                        <div class="form-group">
                          <input type="text" class="form-control form-control-user" name="username" placeholder="اسم المستخدم">
                        </div>
                        
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password"  placeholder="كلمة السر">
                            </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                           تسجيل دخول
                        </button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>