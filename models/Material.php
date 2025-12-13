<?php
// models/Material.php

require_once "BaseModel.php";

class Material extends BaseModel
{
    protected $table = "materials";

    public function getByLesson($lessonId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM materials WHERE lesson_id = ?");
        $stmt->execute([$lessonId]);
        return $stmt->fetchAll();
    }
}
