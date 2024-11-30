<?php

  include "../../init.php";
  $dots = "../../";

if(Session::has('superadmin') && Session::has('isLogged')) {

  $files = [ 
    '../../uploads/exports/اجمالي_مدفوعات_المدرسة_عام_'. date('Y') .'.xlsx', 
    '../../uploads/exports/بيانات_الطلاب_المالية_لعام_'. date('Y') .'.xlsx', 
    '../../uploads/exports/عدد_طلاب_المدرسة_للعام_'. date('Y') .'.xlsx',
    '../../uploads/exports/قائمة_طلاب_'. date('Y') .'.xlsx'
  ];

  $fileIndex = filter($_GET['i'], 'int');

  downloadFile($files[$fileIndex]);
}
 