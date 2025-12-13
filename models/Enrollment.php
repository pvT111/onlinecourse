<?php
// models/Enrollment.php

require_once "BaseModel.php";

class Enrollment extends BaseModel
{
    protected $table = "enrollments";

    public function getByUser($userId)
    {
        $stmt = $this->pdo->prepare("SELECT e.*, c.title 
                                     FROM enrollments e
                                     JOIN courses c ON e.course_id = c.id
                                     WHERE e.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function isEnrolled($userId, $courseId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
        $stmt->execute([$userId, $courseId]);
        return $stmt->fetch() ? true : false;
    }
}
