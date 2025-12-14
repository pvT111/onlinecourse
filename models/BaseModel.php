<?php
// models/BaseModel.php

class BaseModel
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::getInstance();     
    }

    // Lấy tất cả
    public function all($orderBy = 'id DESC')
    {
        $sql = "SELECT * FROM `{$this->table}` ORDER BY $orderBy";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm theo ID
    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `{$this->table}` WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    // Tìm theo cột bất kỳ (rất hay dùng)
    public function where($column, $value, $operator = '=')
    {
        $sql = "SELECT * FROM `{$this->table}` WHERE `$column` $operator ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    // Xóa
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `{$this->table}` WHERE id = ?");
        return $stmt->execute([$id]);
    }

    
    public function insert(array $data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $columns = array_keys($data);
        $placeholders = [];
        $values = [];

        foreach ($columns as $col) {
            $placeholder = ":$col";
            $placeholders[] = "`$col`";           // backtick tên cột
            $values[$placeholder] = $data[$col];   // named parameter
        }

        $columnsSql = implode(", ", $placeholders);
        $placeholdersSql = implode(", ", array_keys($values));

        $sql = "INSERT INTO `{$this->table}` ($columnsSql) VALUES ($placeholdersSql)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    // === UPDATE AN TOÀN ===
    public function update($id, array $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $setParts = [];
        $values = [];

        foreach ($data as $col => $val) {
            $placeholder = ":$col";
            $setParts[] = "`$col` = $placeholder";
            $values[$placeholder] = $val;
        }

        $values[':id'] = $id;
        $setSql = implode(", ", $setParts);

        $sql = "UPDATE `{$this->table}` SET $setSql WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    // Lấy ID vừa insert (rất hay dùng)
    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}