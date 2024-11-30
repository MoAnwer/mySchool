<?php

  include "../../init.php";

  $dots = "../../";


  $data = json_decode(file_get_contents("php://input"), true);

  $studentID = $data['studentId'];
  $studentData = $data['student'];
  $installmentsData = $data['installments'];

  $updateStudent = (new Student())->update($studentID, $studentData);
  
  $updateInstallsData = (new Installment())->updateWithStudentId($studentID, $installmentsData);

  if($updateStudent && $updateInstallsData) {

    echo json_encode([
      'statusCode' => 200,
      'message' => '!! تم اضافة الطالب بنجاح <i class="bi bi-check-circle-fill mx-1"></i>'
    ]);

  } else {

    echo json_encode([
      'statusCode' => 404,
      'message' => '!! حدث خطأ ما , تأكد من صحة البيانات <i class="bi bi-x-circle-fill mx-1"></i>'
    ]);
  }


