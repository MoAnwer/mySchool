<?php

  require '../../libs/vendor/autoload.php';
  
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Style\Alignment;
  use PhpOffice\PhpSpreadsheet\Style\Fill;
  
  require '../../init.php';
  $dots = "../../";


    $spreadSheet = new Spreadsheet();
    $activeWorkSheet = $spreadSheet->getActiveSheet();

    $students = (new Student())->all();

    $activeWorkSheet->setCellValue('A1', 'م')->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('B1', 'الاسم الطالب')->getStyle('B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('C1', 'الاستمارة')->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('D1', 'تاريخها')->getStyle('D1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('E1', 'الصف')->getStyle('E1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('F1', 'المرحلة')->getStyle('F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('G1', 'العنوان')->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('H1', 'ولي الامر')->getStyle('H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('I1', 'القرابة')->getStyle('I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('J1', 'المهنة')->getStyle('J1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('K1', 'هاتف 1')->getStyle('K1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('L1', 'هاتف 2')->getStyle('L1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');
    $activeWorkSheet->setCellValue('M1', 'واتس')->getStyle('M1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DDD9D9');

    $row = count((array)$students);
    $row++;

    foreach ($students as $students) {
        $activeWorkSheet->getRowDimension($row)->setRowHeight(22);
        $activeWorkSheet->setCellValue('A'. $row, $students->id);
        $activeWorkSheet->setCellValue('B'. $row, $students->fullName);
        $activeWorkSheet->setCellValue('C'. $row, $students->enrollNumber);
        $activeWorkSheet->setCellValue('D'. $row, $students->enrollDate);
        $activeWorkSheet->setCellValue('E'. $row, $students->class);
        $activeWorkSheet->setCellValue('F'. $row, $students->stage);
        $activeWorkSheet->setCellValue('G'. $row, $students->address);
        $activeWorkSheet->setCellValue('H'. $row, $students->guardian);
        $activeWorkSheet->setCellValue('I'. $row, $students->guardianCopula);
        $activeWorkSheet->setCellValue('J'. $row, $students->guardianCareer);
        $activeWorkSheet->setCellValue('K'. $row, $students->phoneOne);
        $activeWorkSheet->setCellValue('L'. $row, $students->phoneTwo);
        $activeWorkSheet->setCellValue('M'. $row, $students->whatsappPhone);
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
        $row--;
    }

    $writer = new Xlsx($spreadSheet);

    $writer->save($dots .'uploads/exports/قائمة_طلاب_' . date('Y') .  '.xlsx');