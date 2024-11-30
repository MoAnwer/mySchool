<?php

  include "../../init.php";
  $dots = "../../";

if(Session::has('superadmin') && Session::has('isLogged')) {

  $sqlFile = '../../backup/database_backup.sql';
  
  downloadFile($sqlFile);
}
