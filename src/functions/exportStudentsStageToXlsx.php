<?php

  require '../../libs/vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Style\Alignment;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Style\Fill;
  
  require "../../init.php";
  $dots = "../../";

  $kagesStudentCount     = Student::studentsCount('رياض');
  $baseStudentCount      = Student::studentsCount('ابتدائي');
  $middleStudentCount    = Student::studentsCount('متوسط');
  $secondaryStudentCount = Student::studentsCount('ثانوي');


  
  $spreadSheet = new Spreadsheet();
  $activeWorkSheet = $spreadSheet->getActiveSheet();

  $activeWorkSheet->setCellValue('A1', 'عدد طلاب الرياض')
  ->getRowDimension(2)
  ->setRowHeight(22);

  $activeWorkSheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


  $activeWorkSheet->setCellValue('B1', 'عدد طلاب الابتدائي')
  ->getRowDimension(2)
  ->setRowHeight(22);

  
  $activeWorkSheet->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('B1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

  $activeWorkSheet->setCellValue('C1', 'عدد طلاب المتوسط')
  ->getRowDimension(2)
  ->setRowHeight(22);

  $activeWorkSheet->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('C1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

  
  $activeWorkSheet->setCellValue('D1', 'عدد طلاب الثانوي')
  ->getRowDimension(2)
  ->setRowHeight(22);

  $activeWorkSheet->getStyle('D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('D1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
  
  $activeWorkSheet->setCellValue('E1', 'العدد الكلي للطلاب')
  ->getRowDimension(2)
  ->setRowHeight(22);

  $activeWorkSheet->getStyle('E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('E1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
  

  
  $activeWorkSheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');



  $activeWorkSheet->getRowDimension(2)->setRowHeight(22);

  $activeWorkSheet->setCellValue('A2', number_format($kagesStudentCount));
  $activeWorkSheet->setCellValue('B2', number_format($baseStudentCount));
  $activeWorkSheet->setCellValue('C2', number_format($middleStudentCount));
  $activeWorkSheet->setCellValue('D2', number_format($secondaryStudentCount));
  $activeWorkSheet->setCellValue('E2', number_format($kagesStudentCount + $baseStudentCount + $middleStudentCount + $secondaryStudentCount));

  $activeWorkSheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('A2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
  $activeWorkSheet->getStyle('B2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('B2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
  $activeWorkSheet->getStyle('C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('C2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
  $activeWorkSheet->getStyle('D2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('D2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
  $activeWorkSheet->getStyle('E2')->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->getStyle('E2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

  $writer = new Xlsx($spreadSheet);

  $writer->save($dots .'uploads/exports/عدد_طلاب_المدرسة_للعام_' . date('Y') . '.xlsx');