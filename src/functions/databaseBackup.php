<?php

    require "../../init.php";
    $dots = "../../";
  
    $conn = DB::connection();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if($_POST['do'] == 'backup') {
            
            // Backup file
            $sqlFile = '../../backup/database_backup.sql';
            $handle = fopen($sqlFile, 'w');

            // Show tables
            $tables = $conn->query("SHOW TABLES");

            fwrite($handle, "SET " . strtolower('FOREIGN_KEY_CHECKS') . " = 0; \n");
            foreach ($tables as $table) {
                $tableName = $table[0];

                // disable forgign key checks
                fwrite($handle, "DROP TABLE IF EXISTS `$tableName`;\n\n");

                // to create table command
                $createTableQuery = $conn->query("SHOW CREATE TABLE `$tableName`")->fetch(PDO::FETCH_ASSOC)['Create Table'];
                fwrite($handle, "$createTableQuery;\n\n");

                // get table data
                $dataQuery = $conn->query("SELECT * FROM `$tableName`");

                // Locking the table
                fwrite($handle, "LOCK TABLES `$tableName` WRITE;\n\n");

                while ($dataRow = $dataQuery->fetch(PDO::FETCH_ASSOC)) {
                    $columns = implode(", ", array_keys($dataRow));
                    $values = implode(", ", array_map(function($value) use ($conn) {
                        return "" . $conn->quote($value) . "";
                    }, array_values($dataRow)));
                    
                    fwrite($handle, "INSERT INTO `$tableName` ($columns) VALUES ($values);\n");
                }

                // Unlocking table
                fwrite($handle, "UNLOCK TABLES;\n\n");

                // enable forgign key checks
                fwrite($handle, "\n");
            }
            fwrite($handle, "SET " . strtolower('FOREIGN_KEY_CHECKS') . " = 1; \n");

            fclose($handle);

            echo json_encode([
                'success' => 'ok',
                'message' => 'تم الإحتفاظ بنسخة احتياطية بنجاح'
            ]);

        }
        
    }