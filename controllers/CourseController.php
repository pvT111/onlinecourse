<?php
class CourseController
{
    public function index()
    {
        $courses = (new Course())->Courses();
        $categoryModel = new Category();
        $categorys = $categoryModel->all('name ASC');

        require ROOT_PATH . "/views/courses/index.php";
    }

    public function detail($id)
    {
        $course = (new Course())->find($id);
        $lessons = (new Lesson())->getByCourse($id);

        require ROOT_PATH . "/views/courses/detail.php";
    }

    public function search()
    {
        $keyword = $_GET['q'] ?? '';
        $courseModel = new Course();
        $courses = $courseModel->searchCourses($keyword); 
        
        require ROOT_PATH . "/views/courses/search.php";
    }

}
