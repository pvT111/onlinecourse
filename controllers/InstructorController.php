<?php
// controllers/InstructorController.php

class InstructorController
{
    private $courseModel;
    private $lessonModel;

    public function __construct()
    {
        $this->courseModel = new Course();
        $this->lessonModel = new Lesson();
    }

    // ================================================
    // DASHBOARD - Danh sách khóa học của giảng viên
    // ================================================
    public function dashboard()
    {

        $courses = $this->courseModel->getByInstructor($_SESSION['user_id']);

        require ROOT_PATH . "/views/instructor/dashboard.php";
    }

    // ================================================
    // TẠO KHÓA HỌC MỚI - Hiển thị form
    // ================================================
    public function courseCreate()
    {
        $categoryModel = new Category();
        $categorys = $categoryModel->all('name ASC');
        require ROOT_PATH . "/views/instructor/course/create.php";
    }

    public function courseStore()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=instructor_dashboard');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'category_id' => (int) ($_POST['category_id'] ?? 0),
            'level' => $_POST['level'] ?? 'Basic',
            'price' => (int) ($_POST['price'] ?? 0),
            'duration_weeks' => trim($_POST['duration_weeks'] ?? ''),
            'image' => 'default.jpg',

        ];

        // Validate cơ bản
        if (empty($data['title']) || empty($data['description']) || $data['category_id'] == 0 || $data['price'] < 0) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin bắt buộc.";
            redirect('index.php?route=instructor_course_create');
        }

        // Xử lý upload thumbnail
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = ROOT_PATH . '/uploads/courses/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $fileName);
            $targetPath = $uploadDir . $fileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (in_array($_FILES['image']['type'], $allowedTypes) && move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $data['image'] = $fileName;
            } else {
                $_SESSION['error'] = "Upload ảnh thất bại hoặc định dạng không hợp lệ.";
            }
        }

        // Lưu vào DB
        if ($this->courseModel->insert($data)) {
            $_SESSION['success'] = "Tạo khóa học thành công!";
            redirect('index.php?route=instructor_dashboard');
        } else {
            $_SESSION['error'] = "Có lỗi khi tạo khóa học.";
            redirect('index.php?route=instructor_course_create');
        }
    }

    // ================================================
    // CHỈNH SỬA KHÓA HỌC - Hiển thị form
    // ================================================
    public function courseEdit($id)
    {
        $course = $this->courseModel->find($id);

        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không tìm thấy khóa học hoặc bạn không có quyền chỉnh sửa.";
            redirect('index.php?route=instructor_dashboard');
        }
        $categoryModel = new Category();
        $categorys = $categoryModel->all('name ASC');
        require ROOT_PATH . "/views/instructor/course/edit.php";
    }

    // ================================================
    // CẬP NHẬT KHÓA HỌC
    // ================================================
    public function courseUpdate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=instructor_dashboard');
        }

        $id = $_POST['id'] ?? 0;
        $course = $this->courseModel->find($id);

        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không có quyền cập nhật khóa học này.";
            redirect('index.php?route=instructor_dashboard');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'category_id' => (int) ($_POST['category_id'] ?? 0),
            'level' => $_POST['level'] ?? 'Basic',
            'price' => (int) ($_POST['price'] ?? 0),
            'duration_weeks' => trim($_POST['duration_weeks'] ?? ''),
        ];

        // Validate
        if (empty($data['title']) || empty($data['description']) || $data['category_id'] == 0) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin.";
            redirect('index.php?route=instructor_course_edit&id=' . $id);
        }

        // Xử lý thumbnail mới (nếu có)
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = ROOT_PATH . '/uploads/courses/';
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $fileName);
            $targetPath = $uploadDir . $fileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (in_array($_FILES['image']['type'], $allowedTypes) && move_uploaded_file($_FILES['thumbnail']['tmp_name'], $targetPath)) {
                // Xóa ảnh cũ nếu không phải default
                if ($course['image'] !== 'default.jpg') {
                    $oldFile = $uploadDir . $course['image'];
                    if (file_exists($oldFile))
                        unlink($oldFile);
                }
                $data['image'] = $fileName;
            }
        }

        if ($this->courseModel->update($id, $data)) {
            $_SESSION['success'] = "Cập nhật khóa học thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi cập nhật.";
        }

        redirect('index.php?route=instructor_dashboard');
    }

    // ================================================
    // QUẢN LÝ BÀI HỌC CỦA KHÓA HỌC
    // ================================================
    public function lessonManage($course_id)
    {
        $course = $this->courseModel->find($course_id);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không có quyền truy cập khóa học này.";
            redirect('index.php?route=instructor_dashboard');
        }

        $lessons = $this->lessonModel->getByCourse($course_id);

        require ROOT_PATH . "/views/instructor/course/manage.php";
    }

    // ================================================
    // THÊM BÀI HỌC MỚI - Hiển thị form
    // ================================================
    public function lessonCreate($course_id)
    {
        $course = $this->courseModel->find($course_id);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không có quyền.";
            redirect('index.php?route=instructor_dashboard');
        }

        $lessons = $this->lessonModel->getByCourse($course_id); // để gợi ý thứ tự

        require ROOT_PATH . "/views/instructor/lessons/create.php";
    }

    // ================================================
    // LƯU BÀI HỌC MỚI
    // ================================================
    public function lessonStore()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=instructor_dashboard');
        }

        $course_id = $_POST['course_id'] ?? 0;
        $course = $this->courseModel->find($course_id);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không có quyền thêm bài học.";
            redirect('index.php?route=instructor_dashboard');
        }

        $data = [
            'course_id' => $course_id,
            'title' => trim($_POST['title'] ?? ''),
            'content' => $_POST['content'] ?? '',
            'video_url' => trim($_POST['video_url'] ?? ''),
            'order' => (int) ($_POST['order'] ?? 1),

        ];

        if (empty($data['title']) || empty($data['content'])) {
            $_SESSION['error'] = "Tiêu đề và nội dung bài học là bắt buộc.";
            redirect('index.php?route=instructor_lesson_create&course_id=' . $course_id);
        }

        if ($this->lessonModel->insert($data)) {
            $_SESSION['success'] = "Thêm bài học thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi thêm bài học.";
        }

        redirect('index.php?route=instructor_lesson_manage&course_id=' . $course_id);
    }

    // ================================================
    // CHỈNH SỬA BÀI HỌC
    // ================================================
    public function lessonEdit($id)
    {
        $lesson = $this->lessonModel->find($id);
        if (!$lesson) {
            $_SESSION['error'] = "Không tìm thấy bài học.";
            redirect('index.php?route=instructor_dashboard');
        }

        $course = $this->courseModel->find($lesson['course_id']);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không có quyền chỉnh sửa.";
            redirect('index.php?route=instructor_dashboard');
        }

        require ROOT_PATH . "/views/instructor/lesson/edit.php";
    }

    // ================================================
    // CẬP NHẬT BÀI HỌC
    // ================================================
    public function lessonUpdate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=instructor_dashboard');
        }

        $id = $_POST['id'] ?? 0;
        $lesson = $this->lessonModel->find($id);
        if (!$lesson) {
            $_SESSION['error'] = "Bài học không tồn tại.";
            redirect('index.php?route=instructor_dashboard');
        }

        $course = $this->courseModel->find($lesson['course_id']);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không có quyền.";
            redirect('index.php?route=instructor_dashboard');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'content' => $_POST['content'] ?? '',
            'video_url' => trim($_POST['video_url'] ?? ''),
            'order' => (int) ($_POST['order'] ?? 1),
        ];

        if (empty($data['title']) || empty($data['content'])) {
            $_SESSION['error'] = "Thông tin không hợp lệ.";
            redirect('index.php?route=instructor_lesson_edit&id=' . $id);
        }

        if ($this->lessonModel->update($id, $data)) {
            $_SESSION['success'] = "Cập nhật bài học thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi cập nhật.";
        }

        redirect('index.php?route=instructor_lesson_manage&course_id=' . $lesson['course_id']);
    }
   // ================================================
