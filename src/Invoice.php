<?php

class Invoice extends Model {

  /**
   * return formated stage month money form invoices paid data
   * @param string $stage
   * @return string $formatedMoney
   */

  public function getEarningsMonthFor(string $stage, $month = 'MONTH(CURRENT_DATE)')  {
    $sql = DB::connection()->query(
      "SELECT
          SUM(paid) AS totalPaid,
          MONTH(create_at) as month
        FROM 
          invoices i
        WHERE
          stage = '$stage'
        AND 
          MONTH(create_at) = $month
        AND
          YEAR(create_at) = YEAR(CURRENT_DATE)
        ORDER BY month
    ", 5)->fetch(PDO::FETCH_OBJ);
    return $sql->totalPaid;
  }

  /**
   * return formated stage month money form invoices paid data
   * @param string $stage
   * @return string $formatedMoney
   */

  public function getYearEarnings($month = 'MONTH(CURRENT_DATE)')  {
    $sql = DB::connection()->query(
      "SELECT
          SUM(paid) AS totalPaid,
          MONTH(create_at) as month,
          YEAR(create_at) as year
        FROM 
          invoices
        WHERE
          MONTH(create_at) = $month
        AND
          YEAR(create_at) = YEAR(CURRENT_DATE)
    ", 5)->fetch(PDO::FETCH_OBJ);
    return intval($sql->totalPaid);
  }

}