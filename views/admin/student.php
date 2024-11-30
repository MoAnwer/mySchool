<?php

  include '../../init.php';
  $dots = '../../';
  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  Component::header([
    'title' => 'اضافة تلميذ',
    'cssFile' => null,
  ]);

  ?>

   <div id="wrapper">

   <?php Component::sidebar(); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php Component::navbar();?>

        <div class="container-fluid mt-3">

          <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="h3 mb-4 text-gray-800">
                  اضافة تلميذ
                </h1>
            </div>
            
            <form method="post" class="user">
              <div class="row mb-1">
                  <div class="form-group col-lg-5">
                  <input type="text" class="form-control form-control py-3 requierd" name="fullName" placeholder="الاسم رباعي">
                </div>
                <select name="gender" class="form-control p-0 col-12 col-lg-2 mx-2" require>
                  <option value="بنين">بنين</option>
                  <option value="بنات">بنات</option>
                </select>

                <select name="stage" class="form-control p-0 col-12 col-lg-2 mx-2" require>
                  <option value="رياض">رياض</option>
                  <option value="ابتدائي">ابتدائي</option>
                  <option value="متوسط">متوسط</option>
                  <option value="ثانوي">ثانوي</option>
                </select>
                
                <select name="class" class="form-control p-0 col-12 col-lg-2 mx-2" require>
                  <option value="الاول">الاول</option>
                  <option value="الثاني">الثاني</option>
                  <option value="الثالث">الثالث</option>
                  <option value="الرابع">الرابع</option>
                  <option value="الخامس">الخامس</option>
                  <option value="السادس">السادس</option>
                </select>
              </div>
              
              <div class="row">

                <div class="form-group col-lg-6">
                  <input type="number" class="form-control form-control requierd" name="enrollNumber" placeholder="رقم الإستمارة" require>
                </div>

                <div class="form-group col-lg-6">
                  <input type="date" class="form-control form-control requierd" name="enrollDate" placeholder="تاريخ ملء الاستمارة" require>
                </div>

              </div>

              
              <div class="row">

                <div class="form-group col-lg-6">
                  <input type="text" class="form-control form-control" name="birthPlace" placeholder="مكان الميلاد" require>
                </div>
                
                <div class="form-group col-lg-6">
                  <input type="date" class="form-control form-control" name="birthDate" placeholder="تاريخ الميلاد" require>
                </div>

              </div>

              
              <div class="row">
                <div class="form-group col-lg-3">
                  <input type="text" class="form-control form-control" name="address" placeholder="السكن" require>
                </div>

                <div class="form-group col-lg-3 col-sm-12">
                  <input type="text" class="form-control form-control" name="guardian" placeholder="ولي الأمر" require>
                </div>

                <div class="form-group col-lg-3 col-sm-12">
                  <input type="text" class="form-control form-control" name="guardianCopula" placeholder="صلة القرابة" require>
                </div>

                <div class="form-group col-lg-3">
                  <input type="text" class="form-control form-control" name="guardianCareer" placeholder="المهنة" require>
                </div>

              </div>


              <div class="row">
                
                  <div class="form-group col-lg-4">
                    <input type="text" class="form-control form-control" name="phoneOne" placeholder="هاتف 1" require>
                  </div>

                  <div class="form-group col-lg-4">
                    <input type="text" class="form-control form-control" name="phoneTwo"  placeholder="هاتف 2" require>
                  </div>

                  <div class="form-group col-lg-4">
                    <input type="text" class="form-control form-control" name="whatsappPhone"  placeholder="واتس" require>
                  </div>

              </div>
              <hr>
            
              <div class="row">
                <div class="form-group col-12">
                  <input type="text" class="form-control form-control" name="total" placeholder="الرسوم المقررة">
                </div>
                <div class="form-group col-lg-6 col-12">
                  <input type="text" class="form-control form-control" name="install_1" placeholder="قيمة القسط الأول" require>
                </div>
                
                <div class="form-group col-lg-6 col-12">
                  <input type="date" class="form-control form-control" name="installDate_1" placeholder="تاريخ الإستحقاق" require>
                </div>


              </div>

              <div class="row">
                
                <div class="form-group col-lg-6 col-12">
                  <input type="text" class="form-control form-control" name="install_2" placeholder="قيمة القسط الثاني" require>
                </div>
                
                <div class="form-group col-lg-6 col-12">
                  <input type="date" class="form-control form-control" name="installDate_2" placeholder="تاريخ الإستحقاق" require>
                </div>


              </div>
              <div class="row">
                
                <div class="form-group col-lg-6 col-12">
                  <input type="text" class="form-control form-control" name="install_3" placeholder="قيمة القسط الثالث" require>
                </div>
                
                <div class="form-group col-lg-6 col-12">
                  <input type="date" class="form-control form-control" name="installDate_3" placeholder="تاريخ الإستحقاق" require>
                </div>


              </div>
              <div class="row">
                
                <div class="form-group col-lg-6 col-12">
                  <input type="text" class="form-control form-control" name="install_4" placeholder="قيمة القسط الرابع" require>
                </div>
                
                <div class="form-group col-lg-6 col-12">
                  <input type="date" class="form-control form-control" name="installDate_4" placeholder="تاريخ الإستحقاق" require>
                </div>


              </div>

              <div class="row">
                
                <div class="form-group col-lg-6 col-12">
                  <input type="text" class="form-control form-control" name="install_5" placeholder="قيمة القسط الخامس" require>
                </div>
                
                <div class="form-group col-lg-6 col-12">
                  <input type="date" class="form-control form-control" name="installDate_5" placeholder="تاريخ الإستحقاق" require>
                </div>


              </div>
              <div class="row">
                
                <div class="form-group col-lg-6 col-12">
                  <input type="text" class="form-control form-control" name="install_6" placeholder="قيمة القسط السادس" require>
                </div>
                
                <div class="form-group col-lg-6 col-12">
                  <input type="date" class="form-control form-control" name="installDate_6" placeholder="تاريخ الإستحقاق" require>
                </div>


              </div>
              
              <a id="alert" class="btn btn-success">
                <span class="text">
                  <i class="bi bi-person-plus-fill ml-1"></i>
                  إضافة
                </span>
              </a>
            </form>
          
        </div>

      </div>

    </div>

  </div>
  
  <?php Component::footer();?>
<script src="<?=$js?>alertify.min.js"></script>
<script src="<?=$js?>insertStudent.js"></script>