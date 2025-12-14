<?php
// models/Course.php

require_once "BaseModel.php";

class Course extends BaseModel
{
    protected $table = "courses";

    public function getByInstructor($instructorId)
    {
        $sql = "
        SELECT 
            c.*, 
            cat.name AS category_name
        FROM courses c
        LEFT JOIN categories cat ON c.category_id = cat.id
        WHERE c.instructor_id = ?
        ORDER BY c.id DESC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$instructorId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Courses()
    {
        $select = "
        c.*, 
        cat.name AS category_name, 
        u.fullname AS instructor_name
        
    ";

        $sql = "
        SELECT {$select} 
        FROM {$this->table} c
        
        LEFT JOIN categories cat 
            ON c.category_id = cat.id
            
        LEFT JOIN users u  
            ON c.instructor_id = u.id
       
        ORDER BY c.id DESC
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchCourses($keyword)
{
    $sql = "SELECT c.*, cat.name AS category_name, u.fullname AS instructor_name 
            FROM courses c
            LEFT JOIN categories cat ON c.category_id = cat.id
            LEFT JOIN users u ON c.instructor_id = u.id
            WHERE c.title LIKE ? 
            ORDER BY c.id DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(["%$keyword%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
