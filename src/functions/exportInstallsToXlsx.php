<?php

  require '../../libs/vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Style\Alignment;
  use PhpOffice\PhpSpreadsheet\Style\Fill;

  require "../../init.php";
  $dots = "../../";

  $db = DB::connection();

  $installsPaid = $db->query(
    "SELECT  
      SUM(i.total) AS total, 
      SUM(i.paid_1) AS paid1, 
      SUM(i.paid_2) AS paid2, 
      SUM(i.paid_3) AS paid3, 
      SUM(i.paid_4) AS paid4, 
      SUM(i.paid_5) AS paid5, 
      SUM(i.paid_6) AS paid6,
      SUM(i.paid_1 + i.paid_2 + i.paid_3 + i.paid_4 + i.paid_5 + i.paid_6) AS totalOfPaids
    FROM
      students s
    INNER JOIN
      installments i
    ON
      s.id = i.student_id
    "
  , 5)->fetch();


  
  $spreadSheet = new Spreadsheet();
  $activeWorkSheet = $spreadSheet->getActiveSheet();

  $activeWorkSheet->setCellValue('A1', 'القسط الاول')->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('B1', 'القسط الثاني')->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('C1', 'القسط الثالث')->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('D1', 'القسط الرابع')->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('E1', 'القسط الخامس')->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('F1', 'القسط السادس')->getStyle('F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('G1', 'الرسوم المقررة')->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
  $activeWorkSheet->setCellValue('H1', 'المدفوع')->getStyle('H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');

  // Cell Hight
  $activeWorkSheet->getRowDimension(1)->setRowHeight(22);
  $activeWorkSheet->getRowDimension(2)->setRowHeight(22);
  // alignment
  $activeWorkSheet->setCellValue('A2', number_format($installsPaid->paid1))->getStyle('A2')->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->setCellValue('B2', number_format($installsPaid->paid2))->getStyle('B2')->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->setCellValue('C2', number_format($installsPaid->paid3))->getStyle('C2')->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->setCellValue('D2', number_format($installsPaid->paid4))->getStyle('D2')->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->setCellValue('E2', number_format($installsPaid->paid5))->getStyle('E2')->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->setCellValue('F2', number_format($installsPaid->paid6))->getStyle('F2')->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->setCellValue('G2', number_format($installsPaid->total))->getStyle('G2')->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);
  $activeWorkSheet->setCellValue('H2', number_format($installsPaid->totalOfPaids))->getStyle('H2')->getAlignment()->setVertical
    (Alignment::VERTICAL_CENTER)->setHorizontal(Alignment::HORIZONTAL_CENTER);

  $writer = new Xlsx($spreadSheet);

  $writer->save($dots .'uploads/exports/اجمالي_مدفوعات_المدرسة_عام_' . date('Y') . '.xlsx');

 