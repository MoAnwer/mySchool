<?php

  require_once "../init.php";
  $dots = '../';

  Session::has('isLogged') && Session::has('user') ?: abort(403);

  // extract student id form username => `student_{id}`
  $studentID = explode('_', Session::get('username'))[1];

  $student = (new Student())->find($studentID);

  Component::header([
    'title' => $student->fullName,
    'bodyClass' => 'bg-gradient-primary'
  ]);

  $installs = DB::connection()->query(
    "SELECT 
      total AS total,
      install_1 AS install1,
      install_2 AS install2,
      install_3 AS install3,
      install_4 AS install4,
      install_5 AS install5,
      install_6 AS install6
    FROM 
      installments
    WHERE
    student_id = $studentID
    "
  , 5)->fetch();

  $paids = DB::connection()->query(
    "SELECT 
      SUM(paid_1 + paid_2 + paid_3 + paid_4 + paid_5 + paid_6) AS paidsTotal,
      paid_1 AS paid1,
      paid_2 AS paid2,
      paid_3 AS paid3,
      paid_4 AS paid4,
      paid_5 AS paid5,
      paid_6 AS paid6
    FROM 
      installments
    WHERE
    student_id = $studentID
    "
  , 5)->fetch();


  $invoicesData = DB::connection()->query("SELECT * FROM invoices WHERE student_id = $studentID ", 5)->fetchAll();


  $arrear1 = DB::connection()->query("SELECT SUM(i.install_1) AS arrear FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_1 AND i.paid_1 = 0 AND s.id = $studentID", 5)->fetch()->arrear;

  $arrear2 = DB::connection()->query("SELECT SUM(i.install_2) AS arrear FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_2 AND i.paid_2 = 0 AND s.id = $studentID", 5)->fetch()->arrear;

  $arrear3 = DB::connection()->query("SELECT SUM(i.install_3) AS arrear FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_3 AND i.paid_3 = 0 AND s.id = $studentID", 5)->fetch()->arrear;

  $arrear4 = DB::connection()->query("SELECT SUM(i.install_4) AS arrear FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_4 AND i.paid_4 = 0 AND s.id = $studentID", 5)->fetch()->arrear;

  $arrear5 = DB::connection()->query("SELECT SUM(i.install_5) AS arrear FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_5 AND i.paid_5 = 0 AND s.id = $studentID", 5)->fetch()->arrear;

  $arrear6 = DB::connection()->query("SELECT SUM(i.install_6) AS arrear FROM students s INNER JOIN installments i ON s.id = i.student_id WHERE NOW() > i.installDate_6 AND i.paid_6 = 0 AND s.id = $studentID", 5)->fetch()->arrear;

  $totalOfArrears = $arrear1 + $arrear2 + $arrear3 + $arrear4 + $arrear5 + $arrear6;

  $totalOfRemanent = ($installs->install1 - $paids->paid1) + ($installs->install2 - $paids->paid2) + ($installs->install3 - $paids->paid3) + ($installs->install4 - $paids->paid4) + ($installs->install5 - $paids->paid5) + ($installs->install6 - $paids->paid6);

