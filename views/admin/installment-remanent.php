<?php

  require_once '../../init.php';
  
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();

  $targetInstall = filter($_GET['i'] ?? 1, 'int');

  $installs = [1, 2, 3, 4, 5, 6];

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
    'title' => 'متبقي القسط ' . $installsNames[$targetInstall],
    'cssFile' => null,
  ]);

  
  
  $db = DB::connection();

  $remanentData = $db->query(
    "SELECT 
      s.fullName AS student,
      s.enrollNumber AS enrollNumber,
      s.phoneOne AS phoneOne, 
      s.phoneTwo AS phoneTwo,
      s.whatsappPhone AS whatsappPhone,
      i.install_$targetInstall AS install,
      i.paid_$targetInstall AS paid,
      i.install_$targetInstall - i.paid_$targetInstall AS remanent
    FROM 
      students s
    INNER JOIN
      installments i
    ON 
      s.id = i.student_id
    WHERE 
      i.paid_$targetInstall < i.install_$targetInstall
    AND 
      s.stage = '$stageName'
    GROUP BY 
      s.id
    "
  , 5)->fetchAll();

  
  $installTotal = $db->query(
    "SELECT 
      SUM(i.paid_$targetInstall) AS totalOfPaids,
      SUM(i.install_$targetInstall) AS totalMoney,
      SUM(i.install_$targetInstall - i.paid_$targetInstall) AS totalOfRemanent,
      COUNT(i.student_id) AS studentCount
    FROM 
      students s
    INNER JOIN
      installments i
    ON 
      s.id = i.student_id
    WHERE 
      i.paid_$targetInstall < i.install_$targetInstall
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
                <h1 class="h3 mb-0 text-gray-800">  متبقي القسط <?=$installsNames[$targetInstall]?> - <?=$stageName?></h1>
            </div>

            <div class="row">

              <div class="mb-4 col-12 col-lg-3">
                <?php 
                    Component::infoCard([
                      'borderPosition' => 'left',
                      'classess' => 'shadow-sm',
                      'borderColor' => 'primary',
                      'cardTitle' => 'عدد طلاب ' . $stageName,
                      'mainContent' => $installTotal->studentCount . ' طالب ',
                      'icon' => 'people-fill'
                    ])
                  ?>
              </div>

              <div class="mb-4 col-12 col-lg-3">
                <?php 
                    Component::infoCard([
                      'borderPosition' => 'left',
                      'classess' => 'shadow-sm',
                      'borderColor' => 'primary',
                      'cardTitle' => ' اجمالي المطلوب',
                      'mainContent' => number_format($installTotal->totalMoney) . ' جنية ',
                      'icon' => 'cash'
                    ])
                  ?>
              </div>

              <div class="mb-4 col-12 col-lg-3">
                <?php 
                    Component::infoCard([
                      'borderPosition' => 'left',
                      'classess' => 'shadow-sm',
                      'borderColor' => 'primary',
                      'cardTitle' => ' اجمالي المدفوع',
                      'mainContent' => number_format($installTotal->totalOfPaids) . ' جنية ',
                      'icon' => 'wallet'
                    ])
                  ?>
              </div>

              <div class="mb-4 col-12 col-lg-3">
                <?php 
                    Component::infoCard([
                      'borderPosition' => 'left',
                      'classess' => 'shadow-sm',
                      'borderColor' => 'primary',
                      'cardTitle' => ' اجمالي المتبقي ',
                      'mainContent' => number_format($installTotal->totalOfRemanent) . ' جنية ',
                      'icon' => 'cash-coin'
                    ])
                  ?>
              </div>

          </div>
            
            <div class="card shadow mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                 الطلاب الذين لديهم بقية اقساط غير مدفوعة
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center table-striped" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>الطالب</th>
                          <th>الإستمارة</th>
                          <th>قيمة القسط</th>
                          <th>المبلغ المدفوع</th>
                          <th>المتبقي</th>
                          <th>هاتف 1</th>
                          <th>هاتف 2</th>
                          <th>واتساب</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                    <?php foreach ($remanentData as $remanent) :?>
                      <tr>
                        <td><?=$remanent->student?></td>
                        <td><?=$remanent->enrollNumber?></td>
                        <td><?=number_format($remanent->install)?> جنية</td>
                        <td><span class="<?=$remanent->paid > 0 ?: 'badge-pill py-1 badge badge-danger'?>">
                          <?=number_format($remanent->paid)?>
                          جنية 
                        </span></td>
                        <td><?=number_format($remanent->remanent)?> جنية</td>
                        <td><?=$remanent->phoneOne?></td>
                        <td><?=$remanent->phoneTwo?></td>
                        <td><?=$remanent->whatsappPhone?></td>
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