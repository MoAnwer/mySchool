<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() && User::isSuperAdmin() ? true : header('location: http://myschool.great-site.net/views/admin/reports');
  
  Component::header([
    'title' => 'اعدادت البرنامج',
    'cssFile' => null,
  ]);

  $settings = DB::connection()->query('SELECT * FROM settings', 5)->fetch();

  $backupFile = '../../backup/database_backup.sql';
  $lastModified = date('d/m/Y', filemtime($backupFile));

  $fileSize = getFileSize($backupFile);
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
                <h1 class="h3 mb-0 text-gray-800"> <i class='bi bi-gear-wide-connected'></i> اعدادات البرنامج</h1>
            </div>

          <div class="row">
            <!-- Base data -->
            <div class="col-xl-4 col-md-12">
              <div class="card shadow-sm mb-3 mx-0">
                <div class="card-header py-3 m-0 font-weight-bold text-primary">
                  <i class='bi bi-credit-card'></i> البيانات الاساسية
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="schoolname">اسم المدرسة : </label>
                        <input type="text" id="name" class="form-control form-control" name="appName" value="<?=Session::get('app')?>" >
                      </div>
                    </div>
                  </form>
                  <hr>
                  <div class="d-flex justify-content-end">
                    <button id="updateData" class="btn btn-success py-1" title="حفظ التعديلات">
                      <i class="bi bi-save2 mx-1"></i>
                      حفظ
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Base data -->

            <!-- install data -->
            <div class="col-xl-4 col-md-12">
              <div class="card shadow-sm mb-3 mx-0">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                <i class='bi bi-wallet-fill'></i> بيانات الايصالات
              </div>

                <div class="card-body">
                  <form method="post">
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="msg">رسالة دفع الايصال :</label>
                        <input type="text" id="msg" class="form-control form-control" name="msg" value="<?=$settings->invoiceMsg?>" />
                      </div>
                    </div>
                  </form>
                  <hr>
                  <div class="d-flex justify-content-end">
                    <button id="updateMsg" class="btn btn-success py-1" title="حفظ التعديلات">
                      <i class="bi bi-save2 mx-1"></i>
                      حفظ
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- install data -->

            <!-- inked photo -->
            <div class="col-xl-4 col-md-12" title="صورة التوقيع الموضوعة في الايصال">
              <div class="card shadow-sm mb-3 mx-0">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                <i class='bi bi-image'></i> صورة التوقيع
              </div>

                <div class="card-body">
                  <form method="post" action="http://myschool.great-site.net/src/functions/uploadInkedPhoto.php" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="inkedPhoto">صورة التوقيع :</label>
                        <input type="file" name="inkedPhoto" id="inkedPhoto" class="form-control p-1" accept=".png">
                      </div>
                    </div>
                  <hr>
                  <div class="d-flex justify-content-end">
                    <button id="updateMsg" class="btn btn-success py-1" title="حفظ التعديلات">
                      <i class="bi bi-save2 mx-1"></i>
                      حفظ
                    </button>
                  </div>
                </form>
                </div>
              </div>
            </div>
            <!-- inked photo -->
              
            </div>
          
        <!-- Export backup -->
          <div class="row">

            <div class="col-lg-6 col-12">
              <div class="card shadow-sm mb-3" id="newBackup">
                <div class="card-header py-3 m-0 font-weight-bold text-primary">
                    <i class='bi bi-database-fill'></i> النسخ الإحتياطي لقاعدة البيانات
                </div>

                <div class="card-body">
                  <div class="border mb-0 py-2 px-3 rounded d-flex align-items-center w-100">
                      <div class="ml-4 border-left pl-3 pr-2">
                          <i class="bi bi-database-fill-check text-success h5 mb-0"></i>
                      </div>
                      <div class="d-flex justify-content-between align-items-center  w-100">
                          <span class="h6 mb-0 text-dark">
                            <p class="mt-3 mb-3">اخر عملية نسخ الإحتياطي في : <b dir="ltr"><?=$lastModified?></b></p>
                          </span>          
                          <span class="border-right pr-3">
                            <b><?=$fileSize?></b>
                          </span>                
                      </div>
                  </div>
                  <hr>
                  <!-- actions btns -->
                  <div class="d-flex justify-content-end">
                    <button id="backup" class="btn btn-primary ml-2" title="عمل نسخة احتياطية جديدة لقاعدة البيانات">
                      <i class="bi bi-database-fill mx-1"></i>
                      الاحتفاظ بنسخة احتياطية
                    </button>
                    <button id="download" class="btn btn-success" title="تحميل النسخة احتياطية على جهازك">
                      <i class="bi bi-download mx-1"></i>
                      تحميل النسخة احتياطية
                    </button>
                  </div>
                  <!-- actions btns -->

                </div>
                
              </div>
                              
            </div>
              <!-- Export backup -->
              
            <!-- import backup -->
            <div class="col-lg-6 col-12 ">
              
              <div class="card shadow-sm mb-3">
                <div class="card-header py-3 m-0 font-weight-bold text-primary">
                  <i class='bi bi-database-down'></i> استيراد نسخة الإحتياطية 
                </div>
                <div class="card-body py-3">
                  <p class="px-3">استيراد البيانات من ملف النسخة الاحتياطية :</p>
                  <form method="post" action="http://myschool.great-site.net/src/functions/importBackup.php" enctype="multipart/form-data" id="importForm">
                    <div class="form-group">
                      <input type="file" name="backupFile" id="backupFile" class="form-control p-1" accept=".sql" require>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                      <button id="importbackup" type="submit" class="btn btn-primary ml-2" title="عمل نسخة احتياطية جديدة لقاعدة البيانات">
                        <i class="bi bi-database-down mx-1"></i>
                          بدء استيراد
                        </button>
                      </div>
                    </form>
                  </div>
                </div>

              </div>


          </div>

            <!-- import backup -->

                            
            <!-- import backup -->
            <div class="card shadow-sm mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                  <i class='bi bi-file-earmark-spreadsheet-fill m-1'></i> تصدير البيانات الى  Excel
              </div>
              <div class="card-body">
                <p class="h6 mb-4">سوف يتم تصدير ملفات <b class="text-success">Microsoft Excel</b> تحتوي على :</p>
                <ul class="list-group px-0">
                  <li class="list-group-item text-primary">
                    <div class="row align-items-center justify-content-between">
                      <div class="col-11">
                        <i class="bi bi-file-earmark-bar-graph ml-2"></i> 
                        اجمالي مدفوعات المدرسة للعام <?=date('Y')?>
                      </div>
                      <a href="http://myschool.great-site.net/src/functions/downloadExcelFiles?i=0" class="btn btn-success ml-2">
                        <i class="bi bi-download mx-1"></i>
                      </a>
                    </div>
                  </li>
                  <li class="list-group-item text-primary">
                    <div class="row align-items-center justify-content-between">
                      <div class="col-11">
                        <i class="bi bi-file-earmark-bar-graph ml-2"></i>
                        بيانات الطلاب المالية للعام <?=date('Y')?>
                      </div>
                      <a href="http://myschool.great-site.net/src/functions/downloadExcelFiles?i=1" class="btn btn-success ml-2">
                        <i class="bi bi-download mx-1"></i>
                      </a>
                    </div>
                  </li>
                  <li class="list-group-item text-primary">
                    <div class="row align-items-center justify-content-between">
                      <div class="col-11">
                        <i class="bi bi-file-earmark-bar-graph ml-2"></i>
                        عدد طلاب المدرسة للعام <?=date('Y')?>
                      </div>
                      <a href="http://myschool.great-site.net/src/functions/downloadExcelFiles?i=2" class="btn btn-success ml-2">
                        <i class="bi bi-download mx-1"></i>
                      </a>
                    </div>
                  </li>
                  <li class="list-group-item text-primary">
                    <div class="row align-items-center justify-content-between">
                      <div class="col-11">
                        <i class="bi bi-file-earmark-bar-graph ml-2"></i>
                        بيانات الطلاب للعام <?=date('Y')?>
                      </div>
                      <a href="http://myschool.great-site.net/src/functions/downloadExcelFiles?i=3" class="btn btn-success ml-2">
                        <i class="bi bi-download mx-1"></i>
                      </a>
                      </div>
                    </div>
                  </li>
                </ul>
              </di align-items-center justify-content-betweenv>
              <hr class="m-0">
              <div class="card-body">
                <div class="d-flex justify-content-end">
                  <button id="exportExcel" class="btn btn-primary ml-2" title="انشاء نسخة جديدة">
                    <i class="bi bi-check-circle-fill mx-1"></i>
                      انشاء نسخة جديدة
                  </button>
                </div>
              </div>
            </div>
            <!-- import backup -->



            <!-- Delete All Data -->

            <div class="card shadow-sm mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                  <i class='bi bi-database-dash m-1'></i> حذف بيانات البرنامج
              </div>
              <div class="card-body">
                <h6 class="h6 mb-4">هذا الاجراء في <b class="text-danger">غاية الخطورة </b>, بعد الضغط على زر الحذف لا يمكنك استعادة اي من البيانات التي قمت باضافتها الى النظام, لذا تأكد جيداً من انك قمت بتحميل كل من : </h6>
                <ul>
                  <li>جميع ملفات Microsoft excel على جهازك</li>
                  <li>ملف النسخ الاحتياطي لقاعدة البيانات</li>
                </ul>
                <form method="post">
                  <h6 class="h6 mt-4 mb-0"><b>لاكمال الاجراء اكتب كلمة السر الخاصة بك <?= Session::get('username') ?> :</b></h6>
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="password"></label>
                        <input type="password" id="password" class="form-control form-control" name="password" placeholder="كلمة السر" />
                      </div>
                    </div>
                  </form>
                <hr>
                <div class="d-flex justify-content-end">
                    <button id="deleteDatabase" class="btn btn-danger ml-2" title="حذف قاعدة البيانات">
                      <i class="bi bi-trash-fill mx-1"></i>
                        حذف كل البيانات
                    </button>
                  </div>
              </div>
            </div>


            <!-- Delete All Data -->
             
        </div>
 </div>
<?php Component::footer();?>
<script src="<?=$js?>alertify.min.js"></script>
<script src="<?=$js?>saveSettings.js"></script>