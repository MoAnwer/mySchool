<?php

  if(isset($_POST['do']) && $_POST['do'] == 'export')  {

    include 'exportStudentsDataToXlsx.php';
    include 'exportInstallsToXlsx.php';
    include 'exportStagesAccountsToXlsx.php';
    include 'exportStudentsStageToXlsx.php';
    include 'exportStudentsMoneyDataToXlsx.php';

    echo json_encode(['message' => 'ok']);

}