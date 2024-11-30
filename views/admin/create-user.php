<?php

  require_once '../../init.php';
  
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  Component::header(['title' => 'اضافة مستخدم']);
  
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
                <h1 class="h3 mb-0 text-gray-800">اضافة مستخدم</h1>
            </div>
            
            <!-- Content Row -->
            <div class="row">

            <div class="col-12">
              <form class="user">
                <div class="row mt-3">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="fullName" name="fullName"  placeholder="الاسم رباعي" >
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="اسم المستخدم" >
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="password" name="password" placeholder="كلمة السر">
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <a id="create" class="btn btn-success col-12">اضافة</a>
                  </div>
                </div>
              </form>
            </div>

            <!-- Content Row  -->
          </div>

        </div>

      </div>

    </div>

 </div>

<?php Component::footer();?>
<script src="<?=$js?>alertify.min.js"></script>
<script src="<?=$js?>createUser.js"></script>