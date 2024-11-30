<?php


class Student extends Model {


  public static function studentsCount($stage) {
    return DB::connection()->query(
      "SELECT  
        count(id) as studentCount
      FROM
        students
      WHERE 
        stage = '$stage'
      "
    , 5)->fetch()->studentCount;
  }

  public function stagesPublicInfo($stageName) {

    $q =  $this->connection->prepare("SELECT id, fullName, enrollDate, enrollNumber, birthDate, birthPlace, class, guardianCareer, guardian, guardianCopula, phoneOne, phoneTwo, whatsappPhone FROM students WHERE stage = ?");

    $q->execute([$stageName]);

    return $q->fetchAll(5);
  }

  public function invoicesData($id) {

    $q = $this->connection->prepare("SELECT * FROM invoices WHERE student_id = ?");

    $q->execute([$id]);

    return $q->fetchAll(5);

  }

  public function installData($id) {

    $q = $this->connection->prepare(
      "SELECT 
          *, 
          SUM(install_1 + install_2 + install_3 + install_4 + install_5 + install_6) AS totalofInstalls,
          SUM(paid_1 + paid_2 + paid_3 + paid_4 + paid_5 + paid_6) AS totalofPaids 
        FROM 
          installments 
        WHERE 
      student_id = ?
    ");

    $q->execute([$id]);

    return $q->fetch(5);

  }

  public function publicStudentInfo($id) {

    $q = $this->connection->prepare("SELECT fullName, stage, class, address, accountName, password FROM students WHERE id = ?");

    $q->execute([$id]);

    return $q->fetch(5);

  }

}