<?php
class InstructorController
{
    public function dashboard()
    {
        $courseModel = new Course();
        $courses = $courseModel->getByInstructor($_SESSION['user_id']);

        require ROOT_PATH . "/views/instructor/dashboard.php";
    }

    public function myCourses()
    {
        $courses = (new Course())->getByInstructor($_SESSION['user_id']);
        require ROOT_PATH . "/views/instructor/my_courses.php";
    }

    // /instructor/students OR /instructor/students/{courseId}
    public function students($courseId = null)
    {
        $pdo = (new Database())->connect();

        if ($courseId) {
            $sql = "SELECT u.*, e.enrolled_date, e.status
                    FROM users u
                    JOIN enrollments e ON e.user_id = u.id
                    WHERE e.course_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$courseId]);
            $students = $stmt->fetchAll();
        } else {
            // Lấy tất cả học viên thuộc tất cả khóa mà instructor dạy
            $sql = "SELECT u.*, e.course_id
                    FROM users u
                    JOIN enrollments e ON e.user_id = u.id
                    JOIN courses c ON c.id = e.course_id
                    WHERE c.instructor_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION['user_id']]);
            $students = $stmt->fetchAll();
        }

        require ROOT_PATH . "/views/instructor/students/list.php";
    }
}
