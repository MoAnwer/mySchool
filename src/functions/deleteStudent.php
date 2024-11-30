<?php

  require_once '../../init.php';
  $dots = '../../';

  $id = filter($_POST['id'], 'int');

  // delete student
  (new Student)->delete($id);
  
  // delete student account
  DB::connection()->query("DELETE FROM users WHERE  username = 'student_$id' LIMIT 1");

  
  header('location: ../../views/admin/student-information');
  exit();