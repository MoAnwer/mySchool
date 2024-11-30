<?php

    require_once '../../init.php';
    $dots = '../../';

    
    $css = $dots . $css;
    $js = $dots . $js;
    $tpl = $dots . $tpl;
    
    User::authCheck() && User::isSuperAdmin() ? true : header('location: http://myschool.great-site.net/views/admin/reports');
    
    Component::header([
        'title' => 'لوحة التحكم',
        'cssFile' => null,
    ]);

    // admin list
    $admins = (new User())->getAdmins();

    // for backup remante
    $backupLastModified = date('d', filemtime('../../backup/database_backup.sql'));
    $daysRange = abs(date('d') - $backupLastModified);
    // for excel backup remante
    $excelDaysRange = 0;

    if (file_exists('../../uploads/exports/اجمالي_مدفوعات_المدرسة_عام_'. date('Y') .'.xlsx')) {
        $excelLastModified = date('d', filemtime('../../uploads/exports/اجمالي_مدفوعات_المدرسة_عام_'. date('Y') .'.xlsx'));
        $excelDaysRange = abs(date('d') - $excelLastModified);
    }
    $remend = false;
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
                <h1 class="h3 mb-0 text-gray-800">لوحة التحكم</h1>
            </div>
            
            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                        ارباح الشهر للرياض</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=number_format((new Invoice())->getEarningsMonthFor('رياض'))?> جنية</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                        ارباح الشهر الابتدائي</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?=number_format((new Invoice())->getEarningsMonthFor('ابتدائي'))?> جنية
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #2a282f -->

                

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                        ارباح الشهر للمتوسط</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?=number_format((new Invoice())->getEarningsMonthFor('متوسط'))?> جنية
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow-sm h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                        ارباح الشهر للثانوي</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?=number_format((new Invoice())->getEarningsMonthFor('ثانوي'))?>  جنية
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Charts -->
                <div class="row">
                    <div class="col-lg-5 col-md-12 col-12">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header py-3 m-0 font-weight-bold text-primary">
                                <i class="bi bi-bar-chart-steps ml-1"></i>
                                اجمالي مدفوعات عام <?= date('Y') ?>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="yearChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header py-3 m-0 font-weight-bold text-primary">
                                <i class="bi bi-bar-chart ml-1"></i>
                                مدفوعات شهر <?=monthName(date('m'))?>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                 <div class="col-lg-3 col-md-12 col-12">
                    <div class="card shadow-sm mb-3">
                        <div class="card-header py-3 m-0 font-weight-bold text-primary">
                            <i class="bi bi-pie-chart ml-1"></i>
                            احصائيات البيانات المالية
                        </div>
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="ml-2">
                                    <i class="fas fa-circle text-primary ml-1 mr-0"></i> 
                                    الرسوم المقررة
                                </span>
                                <span class="ml-2">
                                    <i class="fas fa-circle text-success ml-1 mr-0"></i> 
                                    مدفوعات
                                </span>
                                <span class="ml-2">
                                    <i class="fas fa-circle text-danger ml-1 mr-0"></i> 
                                    المتاخرات
                                </span>
                                <span class="ml-2">
                                    <i class="fas fa-circle text-warning ml-1 mr-0"></i> 
                                    المتبقي
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Charts -->
  
            <!-- Users -->
             <div class="row">
                 <div class="col-lg-5 col-md-12 col-12 mb-1">  
                     <div class="card shadow-sm">
                        <div class="card-header py-3 m-0 font-weight-bold text-primary">
                             <i class="bi bi-bell-fill ml-1"></i> تذكير 
                        </div>
                        <div class="card-body p-3">
                            <?php if ($daysRange >= 7) : $remend = true;?>
                            <div class="border shadow-sm mb-2 p-3 rounded d-flex align-items-center w-100">
                                <div class="ml-4 border-left pl-3 pr-2">
                                    <i class="bi bi-database-fill-check text-primary h5 mb-0"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center  w-100">
                                    <span class="h6 mb-0 text-dark">
                                        مرت 
                                        <b><?= $daysRange <= 10 ? $daysRange . ' ايام' : $daysRange . ' يوم'?></b>    
                                        منذ اخر عملية نسخ احتياطي 
                                    </span>
                                    <a href="settings#newBackup" class="btn btn-outline-primary">ذهاب</a>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php if ($excelDaysRange >= 10) :  $remend = true;?> 
                            <div class="border shadow-sm mb-2 p-3 rounded d-flex align-items-center w-100">
                                <div class="ml-4 border-left pl-3 pr-2">
                                    <i class="bi bi-file-excel text-primary h5 mb-0"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center  w-100">
                                    <span class="h6 mb-0 text-dark">
                                        مرت 
                                        <b><?= $excelDaysRange <= 10 ? $excelDaysRange . ' ايام' : $excelDaysRange . ' يوم'; ?></b>    
                                         منذ اخر عملية تصدير لملفات Excel 
                                    </span>
                                    <a href="settings#excel" class="btn btn-outline-primary">ذهاب</a>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php if ($remend == false): ?> 
                                <div class="text-center h6 py-4">
                                    - لا توجد تذكيرات لعرضها <i class="bi bi-bell-slash"></i> -
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <div class="card shadow-sm">
                        <div class="card-header py-2 m-0 font-weight-bold text-primary d-flex justify-content-between align-items-center">
                            <div class="title">
                                <i class="bi bi-people-fill ml-1"></i> ادارة المستخدمين 
                            </div>
                            <div class="add-new-user d-flex justify-content-end">
                                <a href="http://myschool.great-site.net/views/admin/create-user" class="btn btn-outline-primary">
                                    <i class="bi bi-person-plus-fill h5 ml-2"></i>
                                    اضافة
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="users-list">
                                <?php foreach ($admins as $admin) :?>
                                    <div class="border mb-2 shadow-sm p-3 rounded d-flex align-items-center w-100">
                                        <div class="ml-4 border-left pl-3 pr-2">
                                            <img src="../../assets/images/undraw_profile_2.svg" width="35">
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center  w-100">
                                            <span class="h6 mb-0 text-primary"><b><?=$admin->fullName?></b></span>
                                            <div class="border-right pr-2">
                                                <a title="معاينة"  href="user-details?id=<?=$admin->id?>" class="btn btn-primary btn-circle btn-sm">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a title="تعديل" href="edit-user?id=<?=$admin->id?>" class="btn btn-success btn-circle btn-sm">
                                                    <i class="bi bi-pen"></i>
                                                </a>
                                                <a title="حذف" href="delete-user?id=<?=$admin->id?>" class="btn btn-danger btn-circle btn-sm">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                             </div>
                        </div> 
                    </div>
                </div>
            <!-- Users -->

        </div>
        <!-- content -->
    </div>

 </div>

<?php Component::footer();?>
<script src="<?=$js?>Chart.min.js"></script>
<script src="<?=$js?>earningYear.js"></script>
<script src="<?=$js?>chart-pie.js"></script>
<script src="<?=$js?>barChart.js"></script>