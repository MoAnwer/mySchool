<?php
  require_once '../../init.php';

  $dots = '../../';
  
  $css = $dots . $css;
  $js = $dots . $js;
  $tpl = $dots . $tpl;
  
  User::authCheck() ? true : exit();
  
  Component::header([
    'title' => 'بيانات طالب',
    'cssFile' => null,
  ]);

  $id = filter($_GET['id'], 'int');
  
  $studentObj = new Student();

  $studentData = $studentObj->publicStudentInfo($id);

  if (!$studentData) {
    echo "<h3 class='text-center mt-5 h1'>لايوجد طالب</h3>";
    exit();
  }


  $installData = $studentObj->installData($id);

  $invoicesData = $studentObj->invoicesData($id);
    
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
                <h1 class="h3 mb-0 text-gray-800">بيانات طالب</h1>
            </div>

            <div class="card shadow-sm mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                <i class="bi bi-person-video2 mx-1"></i>  تفاصيل الطالب 
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>الاسم</th>
                          <th>المرحلة</th>
                          <th>الصف</th>
                          <th>اسم الحساب</th>
                          <th>كلمة السر</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                      <tr>
                        <td><?=$studentData->fullName?></td>
                        <td><?=$studentData->stage ?: 'ابتدائي'?></td>
                        <td><?=$studentData->class?></td>
                        <td><?=$studentData->accountName?></td>
                        <td><?=$studentData->password?></td>
                      </tr>
                  </tbody>
                </table>
               </div>
            </div>
            
            <!-- installments -->
            <div class="card shadow-sm mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
               <i class="bi bi-cash mx-1"></i>  تفاصيل الأقساط 
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>القسط 1</th>
                          <th>القسط 2</th>
                          <th>القسط 3</th>
                          <th>القسط 4</th>
                          <th>القسط 5</th>
                          <th>القسط 6</th>
                          <th>مجموع الأقساط</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                      <tr>
                        <td><?=number_format($installData->install_1)?> جنية</td>
                        <td><?=number_format($installData->install_2)?> جنية</td>
                        <td><?=number_format($installData->install_3)?> جنية</td>
                        <td><?=number_format($installData->install_4)?> جنية</td>
                        <td><?=number_format($installData->install_5)?> جنية</td>
                        <td><?=number_format($installData->install_6)?> جنية</td>
                        <td><?=number_format($installData->totalofInstalls)?> جنية</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>     

            <!-- paid -->
            <div class="card shadow-sm mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                <i class="bi bi-wallet-fill mx-1"></i>  تفاصيل مدفوعات الأقساط 
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>مدفوع القسط 1</th>
                          <th>مدفوع القسط 2</th>
                          <th>مدفوع القسط 3</th>
                          <th>مدفوع القسط 4</th>
                          <th>مدفوع القسط 5</th>
                          <th>مدفوع القسط 6</th>
                          <th>مجموع مدفوعات الأقساط</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                      <tr>
                        <td><?=number_format($installData->paid_1)?> جنية</td>
                        <td><?=number_format($installData->paid_2)?> جنية</td>
                        <td><?=number_format($installData->paid_3)?> جنية</td>
                        <td><?=number_format($installData->paid_4)?> جنية</td>
                        <td><?=number_format($installData->paid_5)?> جنية</td>
                        <td><?=number_format($installData->paid_6)?> جنية</td>
                        <td><?=number_format($installData->totalofPaids)?> جنية</td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>  
            
            <!-- invoices -->
            <div class="card shadow-sm mb-3">
              <div class="card-header py-3 m-0 font-weight-bold text-primary">
                <i class="bi bi-files"></i> تفاصيل الايصالات 
              </div>
              <div class="table-responsive p-3">
                <table class="table text-center" id="dataTable" cellspacing="0">
                  <thead class="table-dark table-bordered">
                      <tr>
                          <th>رقم الايصال</th>
                          <th>القسط</th>
                          <th>المدفوع</th>
                          <th>الصورة</th>
                          <th>تاريخه</th>
                      </tr>
                  </thead>
                  <tbody class="table-bordered">
                    <?php foreach ($invoicesData as $invoices) :?>
                      <tr>
                        <td><?=number_format($invoices->id)?></td>
                        <td><?=$invoices->installNumber?></td>
                        <td><?=number_format($invoices->paid)?> جنية</td>
                        <td class="p-0">
                          <a href="http://myschool.great-site.net/uploads/<?=$invoices->image?>">
                            <img src="http://myschool.great-site.net/uploads/<?=$invoices->image?>" width="50" alt="<?=$invoices->image?>">
                          </a>    
                        </td>
                        <td><?=date('H:i:sa Y/m/d', strtotime($invoices->create_at))?></td>
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