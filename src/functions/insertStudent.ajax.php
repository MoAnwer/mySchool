<?php

  include "../../init.php";

  $dots = "../../";

  $data = json_decode(file_get_contents("php://input"), true);

  $studentData = $data['student'];
  $installmentsData = $data['installments'];

  
  // new student
  $student = new Student();
  $insertStudent = $student->create($studentData);


  $lastStudentID = $student->lastID();

  // push the student id into installment data to insert into db
  $installmentsData['student_id'] = json_decode($lastStudentID);

  $installment = new Installment();
  $insertInstallment = $installment->create($installmentsData);


  // update students table and add `installment_id` to make relation bettween the tables
  $insertIntallmentToStudent = $student->update($lastStudentID, [
    'installments_id' => $installment->lastID()
  ]);
  
    // create an account for student to show has details
  $user = new User();
  
  // make random password number
  $normalStudentPassword = rand(10000, 200000);

  $studentAccount = [
    'username' => 'student_' . $lastStudentID,
    'fullName' => $data['student']['fullName'],
    'password' => password_hash($normalStudentPassword, 1)
  ];

  $user->create($studentAccount);

  $student->update($lastStudentID, [
    'accountName' => $studentAccount['username'],
    'password' => $normalStudentPassword,
  ]);
  
  // to show normal password 
  $studentAccount['password'] = $normalStudentPassword;

  if($insertStudent && $insertInstallment && $insertIntallmentToStudent) {

    echo json_encode([
      'statusCode' => 200,
      'message' => '!! تم اضافة الطالب بنجاح <i class="bi bi-check-circle-fill mx-1"></i>',
      'studentAccount' => $studentAccount
    ]);

  } else {

    echo json_encode([
      'statusCode' => 404,
      'message' => '!! حدث خطأ ما , تأكد من صحة البيانات <i class="bi bi-x-circle-fill mx-1"></i>'
    ]);
  }