?>

  <div class="o-hidden border-0 col-lg-11 col-sm-12 mt-4 mb-4 mx-auto p-0">
    <div class="card shadow-sm py-4 px-3 mx-2">
    <div class="d-flex flex-column align-items-center">
      <img src="../assets/images/undraw_profile_<?=$student->gender == 'بنين' ? '2' : '1'?>.svg" width="180">
      <h4 class="my-3"><span class="text-primary"><?= $student->fullName?></span> </h4>
      <span class="mb-3">الصف <?= $student->class . ' ' . $student->stage?></span>
    </div>
    
    <hr>

    <!-- Card -->
     <div class="card shadow-sm  mb-4">
        <div class="card-header py-3 m-0 font-weight-bold text-primary">
          قيمة الاقساط 
        </div>
        <div class="table-responsive p-3">
          <table class="table text-center" id="dataTable" cellspacing="0">
            <thead class="table-dark table-bordered">
                <tr>
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
              <tr>
                <td><?=number_format($installs->total)?> جنية</td>
                <td><?=number_format($installs->install1)?> جنية</td>
                <td><?=number_format($installs->install2)?> جنية</td>
                <td><?=number_format($installs->install3)?> جنية</td>
                <td><?=number_format($installs->install4)?> جنية</td>
                <td><?=number_format($installs->install5)?> جنية</td>
                <td><?=number_format($installs->install6)?> جنية</td>
              </tr>
            </tbody>
          </table>         
        </div>
      </div>
      <!-- Card -->

    <!-- Card -->
    
    <!-- Card -->
     <div class="card shadow-sm mb-4">
        <div class="card-header py-3 m-0 font-weight-bold text-primary">
          مدفوعات الاقساط 
        </div>
        <div class="table-responsive p-3">
          <table class="table text-center" id="dataTable" cellspacing="0">
            <thead class="table-dark table-bordered">
                <tr>
                  <th>مدفوع القسط الاول</th>
                  <th>مدفوع القسط الثاني</th>
                  <th>مدفوع القسط الثالث</th>
                  <th>مدفوع القسط الرابع</th>
                  <th>مدفوع القسط الخامس</th>
                  <th>مدفوع القسط السادس</th>
                  <th>اجمالي المدفوع</th>
                </tr>
            </thead>
            <tbody class="table-bordered">
              <tr>
                <td><?=number_format($paids->paid1)?> جنية</td>
                <td><?=number_format($paids->paid2)?> جنية</td>
                <td><?=number_format($paids->paid3)?> جنية</td>
                <td><?=number_format($paids->paid4)?> جنية</td>
                <td><?=number_format($paids->paid5)?> جنية</td>
                <td><?=number_format($paids->paid6)?> جنية</td>
                <td><?=number_format($paids->paidsTotal)?> جنية</td>
              </tr>
            </tbody>
          </table>         
        </div>
      </div>
      <!-- Card -->

      <!-- Card -->
     <div class="card shadow-sm  mb-4">
        <div class="card-header py-3 m-0 font-weight-bold text-primary">
          متبقي الاقساط 
        </div>
        <div class="table-responsive p-3">
          <table class="table text-center" id="dataTable" cellspacing="0">
            <thead class="table-dark table-bordered">
                <tr>
                    <th>متبقي القسط الاول</th>
                    <th>متبقي القسط الثاني</th>
                    <th>متبقي القسط الثالث</th>
                    <th>متبقي القسط الرابع</th>
                    <th>متبقي القسط الخامس</th>
                    <th>متبقي القسط السادس</th>
                    <th>اجمالي المتبقي</th>
                </tr>
            </thead>
            <tbody class="table-bordered">
              <tr>
                <td><?=number_format($installs->install1 - $paids->paid1)?> جنية</td>
                <td><?=number_format($installs->install2 - $paids->paid2)?> جنية</td>
                <td><?=number_format($installs->install3 - $paids->paid3)?> جنية</td>
                <td><?=number_format($installs->install4 - $paids->paid4)?> جنية</td>
                <td><?=number_format($installs->install5 - $paids->paid5)?> جنية</td>
                <td><?=number_format($installs->install6 - $paids->paid6)?> جنية</td>
                <td><?=number_format($totalOfRemanent)?> جنية</td>
              </tr>
            </tbody>
          </table>         
        </div>
      </div>
      <!-- Card -->


      <!-- Card -->
     <div class="card shadow-sm  mb-4">
        <div class="card-header py-3 m-0 font-weight-bold text-primary">
          متأخرات الاقساط 
        </div>
        <div class="table-responsive p-3">
          <table class="table text-center" id="dataTable" cellspacing="0">
            <thead class="table-dark table-bordered">
                <tr>
                  <th>متأخرات القسط الاول</th>
                  <th>متأخرات القسط الثاني</th>
                  <th>متأخرات القسط الثالث</th>
                  <th>متأخرات القسط الرابع</th>
                  <th>متأخرات القسط الخامس</th>
                  <th>متأخرات القسط السادس</th>
                  <th>اجمالي المتأخرات</th>
                </tr>
            </thead>
            <tbody class="table-bordered">
              <tr>
                <td><?=number_format($arrear1)?> جنية</td>
                <td><?=number_format($arrear2)?> جنية</td>
                <td><?=number_format($arrear3)?> جنية</td>
                <td><?=number_format($arrear4)?> جنية</td>
                <td><?=number_format($arrear5)?> جنية</td>
                <td><?=number_format($arrear6)?> جنية</td>
                <td><?=number_format($totalOfArrears)?> جنية</td>
              </tr>
            </tbody>
          </table>         
        </div>
      </div>
      <!-- Card -->

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
                          <a href="http://myschool.great-site.net/uploads/<?=$invoices->image?>" class="p-0">
                            <img src="http://myschool.great-site.net/uploads/<?=$invoices->image?>"  class="p-0" width="50" alt="<?=$invoices->image?>">
                          </a>    
                        </td>
                        <td><?=$invoices->create_at?></td>
                      </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
            </div> 

  
    <div class="d-flex align-items-end justify-content-end">
      <a href="http://myschool.great-site.net/logout" class="btn btn-danger" title="logout">
        تسجيل خروج  
      </a>
    </div>
</div>

</div> <!-- end of container -->