<?php

  require '../../libs/vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Style\Alignment;
  use PhpOffice\PhpSpreadsheet\Style\Fill;
  
  require "../../init.php";
  $dots = "../../";

  $db = DB::connection();

  $stageMoneyData = Installment::stagesMoneyData();

  
  $spreadSheet = new Spreadsheet();
  $activeWorkSheet = $spreadSheet->getActiveSheet();
  

  $activeWorkSheet->setCellValue('A1', 'المرحلة');
  $activeWorkSheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('B1', 'مدفوع القسط الاول');
  $activeWorkSheet->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('C1', 'مدفوع القسط الثاني');
  $activeWorkSheet->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('D1', 'مدفوع القسط الثالث');
  $activeWorkSheet->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('E1', 'مدفوع القسط الرابع');
  $activeWorkSheet->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('F1', 'مدفوع القسط الخامس');
  $activeWorkSheet->getStyle('F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('G1', 'مدفوع القسط السادس');
  $activeWorkSheet->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('H1', 'اجمالي الرسوم المقررة');
  $activeWorkSheet->getStyle('H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('I1', 'اجمالي المدفوع');
  $activeWorkSheet->getStyle('I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');


  $row = 4;
  $row++;

  foreach ($stageMoneyData as $stage) {
    $activeWorkSheet->getRowDimension($row)->setRowHeight(22);
    $activeWorkSheet->setCellValue('A' . $row , $stage->stage)->getStyle('A'.$row)->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->setCellValue('B' . $row , $stage->paid1)->getStyle('B'.$row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->setCellValue('C' . $row , $stage->paid2)->getStyle('C'.$row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->setCellValue('D' . $row , $stage->paid3)->getStyle('D'.$row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->setCellValue('E' . $row , $stage->paid4)->getStyle('E'.$row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->setCellValue('F' . $row , $stage->paid5)->getStyle('F'.$row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->setCellValue('G' . $row , $stage->paid6)->getStyle('G'.$row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->setCellValue('H' . $row , $stage->total)->getStyle('H'.$row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeWorkSheet->setCellValue('I' . $row , $stage->totalOfPaids)->getStyle('I'.$row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $row--;
  }

  $writer = new Xlsx($spreadSheet);

  $writer->save($dots .'uploads/exports/اجمالي_مدفوعات_المراحل_للعام_' . date('Y') . '.xlsx');

 