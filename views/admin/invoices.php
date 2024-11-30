<?php

  require_once '../../init.php';
  $dots = '../../';

  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  Component::header(['title' => "الايصالات"]);

  $db = DB::connection();
  
  $invoices = $db->query("SELECT i.*, s.enrollNumber, s.stage, s.class, s.whatsappPhone, s.phoneOne, s.phoneTwo FROM invoices i INNER JOIN students s on s.id = i.student_id", 5)->fetchAll();
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
                <h1 class="h3 mb-0 text-gray-800">الايصالات</h1>
            </div>

            <div class="card shadow mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                تفاصيل الايصالات 
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center table-bordered" id="dataTable" cellspacing="0">
                  <thead class="table-dark">
                    <tr>
                      <th>رقم الايصال</th>
                      <th>الطالب</th>
                      <th>رقم الاستمارة</th>
                      <th>المرحلة</th>
                      <th>الصف</th>
                      <th>رقم القسط</th>
                      <th>المدفوع</th>
                      <th>صورة الايصال</th>
                      <th>هاتف 1</th>
                      <th>هاتف 2</th>
                      <th>واتساب</th>
                      <th>تاريخ الاستخراج</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($invoices as $invoice) :?>
                      <tr>
                        <td><?=$invoice->id?></td>
                        <td><?=$invoice->student?></td>
                        <td><?=$invoice->enrollNumber?></td>
                        <td><?=$invoice->stage?></td>
                        <td><?=$invoice->class?></td>
                        <td><?=$invoice->installNumber?></td>
                        <td><?=number_format($invoice->paid)?> جنية</td>
                        <td class="p-0">
                          <a href="http://myschool.great-site.net/uploads/<?=$invoice->image?>" class="p-0">
                            <img src="http://myschool.great-site.net/uploads/<?=$invoice->image?>" width="50" alt="<?=$invoice->image?>">
                          </a>  
                        </td>
                        <td><?=$invoice->phoneOne?></td>
                        <td><?=$invoice->phoneTwo?></td>
                        <td><?=$invoice->whatsappPhone?></td>
                        <td dir="ltr"><?=$invoice->create_at?></td>
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