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

  
  Component::header(['title' => 'حسابات مفصلة']);

  $db = DB::connection();

  $paids = $db->query(
      "SELECT  
        s.stage as stage,
        SUM(i.total) AS total, 
        SUM(i.paid_1) AS paid1, 
        SUM(i.paid_2) AS paid2, 
        SUM(i.paid_3) AS paid3, 
        SUM(i.paid_4) AS paid4, 
        SUM(i.paid_5) AS paid5, 
        SUM(i.paid_6) AS paid6,
        SUM(i.paid_1 + i.paid_2 + i.paid_3 + i.paid_4 + i.paid_5 + i.paid_6) AS totalOfPaids
      FROM
        students s
      INNER JOIN
        installments i
        ON
          s.id = i.student_id
      WHERE
          s.stage LIKE '%$stageName%'
      "
    , 5)->fetch();


    $remanent = number_format($paids->total - $paids->totalOfPaids);

    $installmentsPaids = $db->query(
        "SELECT 
          s.fullName AS student,
          s.enrollNumber AS enroll, 
          s.enrollDate AS enrollDate,
          s.class AS class,
          s.stage AS stage,
          SUM(i.total) AS total, 
          SUM(i.paid_1) AS paid1, 
          SUM(i.paid_2) AS paid2, 
          SUM(i.paid_3) AS paid3, 
          SUM(i.paid_4) AS paid4, 
          SUM(i.paid_5) AS paid5, 
          SUM(i.paid_6) AS paid6
        FROM 
          students s
        INNER JOIN 
          installments i
        ON 
          s.id = i.student_id
        WHERE 
          s.stage = '$stageName'
        GROUP BY s.fullName
      ", 5)->fetchAll();
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
                <h1 class="h3 mb-0 text-gray-800">  حسابات <?= $stageName ?> مفصلة </h1>
            </div>

                      <!-- Total -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 font-weight-bold text-primary">
               اجمالي المدفوعات المالية و الرسوم و المتبقي  
            </div>
            
            <div class="row p-3">              

              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary  h-100 py-1">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-s font-weight-bold text-primary text-uppercase mb-2">
                                       القسط الاول :</div>
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($paids->paid1)?> جنية</div>
                              </div>
                              <div class="col-auto">
                                  <i class="bi bi-cash fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary  h-100 py-1">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-s font-weight-bold text-primary text-uppercase mb-2">
                                       القسط الثاني :</div>
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($paids->paid2)?> جنية</div>
                              </div>
                              <div class="col-auto">
                                  <i class="bi bi-cash fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary  h-100 py-1">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-s font-weight-bold text-primary text-uppercase mb-2">
                                       القسط الثالث :</div>
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($paids->paid3)?> جنية</div>
                              </div>
                              <div class="col-auto">
                                  <i class="bi bi-cash fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary  h-100 py-1">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-s font-weight-bold text-primary text-uppercase mb-2">
                                       القسط الرابع :</div>
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($paids->paid4)?> جنية</div>
                              </div>
                              <div class="col-auto">
                                  <i class="bi bi-cash fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary  h-100 py-1">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-2">
                                 القسط الخامس :</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($paids->paid5)?> جنية</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash fa-2x text-gray-300"></i>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary  h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-2">
                                     القسط السادس :</div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($paids->paid6)?> جنية</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-warning  h-100 py-1">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-s font-weight-bold text-warning text-uppercase mb-2">
                                       الرسوم المقررة :</div>
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($paids->total)?> جنية</div>
                              </div>
                              <div class="col-auto">
                                  <i class="bi bi-cash fa-2x text-gray-300"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success  h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-success text-uppercase mb-2">
                                  المدفوع  :
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($paids->totalOfPaids)?> جنية</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-xl-12 col-md-6 mb-4">
                <div class="card border-left-danger  h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-danger text-uppercase mb-2">
                                   المتبقي  :
                                </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $remanent?> جنية</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

              </div>

             </div>

          </div>

            <div class="card shadow mb-4">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                حالة مدفوعات الطلاب
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center table-striped" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>الطالب</th>
                          <th>الإستمارة</th>
                          <th>تاريخ ملئها</th>
                          <th>الصف</th>
                          <th>المرحلة</th>
                          <th>الرسوم المقررة</th>
                          <th>القسط الاول</th>
                          <th>القسط الثاني</th>
                          <th>القسط الثالث</th>
                          <th>القسط الرابع</th>
                          <th>القسط الخامس</th>
                          <th>القسط السادس</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                    <?php foreach ($installmentsPaids as $paidInfo) :?>
                        <tr>
                          <td><?=$paidInfo->student?></td>
                          <td><?=$paidInfo->enroll?></td>
                          <td><?=$paidInfo->enrollDate?></td>
                          <td><?=$paidInfo->class?></td>
                          <td><?=$paidInfo->stage?></td>
                          <td><?=number_format($paidInfo->total)?> جنية</td>
                          <td><?=$paidInfo->paid1 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $paidInfo->paid1 . '<span>' : number_format($paidInfo->paid1)?> جنية</td>
                          <td><?=$paidInfo->paid2 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $paidInfo->paid2 . '<span>' : number_format($paidInfo->paid2)?> جنية</td>
                          <td><?=$paidInfo->paid3 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $paidInfo->paid3 . '<span>' : number_format($paidInfo->paid3)?> جنية</td>
                          <td><?=$paidInfo->paid4 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $paidInfo->paid4 . '<span>' : number_format($paidInfo->paid4)?> جنية</td>
                          <td><?=$paidInfo->paid5 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $paidInfo->paid5 . '<span>' : number_format($paidInfo->paid5)?> جنية</td>
                          <td><?=$paidInfo->paid6 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $paidInfo->paid6 . '<span>' : number_format($paidInfo->paid6)?> جنية</td>
                        </tr>
                    <?php endforeach;?>

                  </tbody>
                  
                </table>         
                
            </div>

        </div> 
        
      </div> 
    
    </div> 

 </div>

<?php Component::footer();?>
<script src="<?=$js?>j.table.js"></script>
<script src="<?=$js?>table.js"></script>
<script src="<?=$js?>boot.table.js"></script>