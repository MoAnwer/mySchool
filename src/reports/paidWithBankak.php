<?php

  include '../../init.php';

  $dots = "../../";

  if($_SERVER['REQUEST_METHOD'] == "POST")  {

    $stage = filter($_POST['stage'], 'string');
    $install = filter($_POST['install'], 'int');
    $gender = filter($_POST['gender'], 'string');

    $paidWithBankak = DB::connection()->query(
      "SELECT
        s.id,
        s.fullName,
        s.enrollNumber,
        i.installNumber as install,
        i.paid,
        s.phoneOne, 
        s.phoneTwo,
        s.whatsappPhone,
        i.create_at,
        i.processNumber
      FROM
        invoices i
      INNER JOIN 
        students s 
      ON
        s.id = i.student_id
      WHERE
        s.gender = '$gender' AND s.stage = '$stage' AND i.paidWay = 'بنكك'"
    , 5)->fetchAll();


    $studentCount = 0;
    $totalInstall = 0;
    $totalPaid = 0;

    if ($paidWithBankak) {
      echo "
      <div class='table-responsive'>
        <table class='table text-center shadow-sm rounded'>
          <thead class='table-dark table-bordered'>
            <tr>
                <th>الطالب</th>
                <th>الإستمارة</th>
                <th>قيمة القسط</th>
                <th>المدفوع</th>
                <th>المتبقي</th>
                <th>هاتف 1</th>
                <th>هاتف 2</th>
                <th>واتساب</th>
                <th>تاريخ دفع</th>
                <th>رقم العملية</th>
            </tr>
        </thead>
        <tbody class='table-bordered'>
      ";
      foreach ($paidWithBankak as $row) {
        $studentCount++;
       
        $totalPaid += $row->paid;

        $installValueFromDB = DB::connection()->query(
          "SELECT 
              i.install_$install as install
            FROM 
              installments i 
            INNER JOIN 
              students s  
            ON
              s.id = i.student_id
            WHERE
              s.id = $row->id
        ", 5)->fetch();

        $remanent = $installValueFromDB->install - $row->paid;

        $totalInstall += $installValueFromDB->install;

        echo 
        "<tr>
            <td>$row->fullName</td>
            <td>$row->enrollNumber</td>
            <td>". number_format($installValueFromDB->install) ." جنية</td>
            <td>". number_format($row->paid) ." جنية</td>
            <td>". number_format($remanent) ." جنية</td>
            <td>$row->phoneOne</td>
            <td>$row->phoneTwo</td>
            <td>$row->whatsappPhone</td>
            <td dir='ltr'>$row->create_at</td>
            <td>$row->processNumber</td>
          </tr>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div>";
      
      echo "<div class='row'>";
      
        echo "<div class='col-lg-4 col-sm-12 mb-4'>";
          Component::infoCard([
            'borderPosition' => 'bottom',
            'borderColor' => 'info',
            'classess' => 'shadow-sm',
            'cardTitle' => 'عدد الطلاب',
            'mainContent' => number_format($studentCount) . " طالب",
            'icon' => 'cash-coin'
          ]);
        echo "</div>";
      
        echo "<div class='col-lg-4 col-sm-12 mb-4'>";
          Component::infoCard([
            'borderPosition' => 'bottom',
            'borderColor' => 'warning',
            'classess' => 'shadow-sm',
            'cardTitle' => ' اجمالي الاقساط المطلوبة',
            'mainContent' => number_format($totalInstall) . " جنية",
            'icon' => 'cash-coin'
          ]);
        echo "</div>";
      
        echo "<div class='col-lg-4 col-sm-12 mb-4'>";
          Component::infoCard([
            'borderPosition' => 'bottom',
            'borderColor' => $totalPaid > 0 ? 'success' : 'danger',
            'classess' => 'shadow-sm',
            'cardTitle' => ' اجمالي المدفوعات ',
            'mainContent' => number_format($totalPaid) . " جنية",
            'icon' => 'cash-coin'
          ]);
        echo "</div>";
        
      echo "</div>";

    } else {
      echo "<h1 class='text-center mt-4 text-gray-800'>لا توجد بيانات لعرضها 🙅🏼‍♂️</h1>";
    }
  }