<?php
class CourseController
{
    public function index()
    {
        $courses = (new Course())->Categorys();
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
        $pdo = (new Database())->connect();

        $stmt = $pdo->prepare("SELECT * FROM courses WHERE title LIKE ?");
        $stmt->execute(["%$keyword%"]);
        $courses = $stmt->fetchAll();

        require ROOT_PATH . "/views/courses/search.php";
    }
    
}
