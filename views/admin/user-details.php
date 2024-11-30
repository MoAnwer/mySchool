<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  $username = Session::get('username');

   $id = filter($_GET['id'] ?? 0, 'int');

  $user = (new User())->find($id);

  if(!$user) abort(404);

  Component::header(['title' => $username]);
?>
 <div id="wrapper">

   <?php Component::sidebar(); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

       <?php Component::navbar();?>

        <div class="container-fluid mt-4">

          <div class="row">
            <div class="col-lg-6 col-12 mx-auto mt-5">
              <div class="card py-3">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                  <div class="d-flex flex-column align-items-center mb-4 border-bottom pb-3">
                    <img src="../../assets/images/undraw_profile_2.svg" class="mb-3" width="200">
                    <h1 class="h5"><?=$user->username?></h1>
                  </div>
                  <div class="data w-100">
                    <ul class="list-group px-0">
                      <li class="list-group-item">
                        <i class="bi bi-person-fill ml-2 text-primary py-2"></i>
                        <b>الاسم الرباعي : </b>
                        <?=$user->fullName?>
                      </li>
                      <li class="list-group-item">
                        <i class="bi bi-people-fill text-primary py-2"></i>
                        <b>اسم المستخدم : </b>
                        <?=$user->username?>
                      </li>
                      <li class="list-group-item">
                        <i class="bi bi-check-circle-fill text-primary py-2"></i>
                        <b>المنصب : </b>
                        <?=$user->role?>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>

          </div>

      </div>
    
    </div>

  </div>
  
</div>

<?php Component::footer();?>