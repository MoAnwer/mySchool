<?php

  require_once '../../init.php';
  $dots = '../../';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["id"];
    $installNumber = $_POST["installNumber"];
    $paid = $_POST["paid"];
    $student = $_POST["student"];
    $stage = $_POST["stage"];
    $studentID = $_POST["studentID"];
    $paidWay = $_POST["paidWay"] ?? 'كاش';
    $processNumber = $_POST["processNumber"] ?? 0;
    $paidDate = date('Y-d-m H:i:s');

    $installs = [
      'الاول' => 1,
      'الثاني' => 2,
      'الثالث' => 3,
      'الرابع' => 4,
      'الخامس' => 5,
      'السادس' => 6
    ];

    $install = $installs[$installNumber];
    

    DB::connection()->query("UPDATE installments SET paid_$install = paid_$install + $paid WHERE student_id = $studentID");
    if ($processNumber > 0) {

        DB::connection()->query(
        "UPDATE 
            installments 
          SET 
            paidWay$install = '$paidWay', 
            processNumber$install = $processNumber,
            paidDate_$install = CURRENT_TIMESTAMP()
          WHERE 
            student_id = $studentID
      ");
    
    } else {
      DB::connection()->query(
      "UPDATE 
          installments 
        SET 
          paidWay$install = '$paidWay', 
          paidDate_$install = CURRENT_TIMESTAMP()
        WHERE 
          student_id = $studentID
    ");
    }

    if(isset($_POST["processNumber"]) && $_POST["processNumber"] > 0) {
      (new Invoice())->create([
        'student' => $student,
        'stage' => $stage,
        'paid' => (int)($paid),
        'installNumber' => $installNumber,
        'paidWay' => $paidWay,
        "processNumber" => $_POST["processNumber"],
        'image' => $id.'.png',
        'create_at' => date('Y-m-d H:i:s'),
        'student_id' => (int)($studentID)
      ]);
    } else {
      (new Invoice())->create([
        'student' => $student,
        'stage' => $stage,
        'paid' => (int)($paid),
        'installNumber' => $installNumber,
        'paidWay' => $paidWay,
        'image' => $id.'.png',
        'create_at' => date('Y-m-d H:i:s'),
        'student_id' => (int)($studentID)
      ]);
    }
    echo json_encode([
      'success' => 'ok',
      'message' => 'تم حفظ الايصال بنجاح'
    ]);

  }