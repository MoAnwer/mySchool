<?php

  require '../../libs/vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Style\Alignment;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Style\Fill;

  require "../../init.php";
  $dots = "../../";

  $studentMoneyData = Installment::studentsMoneyData();
  
  $spreadSheet = new Spreadsheet();
  $activeWorkSheet = $spreadSheet->getActiveSheet();

  $activeWorkSheet->setCellValue('A1', 'اسم الطالب')->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('B1', 'رقم الاستمارة')->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('C1', 'الصف')->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('D1', 'المرحلة')->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('E1', 'قيمة القسط الاول')->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('F1', 'مدفوع القسط الاول')->getStyle('F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('G1', 'قيمة القسط الثاني')->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('H1', 'مدفوع القسط الثاني')->getStyle('H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('I1', 'قيمة القسط الثالث')->getStyle('I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('J1', 'مدفوع القسط الثالث')->getStyle('J1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('K1', 'قيمة القسط الرابع')->getStyle('K1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('L1', 'مدفوع القسط الرابع')->getStyle('L1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('M1', 'قيمة القسط الخامس')->getStyle('M1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('N1', 'مدفوع القسط الخامس')->getStyle('N1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('O1', 'قيمة القسط السادس')->getStyle('O1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('P1', 'مدفوع القسط السادس')->getStyle('P1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('Q1', 'اجمالي المدفوعات')->getStyle('Q1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  
  $row = count((array)$studentMoneyData);
  $row++;
  foreach ($studentMoneyData as $student) {
    $activeWorkSheet->getRowDimension($row)->setRowHeight(22);
    $activeWorkSheet->setCellValue('A' . $row , $student->fullName);
    $activeWorkSheet->setCellValue('B' . $row , $student->enrollNumber);
    $activeWorkSheet->setCellValue('C' . $row , $student->class);
    $activeWorkSheet->setCellValue('D' . $row , $student->stage);
    $activeWorkSheet->setCellValue('E' . $row , $student->install_1);
    $activeWorkSheet->setCellValue('F' . $row , $student->paid_1);
    $activeWorkSheet->setCellValue('G' . $row , $student->install_2);
    $activeWorkSheet->setCellValue('H' . $row , $student->paid_2);
    $activeWorkSheet->setCellValue('I' . $row , $student->install_3);
    $activeWorkSheet->setCellValue('J' . $row , $student->paid_3);
    $activeWorkSheet->setCellValue('K' . $row , $student->install_4);
    $activeWorkSheet->setCellValue('L' . $row , $student->paid_4);
    $activeWorkSheet->setCellValue('M' . $row , $student->install_5);
    $activeWorkSheet->setCellValue('N' . $row , $student->paid_5);
    $activeWorkSheet->setCellValue('O' . $row , $student->install_6);
    $activeWorkSheet->setCellValue('P' . $row , $student->paid_6);
    $activeWorkSheet->setCellValue('Q' . $row , $student->totalOfPaids);
    $activeWorkSheet->getStyle('A' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('B' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('C' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('D' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('E' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('F' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('G' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('H' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('I' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('J' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('K' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('L' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('M' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('N' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('O' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('P' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->getStyle('Q' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $row--;
  }

  $writer = new Xlsx($spreadSheet);

  $writer->save($dots .'uploads/exports/بيانات_الطلاب_المالية_لعام_' . date('Y') . '.xlsx');