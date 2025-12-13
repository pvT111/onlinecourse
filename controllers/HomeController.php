<?php
require_once ROOT_PATH . '/models/Course.php';
class HomeController
{
    public function index()
    {
        $courses = (new Course())->all();
        require_once ROOT_PATH . "/views/home/index.php";
    }
}

