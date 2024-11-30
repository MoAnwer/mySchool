<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
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

  Component::header(['title' => 'متبقي أقساط']);
  
  $db  = DB::connection();
  $paidInstalls = $db->query(
      "SELECT 
        s.stage AS stage,
        SUM(i.install_1) AS install1,
        SUM(i.install_2) AS install2,
        SUM(i.install_3) AS install3,
        SUM(i.install_4) AS install4,
        SUM(i.install_5) AS install5,
        SUM(i.install_6) AS install6,
        SUM(i.paid_1) AS paid1, 
        SUM(i.paid_2) AS paid2, 
        SUM(i.paid_3) AS paid3, 
        SUM(i.paid_4) AS paid4, 
        SUM(i.paid_5) AS paid5, 
        SUM(i.paid_6) AS paid6,
        COUNT(i.student_id) AS studentCount,
        SUM(i.paid_1 + i.paid_2 + i.paid_3 + i.paid_4 + i.paid_5 + i.paid_6) AS totalPaids,
        SUM(i.install_1 + i.install_2 + i.install_3 + i.install_4 + i.install_5 + i.install_6) AS totalInstalls,
        SUM(i.install_1 - i.paid_1) AS remanent1,
        SUM(i.install_2 - i.paid_2) AS remanent2,
        SUM(i.install_3 - i.paid_3) AS remanent3,
        SUM(i.install_4 - i.paid_4) AS remanent4,
        SUM(i.install_5 - i.paid_5) AS remanent5,
        SUM(i.install_6 - i.paid_6) AS remanent6
      FROM 
        installments i
      INNER JOIN 
        students s
      ON 
        s.id = i.student_id
      WHERE 
        s.stage = '$stageName'
    ", 2)->fetch();

  $totalRemanents = $paidInstalls['remanent1'] + $paidInstalls['remanent2']  + $paidInstalls['remanent3']  + $paidInstalls['remanent4']  + $paidInstalls['remanent5']  + $paidInstalls['remanent6'];
  

  $installArrearsTotal1 = $db->query("SELECT SUM(i.install_1) AS totalOfInstall FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_1 AND i.paid_1 = 0 AND s.stage = '$stageName'", 5)->fetch()->totalOfInstall;

  $installArrearsTotal2 = $db->query("SELECT SUM(i.install_2) AS totalOfInstall FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_2 AND i.paid_2 = 0 AND s.stage = '$stageName'", 5)->fetch()->totalOfInstall;

  $installArrearsTotal3 = $db->query("SELECT SUM(i.install_3) AS totalOfInstall FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_3 AND i.paid_3 = 0 AND s.stage = '$stageName'", 5)->fetch()->totalOfInstall;

  $installArrearsTotal4 = $db->query("SELECT SUM(i.install_4) AS totalOfInstall FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_4 AND i.paid_4 = 0 AND s.stage = '$stageName'", 5)->fetch()->totalOfInstall;

  $installArrearsTotal5 = $db->query("SELECT SUM(i.install_5) AS totalOfInstall FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_5 AND i.paid_5 = 0 AND s.stage = '$stageName'", 5)->fetch()->totalOfInstall;

  $installArrearsTotal6 = $db->query("SELECT SUM(i.install_6) AS totalOfInstall FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_6 AND i.paid_6 = 0 AND s.stage = '$stageName'", 5)->fetch()->totalOfInstall;


  $totalAllArrears = $installArrearsTotal1 + $installArrearsTotal2 + $installArrearsTotal3 + $installArrearsTotal4 + $installArrearsTotal5 + $installArrearsTotal6;
  
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
                <h1 class="h3 mb-0 text-gray-800"> اجمالي <?= $stageName?> - الاقساط المطلوبة و المدفوعة و المتبقية و المتاخرات</h1>
            </div>

             <div class="mb-4">
                <div class="card border-left-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-info text-uppercase mb-1">
                                    عدد طلاب ال<?= $stageName?>
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $paidInstalls['studentCount']?> طالب</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                اجمالي الأقساط المطلوبة
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>القسط الاول</th>
                          <th>القسط الثاني</th>
                          <th>القسط الثالث</th>
                          <th>القسط الرابع</th>
                          <th>القسط الخامس</th>
                          <th>القسط السادس</th>
                          <th>اجمالي المطلوب</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                      <tr>
                        <td><?=number_format($paidInstalls['install1'])?> جنية</td>
                        <td><?=number_format($paidInstalls['install2'])?> جنية</td>
                        <td><?=number_format($paidInstalls['install3'])?> جنية</td>
                        <td><?=number_format($paidInstalls['install4'])?> جنية</td>
                        <td><?=number_format($paidInstalls['install5'])?> جنية</td>
                        <td><?=number_format($paidInstalls['install6'])?> جنية</td>
                        <td><?=number_format($paidInstalls['totalInstalls'])?> جنية</td>
                      </tr>
                  </tbody>
                </table>
              </div>

            </div>
            
            <div class="card shadow mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                اجمالي الأقساط المدفوعة
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>القسط الاول</th>
                          <th>القسط الثاني</th>
                          <th>القسط الثالث</th>
                          <th>القسط الرابع</th>
                          <th>القسط الخامس</th>
                          <th>القسط السادس</th>
                          <th>اجمالي المدفوعات</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                      <tr>
                        <td><?=number_format($paidInstalls['paid1'])?> جنية</td>
                        <td><?=number_format($paidInstalls['paid2'])?> جنية</td>
                        <td><?=number_format($paidInstalls['paid3'])?> جنية</td>
                        <td><?=number_format($paidInstalls['paid4'])?> جنية</td>
                        <td><?=number_format($paidInstalls['paid5'])?> جنية</td>
                        <td><?=number_format($paidInstalls['paid6'])?> جنية</td>
                        <td><span class="badge-pill badge-success"><?=number_format($paidInstalls['totalPaids'])?> جنية </span></td>
                      </tr>
                  </tbody>
                </table>
              </div>

            </div>
            
            <div class="card shadow mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                اجمالي متبقي الاقساط
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>القسط الاول</th>
                          <th>القسط الثاني</th>
                          <th>القسط الثالث</th>
                          <th>القسط الرابع</th>
                          <th>القسط الخامس</th>
                          <th>القسط السادس</th>
                          <th>اجمالي المتبقي</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                      <tr>
                        <td><?=number_format($paidInstalls['remanent1'])?> جنية</td>
                        <td><?=number_format($paidInstalls['remanent2'])?> جنية</td>
                        <td><?=number_format($paidInstalls['remanent3'])?> جنية</td>
                        <td><?=number_format($paidInstalls['remanent4'])?> جنية</td>
                        <td><?=number_format($paidInstalls['remanent5'])?> جنية</td>
                        <td><?=number_format($paidInstalls['remanent6'])?> جنية</td>
                        <td><?=number_format($totalRemanents)?> جنية</td>
                      </tr>
                  </tbody>
                </table>
              </div>

            </div>



            <!-- Arrears -->


            <div class="card shadow mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                اجمالي المتأخرات
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>القسط الاول</th>
                          <th>القسط الثاني</th>
                          <th>القسط الثالث</th>
                          <th>القسط الرابع</th>
                          <th>القسط الخامس</th>
                          <th>القسط السادس</th>
                          <th>اجمالي المتأخرات</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                      <tr>
                        <td><?=number_format($installArrearsTotal1)?> جنية</td>
                        <td><?=number_format($installArrearsTotal2)?> جنية</td>
                        <td><?=number_format($installArrearsTotal3)?> جنية</td>
                        <td><?=number_format($installArrearsTotal4)?> جنية</td>
                        <td><?=number_format($installArrearsTotal5)?> جنية</td>
                        <td><?=number_format($installArrearsTotal6)?> جنية</td>
                        <td>
                          <span class="badge-pill badge-danger">
                            <?=number_format($totalAllArrears)?> جنية
                          </span>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>

            </div>


            <!-- Arrears -->

        </div> 
        
      </div> 
    
    </div> 

 </div>

<?php Component::footer();?>