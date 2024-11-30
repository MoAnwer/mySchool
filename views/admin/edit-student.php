<?php

  include '../../init.php';
  $dots = '../../';
  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  

  $studentID = filter($_GET['id'], 'int');

  $student = (new Student)->find($studentID);

  if (!$student) {
    abort(404);
    exit(404);
  }

  $Installments = DB::connection()->query("SELECT * FROM installments WHERE student_id = $studentID", 5)->fetch();
  
  Component::header([
    'title' => 'تعديل تلميذ',
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
                  تعديل تلميذ
                </h1>
            </div>
            
            <form method="post" class="user">
                <input type="hidden" name="id" value="<?=$studentID?>">
              <div class="row mb-1">
                  <div class="form-group col-lg-5">
                  <input type="text" class="form-control form-control py-3" name="fullName" value="<?=$student->fullName?>" require>
                </div>
                <select name="gender" class="form-control p-0 col-12 col-lg-2 mx-2" require>
                  <option value="<?=$student->gender?>" selected ><?=$student->gender?></option>
                  <option value="بنين">بنين</option>
                  <option value="بنات">بنات</option>
                </select>

                  <select name="stage" class="form-control p-0 col-12 col-lg-2 mx-2" require>
                    <option value="<?=$student->stage?>" selected ><?=$student->stage?></option>
                    <option value="رياض">رياض</option>
                    <option value="ابتدائي">ابتدائي</option>
                    <option value="متوسط">متوسط</option>
                    <option value="ثانوي">ثانوي</option>
                  </select>
                  
                  <select name="class" class="form-control p-0 col-12 col-lg-2 mx-2" require>
                    <option value="<?=$student->class?>" selected ><?=$student->class?></option>
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
                  <input type="number" class="form-control form-control" name="enrollNumber" value="<?=$student->enrollNumber?>" require>
                </div>

                <div class="form-group col-lg-6">
                  <input type="date" class="form-control form-control" name="enrollDate" value="<?=$student->enrollDate?>"  require>
                </div>

              </div>

              
              <div class="row">

                <div class="form-group col-lg-6">
                  <input type="text" class="form-control form-control" name="birthPlace" value="<?=$student->birthPlace?>"  require>
                </div>
                
                <div class="form-group col-lg-6">
                  <input type="date" class="form-control form-control" name="birthDate" value="<?=$student->birthDate?>" require>
                </div>

              </div>

              
              <div class="row">
                <div class="form-group col-lg-3">
                  <input type="text" class="form-control form-control" name="address" value="<?=$student->address?>"  require>
                </div>

                <div class="form-group col-lg-3 col-sm-12">
                  <input type="text" class="form-control form-control" name="guardian" value="<?=$student->guardian?>"  require>
                </div>

                <div class="form-group col-lg-3 col-sm-12">
                  <input type="text" class="form-control form-control" name="guardianCopula" value="<?=$student->guardianCopula?>" require>
                </div>

                <div class="form-group col-lg-3">
                  <input type="text" class="form-control form-control" name="guardianCareer" value="<?=$student->guardianCareer?>" require>
                </div>

              </div>


              <div class="row">
                
                  <div class="form-group col-lg-4">
                    <input type="text" class="form-control form-control" name="phoneOne" value="<?=$student->phoneOne?>"  require>
                  </div>

                  <div class="form-group col-lg-4">
                    <input type="text" class="form-control form-control" name="phoneTwo" value="<?=$student->phoneTwo?>"  require>
                  </div>

                  <div class="form-group col-lg-4">
                    <input type="text" class="form-control form-control" name="whatsappPhone" value="<?=$student->whatsappPhone?>"  require>
                  </div>

              </div>
              <hr>
            
              <div class="row">
                <div class="form-group col-12">
                  <input type="text" class="form-control form-control" name="total"  value="<?=$Installments->total?>" >
                </div>
                <div class="form-group col-4">
                  <input type="text" class="form-control form-control" name="install_1" value="<?=$Installments->install_1?>" require>
                </div>
                
                <div class="form-group col-lg-4">
                <input type="date" class="form-control form-control" name="installDate_1" value="<?=$Installments->installDate_1?>">
                </div>

                <div class="form-group col-lg-4">
                  <input type="text" class="form-control form-control" name="paid_1" value="<?=$Installments->paid_1?>" require>
                </div>

              </div>

              <div class="row">
                
                <div class="form-group col-4">
                  <input type="text" class="form-control form-control" name="install_2" value="<?=$Installments->install_2?>" require>
                </div>
                
                <div class="form-group col-lg-4">
                  <input type="date" class="form-control form-control" name="installDate_2" value="<?=$Installments->installDate_2?>" require>
                </div>

                <div class="form-group col-lg-4">
                  <input type="text" class="form-control form-control" name="paid_2" value="<?=$Installments->paid_2?>" require>
                </div>

              </div>
              <div class="row">
                
                <div class="form-group col-4">
                  <input type="text" class="form-control form-control" name="install_3" value="<?=$Installments->install_3?>" require>
                </div>
                
                <div class="form-group col-lg-4">
                  <input type="date" class="form-control form-control" name="installDate_3" value="<?=$Installments->installDate_3?>" require>
                </div>

                <div class="form-group col-lg-4">
                  <input type="text" class="form-control form-control" name="paid_3" value="<?=$Installments->paid_3?>" require>
                </div>

              </div>
              <div class="row">
                
                <div class="form-group col-4">
                  <input type="text" class="form-control form-control" name="install_4" value="<?=$Installments->install_4?>" require>
                </div>
                
                <div class="form-group col-lg-4">
                  <input type="date" class="form-control form-control" name="installDate_4" value="<?=$Installments->installDate_4?>"  require>
                </div>

                <div class="form-group col-lg-4">
                  <input type="text" class="form-control form-control" name="paid_4" value="<?=$Installments->paid_4?>"  require>
                </div>

              </div>

              <div class="row">
                
                <div class="form-group col-4">
                  <input type="text" class="form-control form-control" name="install_5" value="<?=$Installments->install_5?>"  require>
                </div>
                
                <div class="form-group col-lg-4">
                  <input type="date" class="form-control form-control" name="installDate_5" value="<?=$Installments->installDate_5?>" require>
                </div>

                <div class="form-group col-lg-4">
                  <input type="text" class="form-control form-control" name="paid_5" value="<?=$Installments->paid_5?>"require>
                </div>

              </div>
              <div class="row">
                
                <div class="form-group col-4">
                  <input type="text" class="form-control form-control" name="install_6" value="<?=$Installments->install_6?>" require>
                </div>
                
                <div class="form-group col-lg-4">
                  <input type="date" class="form-control form-control" name="installDate_6" value="<?=$Installments->installDate_6?>" require>
                </div>

                <div class="form-group col-lg-4">
                  <input type="text" class="form-control form-control" name="paid_6" value="<?=$Installments->paid_6?>" require>
                </div>

              </div>
              
              <button type="submit" id="updateBtn" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                  <i class="bi bi-check-circle"></i>
                </span>
                <span class="text">تعديل البيانات</span>
              </button>
            </form>
          
        </div>

      </div>

    </div>

  </div>
  
  <script src="<?=$js?>alertify.min.js"></script>
  <script src="<?=$js?>updateStudent.js"></script>
<?php Component::footer();?>