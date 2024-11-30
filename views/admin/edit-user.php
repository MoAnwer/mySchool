<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  Component::header(['title' => 'تعديل مستخدم']);

  $userID = filter($_GET['id'], 'int');
  
  $user = (new User)->find($userID);

?>

 <div id="wrapper">

   <?php Component::sidebar(); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

       <?php Component::navbar();?>

        <div class="container-fluid mt-4">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">تعديل مستخدم</h1>
          </div>
            
            <!-- Content Row -->
            <div class="row">
              <div class="col-12">
                <form class="user">
                  <div class="row mt-3">
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <input type="hidden" id="id" value="<?=$user->id?>">
                        <input type="text" class="form-control form-control-user" id="fullName" name="fullName" value="<?=$user->fullName?>"  placeholder="الاسم رباعي" >
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" value="<?=$user->username?>" id="username" name="username" placeholder="اسم المستخدم" >
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <input type="text" data-value="<?=$user->password?>" class="form-control form-control-user" id="password" name="password" placeholder="كلمة السر (اتركه فارغاً اذا لا تريد تغير كلمة السر)">
                      </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                      <button id="edit" class="btn btn-success col-12">تعديل</button>
                    </div>
                  </div>
                </form>
                
              </div>
          </div>
      </div>
  </div>

  
<?php Component::footer();?>
<script src="<?=$js?>alertify.min.js"></script>
<script src="<?=$js?>editUser.js"></script>