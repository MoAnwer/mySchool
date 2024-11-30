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

  Component::header(['title' => 'حسابات - الاقساط المسددة' . $stageName]);
  
  $db = DB::connection();
  
  $paidInstalls = $db->query(
      "SELECT
        s.stage as stage,
        SUM(i.paid_1) AS paid1,
        SUM(i.paid_2) AS paid2,
        SUM(i.paid_3) AS paid3,
        SUM(i.paid_4) AS paid4,
        SUM(i.paid_5) AS paid5,
        SUM(i.paid_6) AS paid6,
        SUM(i.paid_1 + i.paid_2 + i.paid_3 + i.paid_4 + i.paid_5 + i.paid_6) AS totalOfPaids,
        COUNT(s.id) as studentCount
      FROM
          students s
      INNER JOIN
        installments i
        ON
          s.id = i.student_id
      WHERE
          s.stage LIKE '%$stageName%'
      "
    )->fetch(PDO::FETCH_OBJ);
  
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
                <h1 class="h3 mb-0 text-gray-800">حسابات <?= $stageName?> - اجمالي الاقساط المسددة </h1>
            </div>

             <div class="mb-4">
                <div class="card shadow-sm border-left-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                    عدد الطلاب 
                                </div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $paidInstalls->studentCount ?? 0?> طالب</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people-fill fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm mb-3">
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
                        <td><?=number_format($paidInstalls->paid1) ?> جنية</td>
                        <td><?=number_format($paidInstalls->paid2) ?> جنية</td>
                        <td><?=number_format($paidInstalls->paid3) ?> جنية</td>
                        <td><?=number_format($paidInstalls->paid4) ?> جنية</td>
                        <td><?=number_format($paidInstalls->paid5) ?> جنية</td>
                        <td><?=number_format($paidInstalls->paid6) ?> جنية</td>
                        <td><?=number_format($paidInstalls->totalOfPaids) ?> جنية</td>
                      </tr>
                  </tbody>
                </table>
              </div>

            </div>

          </div> 
        
      </div> 
    
    </div> 

 </div>

<?php Component::footer();?>