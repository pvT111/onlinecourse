<?php
// controllers/LessonController.php
require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../models/Course.php';

class LessonController  {

    public function create($courseId = null) {
        requireRole(['instructor']);
        $course = (new Course())->find($courseId);
        if (!$course) { $_SESSION['error']='Khóa học không tồn tại.'; $this->redirect(BASE_URL.'/instructor/my-courses'); }
        $this->render('instructor/lessons/create', ['course_id'=>$courseId]);
    }

    public function store() {
        requireRole(['instructor']);
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect(BASE_URL.'/instructor/my-courses');

        $data = [
            'course_id'=>$_POST['course_id'],
            'title'=>$_POST['title'],
            'content'=>$_POST['content'] ?? '',
            'video_url'=>$_POST['video_url'] ?? null,
            'order'=>$_POST['order'] ?? 1
        ];
        $lessonId = (new Lesson())->create($data);
        $_SESSION['success'] = 'Thêm bài học thành công.';
        $this->redirect(BASE_URL . '/instructor/lessons/manage/' . $data['course_id']);
    }

    public function edit($id = null) {
        requireRole(['instructor']);
        $lesson = (new Lesson())->find($id);
        if (!$lesson) { $_SESSION['error']='Bài học không tồn tại.'; $this->redirect(BASE_URL.'/instructor/my-courses'); }
        $this->render('instructor/lessons/edit', ['lesson'=>$lesson]);
    }

    public function update($id = null) {
        requireRole(['instructor']);
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect(BASE_URL.'/instructor/my-courses');

        $data = [
            'title'=>$_POST['title'],
            'content'=>$_POST['content'] ?? '',
            'video_url'=>$_POST['video_url'] ?? null,
            'order'=>$_POST['order'] ?? 1
        ];
        (new Lesson())->update($id, $data);
        $_SESSION['success']='Cập nhật bài học thành công.';
        $this->redirect(BASE_URL . '/instructor/lessons/manage/' . ($_POST['course_id'] ?? ''));
    }

    public function delete($id = null) {
        requireRole(['instructor']);
        $lesson = (new Lesson())->find($id);
        $courseId = $lesson['course_id'] ?? null;
        (new Lesson())->delete($id);
        $_SESSION['success']='Xóa bài học thành công.';
        $this->redirect(BASE_URL . '/instructor/lessons/manage/' . $courseId);
    }

    public function manage($courseId = null) {
        requireRole(['instructor']);
        $lessons = (new Lesson())->getByCourse($courseId);
        $course = (new Course())->find($courseId);
        $this->render('instructor/lessons/manage', ['lessons'=>$lessons, 'course'=>$course]);
    }
}
