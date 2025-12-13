<?php
// models/Course.php

require_once "BaseModel.php";

class Course extends BaseModel
{
    protected $table = "courses";

    public function getByInstructor($instructorId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM courses WHERE instructor_id = ?");
        $stmt->execute([$instructorId]);
        return $stmt->fetchAll();
    }
    public function Categorys(){
        $select = "c.*, cat.name as category_name";
        
        $sql = "SELECT $select 
                FROM {$this->table} c
                LEFT JOIN categories cat ON c.category_id = cat.id
                ORDER BY c.id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
