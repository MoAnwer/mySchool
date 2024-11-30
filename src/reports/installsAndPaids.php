<?php

  include '../../init.php';

  $dots = "../../";

  if($_SERVER['REQUEST_METHOD'] == "POST")  {

    $stage = filter($_POST['stage'], 'string');
    $gender = filter($_POST['gender'], 'string');

    $installAndPaids = DB::connection()->query(
      "SELECT
        s.fullName,
        s.enrollNumber,
        i.install_1,
        i.install_2,
        i.install_3,
        i.install_4,
        i.install_5,
        i.install_6,
        i.paid_1,
        i.paid_2,
        i.paid_3,
        i.paid_4,
        i.paid_5,
        i.paid_6
      FROM
        installments i
      INNER JOIN students s ON
        s.id = i.student_id
      WHERE
        s.stage = '$stage' AND s.gender = '$gender'"
    , 5)->fetchAll();

    $totalOfPaids = DB::connection()->query(
      "SELECT
        SUM(i.paid_1) AS totalOfPaid1,
        SUM(i.paid_2) AS totalOfPaid2,
        SUM(i.paid_3) AS totalOfPaid3,
        SUM(i.paid_4) AS totalOfPaid4,
        SUM(i.paid_5) AS totalOfPaid5,
        SUM(i.paid_6) AS totalOfPaid6
      FROM
        installments i
      INNER JOIN students s ON
        s.id = i.student_id
      WHERE
        s.stage = '$stage' AND s.gender = '$gender'"
    , 5)->fetch();

    // studentCount

    $studentCount = 0;

     // للمساعدة في  حساب اجمالي المتبقي
    $remanent1 = 0;
    $remanent2 = 0;
    $remanent3 = 0;
    $remanent4 = 0;
    $remanent5 = 0;
    $remanent6 = 0;

    if ($installAndPaids && $totalOfPaids) {
      echo "
      <div class='table-responsive p-3'>
        <table class='table text-center shadow table-striped' id='dataTable' cellspacing='0'>
          <thead class='table-dark table-bordered'>
            <tr>
                <th>الطالب</th>
                <th>الإستمارة</th>
                <th>القسط الاول</th>
                <th>المدفوع</th>
                <th>القسط الثاني</th>
                <th>المدفوع</th>
                <th>القسط الثالث</th>
                <th>المدفوع</th>
                <th>القسط الرابع</th>
                <th>المدفوع</th>
                <th>القسط الخامس</th>
                <th>المدفوع</th>
                <th>القسط السادس</th>
                <th>المدفوع</th>
            </tr>
        </thead>
        <tbody class='table-bordered'>
      ";
      foreach ($installAndPaids as $row) {

        $studentCount++;

        $remanent1 += $row->install_1 - $row->paid_1;
        $remanent2 += $row->install_2 - $row->paid_2;
        $remanent3 += $row->install_3 - $row->paid_3;
        $remanent4 += $row->install_4 - $row->paid_4;
        $remanent5 += $row->install_5 - $row->paid_5;
        $remanent6 += $row->install_6 - $row->paid_6;

        echo 
        "<tr>
            <td>$row->fullName</td>
            <td>$row->enrollNumber</td>
            <td>" . number_format($row->install_1) . " جنية</td>
            <td>" . number_format($row->paid_1) . "  جنية</td>
            <td>" . number_format($row->install_2) ." جنية</td>
            <td>" . number_format($row->paid_2) . " جنية</td>
            <td>" . number_format($row->install_3) . " جنية</td>
            <td>" . number_format($row->paid_3) . " جنية</td>
            <td>" . number_format($row->install_4) . " جنية</td>
            <td>" . number_format($row->paid_4) . " جنية</td>
            <td>" . number_format($row->install_5) . " جنية</td>
            <td>" . number_format($row->paid_5) . " جنية</td>
            <td>" . number_format($row->install_6) . " جنية</td>
            <td>" . number_format($row->paid_6) . " جنية</td>
          </tr>";  
      }
      echo "</tbody>";
      echo "<caption class='bg-dark text-light px-3'> عدد الطلاب : {$studentCount} طالب </caption>";
      echo "</table>";
      echo "</div>";


      echo "<hr>";


      # اجمالي المدفوعات

      echo "<h6 class='text-gray-800 mb-4 mt-3'><b><i class='bi bi-wallet'></i> اجمالي المدفوعات لكل قسط : </b></h6>";

      echo "<div class='row'>";


        echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";
            Component::infoCard([
              'borderPosition' => 'bottom',
              'borderColor' => 'success',
              'classess' => 'shadow-sm',
              'cardTitle' => 'مدفوع القسط 1',
              'mainContent' => number_format($totalOfPaids->totalOfPaid1) . " جنية",
              'icon' => 'wallet'
            ]);

        echo "</div>";

        echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";
            Component::infoCard([
              'borderPosition' => 'bottom',
              'borderColor' => 'success',
              'classess' => 'shadow-sm',
              'cardTitle' => 'مدفوع القسط 2',
              'mainContent' => number_format($totalOfPaids->totalOfPaid2) . " جنية",
              'icon' => 'wallet'
            ]);

        echo "</div>";

        echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";
            Component::infoCard([
              'borderPosition' => 'bottom',
              'borderColor' => 'success',
              'classess' => 'shadow-sm',
              'cardTitle' => 'مدفوع القسط 3',
              'mainContent' => number_format($totalOfPaids->totalOfPaid3) . " جنية",
              'icon' => 'wallet'
            ]);

        echo "</div>";

        echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";
            Component::infoCard([
              'borderPosition' => 'bottom',
              'borderColor' => 'success',
              'classess' => 'shadow-sm',
              'cardTitle' => 'مدفوع القسط 4',
              'mainContent' => number_format($totalOfPaids->totalOfPaid4) . " جنية",
              'icon' => 'wallet'
            ]);

        echo "</div>";

        echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";
            Component::infoCard([
              'borderPosition' => 'bottom',
              'borderColor' => 'success',
              'classess' => 'shadow-sm',
              'cardTitle' => 'مدفوع القسط 5',
              'mainContent' => number_format($totalOfPaids->totalOfPaid5) . " جنية",
              'icon' => 'wallet'
            ]);

        echo "</div>";

        echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";
            Component::infoCard([
              'borderPosition' => 'bottom',
              'borderColor' => 'success',
              'classess' => 'shadow-sm',
              'cardTitle' => 'مدفوع القسط 6',
              'mainContent' => number_format($totalOfPaids->totalOfPaid6) . " جنية",
              'icon' => 'wallet'
            ]);

        echo "</div>";
        
      echo "</div>";


      echo "<hr>";

      # اجمالي المتبقي

      echo "<h6 class=' text-gray-800 mb-4 mt-3'><b><i class='bi bi-cash'></i> اجمالي المتبقي لكل قسط : </b></h6>";

      echo "<div class='row'>";

         echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";

              Component::infoCard([
                'borderPosition' => 'bottom',
                'borderColor' => 'warning',
                'classess' => 'shadow-sm',
                'cardTitle' => 'متبقي القسط 1',
                'mainContent' => number_format($remanent1) . " جنية",
                'icon' => 'cash-coin'
              ]);

          echo "</div>";

         echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";

              Component::infoCard([
                'borderPosition' => 'bottom',
                'borderColor' => 'warning',
                'classess' => 'shadow-sm',
                'cardTitle' => 'متبقي القسط 2',
                'mainContent' => number_format($remanent2) . " جنية",
                'icon' => 'cash-coin'
              ]);

          echo "</div>";

         echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";

              Component::infoCard([
                'borderPosition' => 'bottom',
                'borderColor' => 'warning',
                'classess' => 'shadow-sm',
                'cardTitle' => 'متبقي القسط 3',
                'mainContent' => number_format($remanent3) . " جنية",
                'icon' => 'cash-coin'
              ]);

          echo "</div>";

         echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";

              Component::infoCard([
                'borderPosition' => 'bottom',
                'borderColor' => 'warning',
                'classess' => 'shadow-sm',
                'cardTitle' => 'متبقي القسط 4',
                'mainContent' => number_format($remanent4) . " جنية",
                'icon' => 'cash-coin'
              ]);

          echo "</div>";

         echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";

              Component::infoCard([
                'borderPosition' => 'bottom',
                'borderColor' => 'warning',
                'classess' => 'shadow-sm',
                'cardTitle' => 'متبقي القسط 5',
                'mainContent' => number_format($remanent5) . " جنية",
                'icon' => 'cash-coin'
              ]);

          echo "</div>";

         echo "<div class='col-xl-2 col-lg-12 col-md-6 col-12 mb-4'>";

              Component::infoCard([
                'borderPosition' => 'bottom',
                'borderColor' => 'warning',
                'classess' => 'shadow-sm',
                'cardTitle' => 'متبقي القسط 6',
                'mainContent' => number_format($remanent6) . " جنية",
                'icon' => 'cash-coin'
              ]);

          echo "</div>";

      echo "</div>";

    } else {
      echo "<h1 class='text-center mt-4 text-gray-800'>لا توجد بيانات لعرضها 🙅🏼‍♂️</h1>";
    }
  }