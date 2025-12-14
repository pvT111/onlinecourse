<?php
// models/Enrollment.php

require_once "BaseModel.php";

class Enrollment extends BaseModel
{
    protected $table = "enrollments";

    public function getByUser($userId)
    {
        $sql = "SELECT e.*, c.title, c.description, c.price, c.image, c.duration_weeks,
                       cat.name AS category_name
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                LEFT JOIN categories cat ON c.category_id = cat.id
                WHERE e.user_id = ?
                ORDER BY e.enrolled_date DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isEnrolled($userId, $courseId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?");
        $stmt->execute([$userId, $courseId]);
        return $stmt->fetch() ? true : false;
    }
    public function deleteByCourse($course_id)
{
    $stmt = $this->pdo->prepare("DELETE FROM enrollments WHERE course_id = ?");
    $stmt->execute([$course_id]);
    return $stmt->rowCount() > 0; 
}
    public function enroll($userId, $courseId)
    {
        $data = [
            'user_id' => $userId,
            'course_id' => $courseId,
            'enrolled_date' => date('Y-m-d H:i:s')
        ];
        return $this->insert($data);
    }

    // Lấy thống kê cho student dashboard (số khóa học, hoàn thành, giờ học, chứng chỉ)
    public function getStats($userId)
    {
        $sql = "SELECT 
                    COUNT(*) as total_enrolled,
                    SUM(CASE WHEN c.progress >= 100 THEN 1 ELSE 0 END) as completed_courses
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                WHERE e.user_id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'enrolled' => $row['total_enrolled'] ?? 0,
            'completed' => $row['completed_courses'] ?? 0,
            'hours' => '24.5', // Có thể tính sau nếu có dữ liệu thời lượng
            'certificates' => $row['completed_courses'] ?? 0
        ];
    }
}
