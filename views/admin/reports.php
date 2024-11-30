<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();

  Component::header(['title' => "التقارير"]);
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
                <h1 class="h3 mb-0 text-gray-800">التقارير</h1>
            </div>


            <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">تقارير المرحلة</h6>
                                </div>
                                <div class="card-body">
                                  <form method="post">
                                    <label for="stage">المرحلة</label>
                                    <select name="stage" class="form-control p-0 col-12 my-1" require>
                                      <option value="رياض">رياض</option>
                                      <option value="ابتدائي">ابتدائي</option>
                                      <option value="متوسط">متوسط</option>
                                      <option value="ثانوي">ثانوي</option>
                                    </select>
                                    <label for="class">الصف</label>
                                    <select name="class" class="form-control p-0 col-12 my-1" require>
                                      <option value="الاول">الاول</option>
                                      <option value="الثاني">الثاني</option>
                                      <option value="الثالث">الثالث</option>
                                      <option value="الرابع">الرابع</option>
                                      <option value="الخامس">الخامس</option>
                                      <option value="السادس">السادس</option>
                                    </select>
                                    <label for="gender">النوع</label>
                                    <select name="gender" class="form-control p-0 col-12 my-1" require>
                                      <option value="بنين">بنين</option>
                                      <option value="بنات">بنات</option>
                                    </select>

                                    <button class="btn btn-primary mt-3">فتح التقرير</button>
                                  </form>
                                </div>
                            </div>
                            <!--  -->
                            <div class="card shadow-sm mb-4">
                              <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">سداد عبر بنكك برقم العملية</h6>
                              </div>
                              <div class="card-body">
                                <form method="post">
                                  <label for="bankakWithProcessNumber_stage">المرحلة</label>
                                  <select name="stage" id="bankakWithProcessNumber_stage" class="form-control p-0 col-12 my-1" require>
                                      <option value="رياض">رياض</option>
                                      <option value="ابتدائي">ابتدائي</option>
                                      <option value="متوسط">متوسط</option>
                                      <option value="ثانوي">ثانوي</option>
                                    </select>
                                  <label for="bankakWithProcessNumber_install">القسط</label>
                                  <select name="install" id="bankakWithProcessNumber_install" class="form-control p-0 col-12 my-1 " require>
                                    <option value="الاول">القسط الاول</option>
                                    <option value="الثاني">القسط الثاني</option>
                                    <option value="الثالث">القسط الثالث</option>
                                    <option value="الرابع">القسط الرابع</option>
                                    <option value="الخامس">القسط الخامس</option>
                                    <option value="السادس">القسط السادس</option>
                                  </select>
                                  <label for="bankakWithProcessNumber_processNumber">رقم العملية</label>
                                  <input type="numbre" name="processNumber" id="bankakWithProcessNumber_processNumber" class="form-control col-12 my-1">
                                  <button class="btn btn-primary mt-3" id='bankakWithProcessNumber'>فتح التقرير</button>
                                </form>
                              </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">

                          <!-- installments list -->
                          <div class="card shadow-sm mb-4">
                              <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">قائمة الأقساط المطلوبة و مدفوعاتها</h6>
                              </div>
                              <div class="card-body">
                                <label for="stageInstallsAndPaids">المرحلة</label>
                                <select id="stageInstallsAndPaids" name="stage" class="form-control p-0 col-12 my-1">
                                  <option value="رياض">رياض</option>
                                  <option value="ابتدائي">ابتدائي</option>
                                  <option value="متوسط">متوسط</option>
                                  <option value="ثانوي">ثانوي</option>
                                </select>

                                <label for="genderInstallsAndPaids">النوع</label>
                                <select id="genderInstallsAndPaids" name="gender" class="form-control p-0 col-12 my-1">
                                  <option value="بنين">بنين</option>
                                  <option value="بنات">بنات</option>
                                </select>

                                <div class="btn btn-primary mt-3" id="installsAndPaids">فتح التقرير</div>
                              </div>
                          </div>

                            <!-- سداد عبر بنكك -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">سداد عبر بنكك</h6>
                                </div>
                                <div class="card-body">
                                  <form method="post">
                                    <label for="stageBankak">المرحلة</label>
                                    <select name="stage" id="stageBankak" class="form-control p-0 col-12 my-1 mb-2" require>
                                      <option value="رياض">رياض</option>
                                      <option value="ابتدائي">ابتدائي</option>
                                      <option value="متوسط">متوسط</option>
                                      <option value="ثانوي">ثانوي</option>
                                    </select>
                                    <label for="genderBankak">النوع</label>
                                    <select name="gender" id="genderBankak" class="form-control p-0 col-12 my-1 mb-2" require>
                                      <option value="بنين">بنين</option>
                                      <option value="بنات">بنات</option>
                                    </select>
                                    <label for="installBankak">القسط</label>
                                    <select name="install" id="installBankak" class="form-control p-0 col-12 my-1 " require>
                                      <option value="1">القسط الاول</option>
                                      <option value="2">القسط الثاني</option>
                                      <option value="3">القسط الثالث</option>
                                      <option value="4">القسط الرابع</option>
                                      <option value="5">القسط الخامس</option>
                                      <option value="6">القسط السادس</option>
                                    </select>
                                    <button class="btn btn-primary mt-3" id="bankakPaid">فتح التقرير</button>
                                  </form>
                                </div>
                            </div>
                            <!--  -->
                            
                            <div class="card shadow-sm mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">متبقي الأقساط</h6>
                                </div>
                                <div class="card-body">
                                  <form method="post">
                                    <label for="stage">المرحلة</label>
                                    <select name="stage" id="remanents_stage" class="form-control p-0 col-12 my-1" require>
                                      <option value="رياض">رياض</option>
                                      <option value="ابتدائي">ابتدائي</option>
                                      <option value="متوسط">متوسط</option>
                                      <option value="ثانوي">ثانوي</option>
                                    </select>
                                    <label for="gender">النوع</label>
                                    <select name="gender" id="remanents_gender" class="form-control p-0 col-12 my-1" require>
                                      <option value="بنين">بنين</option>
                                      <option value="بنات">بنات</option>
                                    </select>
                                    <label for="install">القسط</label>
                                    <select name="install" id="remanents_install" class="form-control p-0 col-12 my-1 " require>
                                      <option value="1">القسط الاول</option>
                                      <option value="2">القسط الثاني</option>
                                      <option value="3">القسط الثالث</option>
                                      <option value="4">القسط الرابع</option>
                                      <option value="5">القسط الخامس</option>
                                      <option value="6">القسط السادس</option>
                                    </select>
                                    <button class="btn btn-primary mt-3" id="remanents">فتح التقرير</button>
                                  </form>
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
  <script src="<?=$js?>table.js"></script>
  <script src="<?=$js?>j.table.js"></script>
  <script src="<?=$js?>boot.table.js"></script>
  <script src="<?=$js?>alertify.min.js"></script>
  <script src="<?=$js?>reports.js"></script>
