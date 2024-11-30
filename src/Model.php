<?php

class Model {

    protected $table;
    public $connection;
	protected $attributes = [];

    public function __construct() {
        $this->table = $this->getStaticClassName();
        $this->connection = new PDO('mysql:host=localhost;dbname=numberone;charset=utf8;user=root');
    }
    
    public function getStaticClassName() {
        return explode('\\', strtolower(static::class)) [
            count(explode('\\', strtolower(static::class))) - 1
        ] . 's';
    }

    public function all() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function create($data) {
        try {
            $keys = implode(", ", array_keys($data));
            $values = "'" . implode("', '", array_values($data)) . "'";
            $query = "INSERT INTO {$this->table} ({$keys}) VALUES ({$values})";
            $queryResult = $this->connection->query($query);
            return $queryResult->rowCount();
        } catch (\PDOException $e) {
             if($e->getCode() == 23000) {
                return false;
            } else {
                return false;
            }
        }
    }

    public function update($id, $data) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "{$key} = '{$value}', ";
        }
        $set = rtrim($set, ", ");
        $query = "UPDATE {$this->table} SET {$set} WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$id]);
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$id]);
    }

    public function lastID() {
        $lastId = $this->connection->lastInsertId();
        return (int)($lastId);
    }

    public function __get(string $key) {
        if (property_exists($this, $key)) {
            $key = $this->{$key};
            $property = $this->connection->query("SELECT {$key} FROM {$this->table}")->fetch();
            $this->{$key} = $property;
            return $this->{$key};
        }
        // return null;
    }
    
}