<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();

  $targetInstall = isset($_GET['i']) && !empty($_GET['i']) ? htmlspecialchars(intval($_GET['i'])) : false;

  $installs = [1, 2, 3, 4, 5, 6];

  if(!in_array($targetInstall, $installs)) {
    echo "<h1> هذا القسط غير موجود </h1>";
    exit(404);
  }

  $installsNames = [
    1 => 'الاول',
    'الثاني',
    'الثالث',
    'الرابع',
    'الخامس',
    'السادس',
  ];

    
  $stageId = filter($_GET['s'] ?? 1, 'int');

  $stages = [
    1 => 'رياض',
    2 => 'ابتدائي',
    3 => 'متوسط',
    4 => 'ثانوي'
  ];

  if(!in_array($stageId, array_keys($stages))) {

    abort(404);

  }

  $stageName = $stages[$stageId];
  
  Component::header([
    'title' => 'متأخرات القسط ' . $installsNames[$targetInstall],
    'cssFile' => null,
  ]);
  
  $db = DB::connection();

  $arrearsDate  = $db->query(
    "SELECT 
      s.fullName AS student,
      s.enrollNumber AS enrollNumber,
      s.phoneOne AS phoneOne, 
      s.phoneTwo AS phoneTwo,
      s.whatsappPhone AS whatsappPhone,
      i.install_$targetInstall AS install,
      i.installDate_$targetInstall AS dueDate,
      i.paid_$targetInstall AS paid,
      SUM(i.install_$targetInstall) AS total,
      COUNT(i.student_id) AS studentCount
    FROM 
      students s
    INNER JOIN
      installments i
    ON 
      s.id = i.student_id
    WHERE 
      NOW() > i.installDate_$targetInstall
    AND
      i.paid_$targetInstall = 0
    AND 
    s.stage = '$stageName'
    GROUP BY 
      s.id
    "
  , 5)->fetchAll();
  
  $installTotal = $db->query(
      "SELECT 
        s.stage AS stage,
        SUM(i.install_$targetInstall) AS totalOfInstall,
        COUNT(i.student_id) AS count
      FROM 
        students s
      INNER JOIN
        installments i
      ON 
        s.id = i.student_id
      WHERE 
        NOW() > i.installDate_$targetInstall
      AND
        i.paid_$targetInstall = 0
      AND 
        s.stage = '$stageName'
      "
    , 5)->fetch();

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
                <h1 class="h3 mb-0 text-gray-800"><?=$stageName ?> - متأخرات القسط <?=$installsNames[$targetInstall]?></h1>
            </div>

            <div class="row">
              <div class="mb-4 col-12 col-lg-6">
                  <div class="card shadow-sm border-left-primary">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                      عدد الطلاب المتاخرين
                                  </div>
                                  <div class="h3 mb-0 font-weight-bold text-gray-800"><?=$installTotal->count?></div>
                              </div>
                              <div class="col-auto">
                                  <i class="bi bi-people fa-2x text-primary"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="mb-4 col-12 col-lg-6">
                  <div class="card shadow-sm border-left-primary">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                      اجمالي المطلوب  
                                  </div>
                                  <div class="h3 mb-0 font-weight-bold text-gray-800"><?=number_format($installTotal->totalOfInstall)?> جنية</div>
                              </div>
                              <div class="col-auto">
                                  <i class="bi bi-cash fa-2x text-primary"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                المتاخرين عن السداد
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center table-striped" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>الطالب</th>
                          <th>الإستمارة</th>
                          <th>قيمة القسط</th>
                          <th>المبلغ المدفوع</th>
                          <th>تاريخ استحقاقة</th>
                          <th>هاتف 1</th>
                          <th>هاتف 2</th>
                          <th>واتساب</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                    <?php foreach ($arrearsDate as $arrear) :?>
                      <tr>
                        <td><?=$arrear->student?></td>
                        <td><?=$arrear->enrollNumber?></td>
                        <td><?=number_format($arrear->install)?> جنية</td>
                        <td><?=number_format($arrear->paid)?> جنية</td>
                        <td ><span class="badge-pill py-1 badge badge-danger"><?=$arrear->dueDate?></span></td>
                        <td><?=$arrear->phoneOne?></td>
                        <td><?=$arrear->phoneTwo?></td>
                        <td><?=$arrear->whatsappPhone?></td>
                      </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>

            </div>
        </div> 
        
      </div> 
    
    </div> 

 </div>

<?php Component::footer();?>
<script src="<?=$js?>j.table.js"></script>
<script src="<?=$js?>table.js"></script>
<script src="<?=$js?>boot.table.js"></script>