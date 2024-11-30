<?php
class Installment extends Model {
      public function updateWithStudentId($id, $data) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "{$key} = '{$value}', ";
        }
        $set = rtrim($set, ", ");
        $query = "UPDATE {$this->table} SET {$set} WHERE student_id = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$id]);
    }

    public static function stagesMoneyData() : array | false {
        return DB::connection()->query(
            "SELECT  
                s.stage AS stage,
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
                LEFT JOIN
                installments i
                ON
                s.id = i.student_id
                WHERE 
                s.stage != ''
                GROUP BY 
                s.stage
            "
        , 5)->fetchAll();
    }

    public static function studentsMoneyData() : array | false {
        return DB::connection()->query(
            "SELECT
                s.fullName,
                s.enrollNumber,
                s.class,
                s.stage,
                i.install_1,
                i.install_2,
                i.install_3,
                i.install_4,
                i.install_5,
                i.install_6,
                i.paid_1,
                i.paid_2,
                i.paid_3,
                i.paid_4,
                i.paid_5,
                i.paid_6,
                SUM(i.paid_1 + i.paid_2 + i.paid_3 + i.paid_4 + i.paid_5 + i.paid_6) AS totalOfPaids
                FROM
                installments i
                INNER JOIN students s ON
                s.id = i.student_id
                GROUP BY 
                s.id
            "
        , 5)->fetchAll();
    }
}