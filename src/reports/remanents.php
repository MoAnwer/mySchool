<?php

  include '../../init.php';

  $dots = "../../";

  if($_SERVER['REQUEST_METHOD'] == "POST")  {

    $stage = filter($_POST['stage'], 'string');
    $gender = filter($_POST['gender'], 'string');
    $install = filter($_POST['install'], 'int');

 
      
    $remanents = DB::connection()->query(
      "SELECT
        s.fullName,
        s.enrollNumber,
        i.paid_$install as paid,
        i.install_$install AS install,
        (i.install_$install - i.paid_$install) AS remanent,
        SUM(i.install_$install - i.paid_$install) AS totalRemanent,
        SUM(i.paid_$install) AS paid,
        s.phoneOne,
        s.phoneTwo,
        s.whatsappPhone
      FROM
        installments i
      INNER JOIN 
        students s 
      ON
        s.id = i.student_id
      WHERE
        s.stage = '$stage'
      AND
        s.gender = '$gender'
      GROUP BY 
      s.id
      ORDER BY  
      s.id
      desc
      "
    , 5)->fetchAll();

    $totalInstalls = 0;
    $totalPaids = 0;
    $totalRemanent = 0;
    $studentCount = 0;
    

    if ($remanents) {
      echo "
      <div class='table-responsive'>
        <table class='table text-center table-striped shadow-sm'>
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
            </tr>
        </thead>
        <tbody class='table-bordered'>
      ";

      foreach ($remanents as $row) {
        $studentCount++;
        $totalRemanent += $row->totalRemanent;
        $totalInstalls += $row->install;
        $totalPaids += $row->paid;
        echo 
        "<tr>
            <td>$row->fullName</td>
            <td>$row->enrollNumber</td>
            <td>". number_format($row->install) ." جنية</td>
            <td>". number_format($row->paid) ." جنية</td>
            <td>". number_format($row->remanent) ." جنية</td>
            <td>$row->phoneOne</td>
            <td>$row->phoneTwo</td>
            <td>$row->whatsappPhone</td>
          </tr>";
      }
      $totalRemanent = number_format($totalRemanent);
      echo "</tbody>";
      echo "</table>";
      echo "</div>";
      
      echo "<div class='row'>";

        echo "<div class='col-lg-3 col-sm-12 mb-4'>";
          Component::infoCard([
            'borderPosition' => 'bottom',
            'borderColor' => 'primary',
            'classess' => 'shadow-sm',
            'cardTitle' => 'اجمالي الاقساط',
            'mainContent' => number_format($totalInstalls) . " جنية",
            'icon' => 'coin',
            'iconColor' => 'primary'
          ]);
          echo "</div>";

        echo "<div class='col-lg-3 col-sm-12 mb-4'>";
          Component::infoCard([
            'borderPosition' => 'bottom',
            'borderColor' => $totalPaids > 0 ? 'success' : 'danger',
            'classess' => 'shadow-sm',
            'cardTitle' => ' اجمالي المدفوع',
            'mainContent' => number_format($totalPaids) . " جنية",
            'icon' => 'wallet',
            'iconColor'=> 'success'
          ]);
          echo "</div>";
        
        echo "<div class='col-lg-3 col-sm-12 mb-4'>";  
          Component::infoCard([
            'borderPosition' => 'bottom',
            'borderColor' => 'warning',
            'classess' => 'shadow-sm',
            'cardTitle' => 'اجمالي المتبقي',
            'mainContent' => $totalRemanent . " جنية",
            'icon' => 'cash-coin',
            'iconColor' => 'warning'
          ]);
        echo "</div>";
          
        echo "<div class='col-lg-3 col-sm-12 mb-4'>";  
          Component::infoCard([
            'borderPosition' => 'bottom',
            'borderColor' => 'info',
            'classess' => 'shadow-sm',
            'cardTitle' => 'عدد الطلاب',
            'mainContent' => $studentCount . " طالب",
            'icon' => 'people-fill',
            'iconColor' => 'info'
          ]);
        echo "</div>";

          
      echo "</div>";
    } else {
      echo "<h1 class='text-center mt-4 text-gray-800'>لا توجد بيانات لعرضها 🙅🏼‍♂️</h1>";
    }
  }