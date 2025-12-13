<?php
require_once ROOT_PATH . '/models/Course.php';
class HomeController
{
    public function index()
    {
        $courseModel = new Course();   
        $courses = $courseModel->Courses();

    
        require_once ROOT_PATH . "/views/home/index.php";
    }
}

