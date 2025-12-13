<?php
// controllers/MaterialController.php
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../models/Lesson.php';

class MaterialController  {

    public function upload($lessonId = null) {
        requireRole(['instructor']);
        $lesson = (new Lesson())->find($lessonId);
        if (!$lesson) { $_SESSION['error']='Bài học không tồn tại.'; $this->redirect(BASE_URL.'/instructor/my-courses'); }
        $this->render('instructor/materials/upload', ['lesson_id'=>$lessonId]);
    }

    public function store() {
        requireRole(['instructor']);
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['file'])) {
            $_SESSION['error']='Không có tệp được gửi.';
            $this->redirect(BASE_URL . '/instructor/my-courses');
        }

        $lesson_id = $_POST['lesson_id'] ?? null;
        $course_id = $_POST['course_id'] ?? null;

        $file = $_FILES['file'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['error'] = 'Tải tệp thất bại.';
            $this->redirect(BASE_URL . '/instructor/lessons/manage/' . $course_id);
        }

        // Validate file type & size (basic)
        $allowed = ['pdf','doc','docx','ppt','pptx','zip','rar','txt','mp4','mov','mkv'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $_SESSION['error'] = 'Loại tệp không được phép.';
            $this->redirect(BASE_URL . '/instructor/lessons/manage/' . $course_id);
        }

        $uploadDir = __DIR__ . '/../assets/uploads/materials/';
        if (!is_dir($uploadDir)) mkdir($uploadDir,0755,true);
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/','_',basename($file['name']));
        $target = $uploadDir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $target)) {
            $_SESSION['error'] = 'Lưu tệp thất bại.';
            $this->redirect(BASE_URL . '/instructor/lessons/manage/' . $course_id);
        }

        $material = new Material();
        $material->create([
            'lesson_id'=>$lesson_id,
            'filename'=>$file['name'],
            'file_path'=>str_replace(ROOT_PATH, '', $target),
            'file_type'=>$ext
        ]);

        $_SESSION['success'] = 'Tải tài liệu lên thành công.';
        $this->redirect(BASE_URL . '/instructor/lessons/manage/' . $course_id);
    }
}
