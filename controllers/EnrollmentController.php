<?php
class EnrollmentController 
{
    private $enrollmentModel;
    private $courseModel;

    public function __construct()
    {
        $this->enrollmentModel = new Enrollment();
        $this->courseModel = new Course();
    }

    // Dashboard: Danh sách khóa học đã đăng ký + stats
    public function dashboard() 
    {
        requireLogin();

        $userId = $_SESSION['user_id'];

        // Lấy tất cả khóa học đã đăng ký
        $enrollments = $this->enrollmentModel->getByUser($userId);

        $enrolledCourses = [];
        $stats = [
            'enrolled' => 0,
            'completed' => 0,
            'hours' => '0',
            'certificates' => 0
        ];

        foreach ($enrollments as $e) {
            // Lấy thông tin khóa học + thêm tiến độ (giả lập hoặc thực tế)
            $course = $this->courseModel->find($e['course_id']);
            if ($course) {
                $course['progress'] = $this->calculateProgress($e['course_id'], $userId); // bạn có thể thêm method này sau
                $course['last_accessed'] = $e['enrolled_date']; // hoặc lưu riêng last_accessed nếu cần
                $enrolledCourses[] = $course;

                $stats['enrolled']++;

                if ($course['progress'] >= 100) {
                    $stats['completed']++;
                    $stats['certificates']++;
                }
            }
        }

        // Tổng giờ học (giả lập hoặc tính sau)
        $stats['hours'] = '24.5';

        // Truyền dữ liệu vào view
        require ROOT_PATH . "/views/student/dashboard.php";
    }

    // Chi tiết khóa học (process)
    public function courseProcess($courseId)
    {
        requireLogin();

        $userId = $_SESSION['user_id'];

        if ($courseId <= 0) {
            $_SESSION['error'] = "Khóa học không hợp lệ.";
            redirect('index.php?route=student_dashboard');
        }

        if (!$this->enrollmentModel->isEnrolled($userId, $courseId)) {
            $_SESSION['error'] = "Bạn chưa đăng ký khóa học này.";
            redirect('index.php?route=student_dashboard');
        }

        $selectedCourse = $this->courseModel->getCourseWithProgressAndLessons($courseId, $userId);

        if (!$selectedCourse) {
            $_SESSION['error'] = "Không tìm thấy khóa học.";
            redirect('index.php?route=student_dashboard');
        }

        require ROOT_PATH . "/views/student/process.php";
    }

    // Giữ nguyên method enroll cũ
    public function enroll($courseId)
    {
        $userId = $_SESSION['user_id'];

        if ($this->enrollmentModel->isEnrolled($userId, $courseId)) {
            $_SESSION['info'] = "Bạn đã tham gia khóa học.";
            redirect(BASE_URL . "/courses/detail/$courseId");
        }

        $this->enrollmentModel->insert([
            "user_id" => $userId,
            "course_id" => $courseId,
            "status" => "active",
            "enrolled_date" => date("Y-m-d H:i:s")
        ]);

        $_SESSION['success'] = "Tham gia khóa học thành công";
        redirect(BASE_URL . "/courses/detail/$courseId");
    }

    // Method phụ trợ: Tính tiến độ (giả lập đơn giản)
    private function calculateProgress($courseId, $userId)
    {
        // Ví dụ giả lập: 0 - 100% ngẫu nhiên
        // Thay bằng logic thực tế sau (ví dụ: số lesson đã xem / tổng lesson)
        return rand(0, 100);
    }
}