// XÓA KHÓA HỌC (với xóa cascade thủ công)
// ================================================
public function courseDelete()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('index.php?route=instructor_dashboard');
    }

    $id = $_POST['id'] ?? 0;
    if ($id <= 0) {
        $_SESSION['error'] = "ID khóa học không hợp lệ.";
        redirect('index.php?route=instructor_dashboard');
    }

    $course = $this->courseModel->find($id);

    if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
        $_SESSION['error'] = "Không tìm thấy khóa học hoặc bạn không có quyền xóa.";
        redirect('index.php?route=instructor_dashboard');
    }
    if ($course['image'] !== 'default.jpg') {
        $imagePath = ROOT_PATH . '/uploads/courses/' . $course['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    $lessons = $this->lessonModel->getByCourse($id);
    foreach ($lessons as $lesson) {
        $this->lessonModel->delete($lesson['id']);
    }

    $enrollmentModel = new Enrollment();
    $enrollmentModel->deleteByCourse($id);

    if ($this->courseModel->delete($id)) {
        $_SESSION['success'] = "Xóa khóa học thành công! (bao gồm bài học và đăng ký)";
    } else {
        $_SESSION['error'] = "Có lỗi khi xóa khóa học.";
    }

    redirect('index.php?route=instructor_dashboard');
}
    // ================================================
    // XÓA BÀI HỌC
    // ================================================
    public function lessonDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=instructor_dashboard');
        }

        $id = $_POST['id'] ?? 0;
        $course_id = $_POST['course_id'] ?? 0;

        $lesson = $this->lessonModel->find($id);
        if (!$lesson || $lesson['course_id'] != $course_id) {
            $_SESSION['error'] = "Bài học không hợp lệ.";
            redirect('index.php?route=instructor_dashboard');
        }

        $course = $this->courseModel->find($course_id);
        if (!$course || $course['instructor_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không có quyền xóa.";
            redirect('index.php?route=instructor_dashboard');
        }

        if ($this->lessonModel->delete($id)) {
            $_SESSION['success'] = "Xóa bài học thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi xóa bài học.";
        }

        redirect('index.php?route=instructor_lesson_manage&course_id=' . $course_id);
    }



    public function students($courseId = null)
    {
        $pdo = (new Database())->getInstance();

        if ($courseId) {
            $sql = "SELECT u.*, e.enrolled_date
        FROM users u
        JOIN enrollments e ON e.user_id = u.id
        WHERE e.course_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$courseId]);
            $students = $stmt->fetchAll();
        } else {
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