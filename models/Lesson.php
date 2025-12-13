<?php
// models/Lesson.php

require_once "BaseModel.php";

class Lesson extends BaseModel
{
    protected $table = "lessons";

    public function getByCourse($courseId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM lessons WHERE course_id = ?");
        $stmt->execute([$courseId]);
        return $stmt->fetchAll();
    }
}
