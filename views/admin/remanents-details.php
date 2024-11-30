<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  Component::header([
    'title' => 'متبقي اقساط مفصل',
    'cssFile' => null,
  ]);

  $db = DB::connection();

  $studentRemanents = $db->query(
      "SELECT  
        s.fullName AS student,
        s.enrollNumber AS enrollNumber,
        i.install_1 - i.paid_1 AS remanent1,
        i.install_2 - i.paid_2 AS remanent2,
        i.install_3 - i.paid_3 AS remanent3,
        i.install_4 - i.paid_4 AS remanent4,
        i.install_5 - i.paid_5 AS remanent5,
        i.install_6 - i.paid_6 AS remanent6
      FROM 
        students s
      INNER JOIN
        installments i
      ON 
        i.student_id = s.id
      WHERE
        i.install_1 - i.paid_1 > 0 AND i.install_2 - i.paid_2 > 0 AND i.install_3 - i.paid_3 > 0 AND i.install_4 - i.paid_4 > 0 AND i.paid_5 > 0 AND i.paid_6 > 0
      GROUP BY
      s.id
      "
    , 5)->fetchAll();

  $totalRemanents = $db->query(
      "SELECT  
        SUM(i.install_1 - i.paid_1) AS totalRemanent1, 
        SUM(i.install_2 - i.paid_2) AS totalRemanent2, 
        SUM(i.install_3 - i.paid_3) AS totalRemanent3, 
        SUM(i.install_4 - i.paid_4) AS totalRemanent4, 
        SUM(i.install_5 - i.paid_5) AS totalRemanent5, 
        SUM(i.install_6 - i.paid_6) AS totalRemanent6
      FROM 
        students s
      INNER JOIN
        installments i
      ON 
        i.student_id = s.id
      "
    , 5)->fetch();

    $totalMoney = $totalRemanents->totalRemanent1 + $totalRemanents->totalRemanent2 + $totalRemanents->totalRemanent3 + $totalRemanents->totalRemanent4 + $totalRemanents->totalRemanent5 + $totalRemanents->totalRemanent6;

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
            <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">  المسددة </h1>
            </div> -->

                      <!-- Total -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 font-weight-bold text-primary">
               اجمالي متبقي الاقساط
            </div>
            
            <div class="row p-3">              
              <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary  h-100 py-1">
                      <div class="card-body">
                          <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <div class="text-s font-weight-bold text-primary text-uppercase mb-2">
                                       القسط الاول :</div>
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($totalRemanents->totalRemanent1)?> جنية</div>
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
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($totalRemanents->totalRemanent2)?> جنية</div>
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
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?=number_format($totalRemanents->totalRemanent3)?> جنية</div>
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
                                  <div class="h4 mb-0 font-weight-bold text-gray-800"><?=number_format($totalRemanents->totalRemanent4)?> جنية</div>
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
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?=number_format($totalRemanents->totalRemanent5)?> جنية</div>
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
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($totalRemanents->totalRemanent6)?> جنية</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cash fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
              </div>

              <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary  h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-2">
                                  المجموع </div>
                                <div class="h4 mb-0 font-weight-bold text-gray-800"><?=number_format($totalMoney)?> جنية</div>
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
                متبقي اقساط الطلاب
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center table-striped" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>الطالب</th>
                          <th>الإستمارة</th>
                          <th>متبقي القسط الاول</th>
                          <th>متبقي القسط الثاني</th>
                          <th>متبقي القسط الثالث</th>
                          <th>متبقي القسط الرابع</th>
                          <th>متبقي القسط الخامس</th>
                          <th>متبقي القسط السادس</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                    <?php foreach ($studentRemanents as $remants) :?>
                        <tr>
                          <td><?=$remants->student?></td>
                          <td><?=$remants->enrollNumber?></td>
                          <td><?=$remants->remanent1 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $remants->remanent1 . '<span>' : number_format($remants->remanent1)?> جنية</td>
                          <td><?=$remants->remanent2 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $remants->remanent2 . '<span>' : number_format($remants->remanent2)?> جنية</td>
                          <td><?=$remants->remanent3 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $remants->remanent3 . '<span>' : number_format($remants->remanent3)?> جنية</td>
                          <td><?=$remants->remanent1 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $remants->remanent1 . '<span>' : number_format($remants->remanent1)?> جنية</td>
                          <td><?=$remants->remanent5 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $remants->remanent5 . '<span>' : number_format($remants->remanent5)?> جنية</td>
                          <td><?=$remants->remanent6 == 0 ? '<span class="badge-pill py-1 badge badge-danger">' . $remants->remanent6 . '<span>' : number_format($remants->remanent6)?> جنية</td>
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