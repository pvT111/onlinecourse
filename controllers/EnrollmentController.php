<?php
class EnrollmentController 
{
    public function dashboard() {
        require ROOT_PATH . "/views/student/dashboard.php";
    }
    public function enroll($courseId)
    {
        $userId = $_SESSION['user_id'];

        $enrollment = new Enrollment();

        if ($enrollment->isEnrolled($userId, $courseId)) {
            $_SESSION['info'] = "Bạn đã tham gia khóa học.";
            redirect(BASE_URL . "/courses/detail/$courseId");
        }

        $enrollment->insert([
            "user_id" => $userId,
            "course_id" => $courseId,
            "status" => "active",
            "enrolled_date" => date("Y-m-d H:i:s")
        ]);

        $_SESSION['success'] = "Tham gia khóa học thành công";
        redirect(BASE_URL . "/courses/detail/$courseId");
    }
}
