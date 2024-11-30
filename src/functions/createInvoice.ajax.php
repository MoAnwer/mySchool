<?php


  require_once '../../init.php';
  $dots = '../../';

  $data = json_decode(file_get_contents("php://input"), true);

  $enrollNumber = intval($data['enrollNumber']);
  $install = intval($data['install']);
  $paid = intval($data['paid']);
  $gender = $data['gender'];
  $stage = $data['stage'];

  $installments = [
    1 => 'الاول',
    'الثاني',
    'الثالث',
    'الرابع',
    'الخامس',
    'السادس'
  ];

  $sql = DB::connection()->prepare(
      "SELECT 
        s.id AS studentID,
        s.fullName AS student, 
        s.gender AS gender,
        s.class AS class,
        s.stage AS stage,
        s.whatsappPhone as whatsapp,
        i.install_$install - i.paid_$install as remanent
        FROM
          students s
        INNER JOIN 
          installments i
        ON 
          i.student_id = s.id
        WHERE 
          `stage` = :stage
        AND
          `gender` = :gender
        AND
          `enrollNumber` = :enrollNumber
    ");

  $sql->execute([':stage' => $stage, ':gender' => $gender, ':enrollNumber' => $enrollNumber]);
  $student = $sql->fetch(PDO::FETCH_ASSOC);


  @$lastInvoiceID = DB::connection()->query("SELECT id AS id FROM `invoices` ORDER by id DESC LIMIT 1",5)->fetch(); // ++ to add id for current invoice 
  @$InvoiceID = $lastInvoiceID->id;

  ++$InvoiceID;

  $student['appName'] = Session::get('app');
  $student['newPaid'] = $paid;
  $student['installName'] = $installments[$install];
  $student['remanent'] = $student['remanent'] - $paid;
  $student['invoiceId'] = $InvoiceID;
  $student['studentClass'] = $student['class'] . ' ' . $student['stage'];
  $student['stage'];
  $student['date'] = date('d/m/Y h:ia');

  echo json_encode($student);