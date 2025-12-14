<?php
// models/Course.php

require_once "BaseModel.php";

class Course extends BaseModel
{
    protected $table = "courses";

    public function getByInstructor($instructorId)
    {
        $sql = "
        SELECT 
            c.*, 
            cat.name AS category_name
        FROM courses c
        LEFT JOIN categories cat ON c.category_id = cat.id
        WHERE c.instructor_id = ?
        ORDER BY c.id DESC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$instructorId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Courses()
    {
        $select = "
        c.*, 
        cat.name AS category_name, 
        u.fullname AS instructor_name
        
    ";

        $sql = "
        SELECT {$select} 
        FROM {$this->table} c
        
        LEFT JOIN categories cat 
            ON c.category_id = cat.id
            
        LEFT JOIN users u  
            ON c.instructor_id = u.id
       
        ORDER BY c.id DESC
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchCourses($keyword)
{
    $sql = "SELECT c.*, cat.name AS category_name, u.fullname AS instructor_name 
            FROM courses c
            LEFT JOIN categories cat ON c.category_id = cat.id
            LEFT JOIN users u ON c.instructor_id = u.id
            WHERE c.title LIKE ? 
            ORDER BY c.id DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(["%$keyword%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Thêm vào class Course

public function getCourseWithProgressAndLessons($courseId, $userId)
{
    // Lấy thông tin khóa học cơ bản
    $sql = "SELECT c.*, cat.name AS category_name,
                   (SELECT COUNT(*) FROM lessons l WHERE l.course_id = c.id) AS total_lessons
            FROM courses c
            LEFT JOIN categories cat ON c.category_id = cat.id
            WHERE c.id = ?";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$courseId]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$course) return null;

    // Giả lập tiến độ (bạn có thể thay bằng logic thực: theo lesson completed)
    // Ví dụ: 60% cho demo
    $course['progress'] = 60;
    $course['completed_lessons'] = round($course['total_lessons'] * 0.6);

    // Lấy danh sách bài học
    $lessonStmt = $this->pdo->prepare("SELECT * FROM lessons WHERE course_id = ? ORDER BY `order` ASC");
    $lessonStmt->execute([$courseId]);
    $course['lessons'] = $lessonStmt->fetchAll(PDO::FETCH_ASSOC);

    // Thêm thông tin giả lập cho từng lesson
    foreach ($course['lessons'] as &$lesson) {
        $lesson['type'] = 'video'; // hoặc lấy từ DB nếu có cột type
        $lesson['duration'] = '15-30 phút'; // có thể lấy từ DB
    }

    return $course;
}
}
