<?php
// models/Category.php

require_once "BaseModel.php";

class Category extends BaseModel
{
    protected $table = "categories";
    public function getNameByID($ID){
        $sql = "SELECT name FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['name']; 
        }
        
        return null; 
    }
}
