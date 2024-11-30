<?php

  include '../../init.php';

  $dots = "../../";

  if($_SERVER['REQUEST_METHOD'] == "POST")  {

    $stage = filter($_POST['stage'], 'string');
    $install = filter($_POST['install'], 'int');
    $processNumber = filter($_POST['processNumber'], 'int');

    $paidWithBankak = DB::connection()->query(
      "SELECT
        s.fullName,
        s.enrollNumber,
        i.create_at AS paidDate,
        i.paid AS paid,
        i.installNumber AS install
      FROM
        invoices i
      INNER JOIN 
        students s
      ON
        s.id = i.student_id
      WHERE
        i.paidWay = 'بنكك'
      AND 
        s.stage = '$stage'
      AND
      i.processNumber = $processNumber
    "
    , 5)->fetchAll();

    
    if ($paidWithBankak) {
      echo "
      <div class='table-responsive container p-3'>
        <table class='table text-center shadow-sm' cellspacing='0'>
          <thead class='table-dark table-bordered'>
            <tr>
                <th>الطالب</th>
                <th>الإستمارة</th>
                <th>القسط</th>
                <th>المبلغ</th>
                <th>تاريخ الدفع</th>
            </tr>
        </thead>
        <tbody class='table-bordered'>
      ";
      foreach ($paidWithBankak as $row) {
        
        echo 
        "<tr>
            <td>$row->fullName</td>
            <td>$row->enrollNumber</td>
            <td>$row->install</td>
            <td>" . number_format($row->paid) . " جنية</td>
            <td>" . ($row->paidDate) . "</td>    
          </tr>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div>";
      echo "</div>";
    } else {
      echo "<h1 class='text-center mt-5 text-gray-800'>لا توجد بيانات لعرضها 🙅🏼‍♂️</h1>";
    }
  }
