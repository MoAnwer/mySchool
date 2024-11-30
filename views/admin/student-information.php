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

  $stageName = $stages[$stageId];

  Component::header(['title' => "تلاميذ ال" . $stageName ]);

  if(!in_array($stageId, array_keys($stages))) {

    abort(404);

  }
  
  $studentObj = new Student();

  $data = $studentObj->stagesPublicInfo($stageName);
  
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
                <h1 class="h3 mb-0 text-gray-800">تلاميذ ال<?=$stageName?> </h1>
            </div>

            <div class="card shadow-sm mb-4 p-3">
              
            <div class="table-responsive p-3">
                <table class="table text-center table-striped" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>الطالب</th>
                          <th>الاستمارة</th>
                          <th>تاريخ ملئها</th>
                          <th>الصف</th>
                          <th>ولي الأمر</th>
                          <th>القرابة</th>
                          <th>المهنة</th>
                          <th>هاتف 1</th>
                          <th>هاتف 2</th>
                          <th>واتساب</th>
                          <th>اجراءات</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                    <?php foreach($data as $student) :?>
                      <tr>
                        <td><?=$student->fullName?></td>
                        <td><?=$student->enrollNumber?></td>
                        <td><?=$student->enrollDate?></td>
                        <td><?=$student->class?></td>
                        <td><?=$student->guardian?></td>
                        <td><?=$student->guardianCopula?></td>
                        <td><?=$student->guardianCareer?></td>
                        <td><?=$student->phoneOne?></td>
                        <td><?=$student->phoneTwo?></td>
                        <td><?=$student->whatsappPhone?></td>
                        <td>
                          <a href="http://myschool.great-site.net/views/admin/student-details?id=<?=$student->id?>" class="btn btn-primary btn-circle btn-sm">
                            <i class="bi bi-eye-fill"></i>
                          </a>
                          <a href="http://myschool.great-site.net/views/admin/edit-student?id=<?=$student->id?>" class="btn btn-success btn-circle btn-sm">
                            <i class="bi bi-pen-fill"></i>
                          </a>
                          <a href="http://myschool.great-site.net/views/admin/delete-student?id=<?=$student->id?>" class="btn btn-danger btn-circle btn-sm">
                            <i class="bi bi-trash-fill"></i>
                          </a>
                        </td>
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
  <script src="<?=$js?>boot.table.js"></script>
  <script src="<?=$js?>table.js"></script>
  <script src="<?=$js?>alertify.min.js"></script>
  <script src="<?=$js?>alertify.custom.js"></script>