<?php



    /*    
    * filter the value by it's type
    * @param int|string value
    * @param string type
    */

   function filter(int|string $value,  string $type) : int|string {
      if(isset($value) && !empty($value)) {
        switch ($type) {
          case 'int' :
            $value = (int) filter_var($value, FILTER_VALIDATE_INT);
            break;
          case 'string' :
            $value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            break;
          default:
            $value;
            break;
        }
        return $value;
      } else {
        return false;
      }
    }

  /**
   * Set HTTP header
   * @param int status
   */
   function abort(int $status) {
    header("HTTP/1.1 $status");
    exit();
   }

  /**
   * arabicTimeName 
   * @param int status
   **/


  /**
   * downloadFile 
   * @param string filename
   **/

  function downloadFile($filename) {
    if (file_exists($filename)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/sql');
      header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filename));
      readfile($filename);
      exit;
    }
  }
  
 /**
   * getFileSize 
   * @param string filename
   **/
  
  function getFileSize($file_name) {
    if (filesize($file_name) >= 24 && filesize($file_name) <= 1024*1024 ) {
      return round(filesize($file_name) / 1024 , 1) + 1 . "KB";
    } elseif (filesize($file_name) >= 1024*1024 && filesize($file_name) <= 1024*1024*1024) {
      return round(filesize($file_name) / 1024 / 1024 , 1) . "MB";
    } elseif (filesize($file_name) >= 1024*1024*1024) {
      return round(filesize($file_name) / 1024 / 1024 / 1024, 1) . "GB";
    } else {
      return "0kb";
    }
  }


  function monthName($date) {
    $months = [
      "01" => " يناير ",
      "02" => " فبراير ",
      "03" => " مارس ",
      "04" => " ابريل ",
      "05" => " مايو ",
      "06" => " يونيو ",
      "07" => " يوليو ",
      "08" => " أغسطس ",
      "09" => " سبتمبر ",
      "10" => " أكتوبر ",
      "11" => " نوفمبر ",
      "12" => " ديسمبر ",
    ];
    return $months[$date];
  }