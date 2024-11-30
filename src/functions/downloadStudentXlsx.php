<?php

  require '../../libs/vendor/autoload.php';
  require '../../init.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  
  $dots = "../../";

  downloadFile('../../uploads/exports/students.xlsx');