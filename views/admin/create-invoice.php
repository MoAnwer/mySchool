<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : abort(403);
  
  Component::header([
    'title' => "استخراج ايصال",
    'cssFile' => null,
  ]);

  $db = DB::connection();


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
                <h1 class="h3 mb-0 text-gray-800">استخراج ايصال</h1>
            </div>

            <div class="row">
              <form method="post" class="col-lg-5 m-3 col-12 user" id="invoice-form">
  
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="enrollNumber">رقم الإستمارة</label>
                      <input type="number" id="enrollNumber" class="form-control py-3" name="enrollNumber">
                  </div>

                  <div class="form-group col-12">
                    <label for="gender">النوع</label>
                     <select name="gender" id="gender" class="form-control p-0" require>
                      <option value="بنين">بنين</option>
                      <option value="بنات">بنات</option>
                    </select>
                    </div>

                  <div class="form-group col-12">
                    <label for="stage">المرحلة</label>                     
                    <select name="stage" id="stage" class="form-control p-0" require>
                      <option value="رياض">رياض</option>
                      <option value="ابتدائي">ابتدائي</option>
                      <option value="متوسط">متوسط</option>
                      <option value="ثانوي">ثانوي</option>
                    </select>
                  </div>

                    <div class="form-group col-12">
                      <label for="install">القسط</label>
                      <select name="install" id="install" class="form-control  p-0  mb-1 px-1 ml-4" require>
                        <option value="1">الاول</option>
                        <option value="2">الثاني</option>
                        <option value="3">الثالث</option>
                        <option value="4">الرابع</option>
                        <option value="5">الخامس</option>
                        <option value="6">السادس</option>
                      </select>
                    </div>
  
                    <div class="form-group col-12">
                      <label for="paid">المبلغ المدفوع</label>
                      <input type="number" id="paid" class="form-control" name="paid" placeholder="0000" />
                    </div>

                    <div class="form-group col-12">
                      <label for="paidWay">طريقة الدفع</label>
                      <select name="paidWay" id="paidWay" class="form-control  p-0  mb-1 px-1 ml-4" require>
                        <option value="كاش">كاش</option>
                        <option value="بنكك">بنكك</option>
                      </select>
                    </div>

                    <div class="form-group col-12" id="proNum"></div>
  
                    <div class="col-12">
                      <button id="create" class="btn btn-success w-100">انشاء</button>
                    </div>

                  </div>
              </form>
              
              <div class="col-lg-5 m-3 col-12" id="invoice">
                <div class="text-gray-800 h-100 text-center p-4" style="background-color: #f5f5f5;">
                  <h1>معاينة</h1>
                </div>
                <div class="btns d-none">
                  <button class="btn btn-success d-block w-100 m-1" id="sendWathsapp"><i class="bi bi-whatsapp mx-1"></i>ارسال عبر الواتساب</button>
                  <button class="btn btn-info d-block w-100 m-1" id="print"><i class="bi bi-printer mx-1"></i>طباعة</button>
                </div>
            </div>
<script src="<?=$js?>html2canvas.min.js"></script>
<script src="<?=$js?>jquery.js"></script>
<script src="<?=$js?>alertify.min.js"></script>
<script src="<?=$js?>create-invoice.js"></script>
<script src="<?=$js?>bootstrap.js"></script>
<script src="<?=$js?>jquery.easing.js"></script>
<script src="<?=$js?>admin.js"></script>