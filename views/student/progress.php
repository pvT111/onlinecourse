<?php 
$pageTitle = "Chi tiết khóa học";
include ROOT_PATH . '/views/includes/header.php'; 

$courseId = (int)($_GET['id'] ?? 0);
if ($courseId <= 0 || !$selectedCourse) {
    $_SESSION['error'] = "Khóa học không hợp lệ hoặc bạn chưa đăng ký.";
    redirect('index.php?route=student_dashboard');
}
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="index.php?route=student_dashboard" class="text-blue-600 hover:underline flex items-center gap-2 mb-4">
                ← Quay lại Học tập của tôi
            </a>
            <h1 class="text-3xl font-bold text-gray-900"><?= htmlspecialchars($selectedCourse['title']) ?></h1>
            <p class="text-gray-600 mt-2">Theo dõi chi tiết tiến độ học tập</p>
        </div>

        <!-- Progress Overview -->
        <div class="grid md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow-sm p-6 text-center border border-gray-200">
                <p class="text-4xl font-bold text-blue-600 mb-2"><?= $selectedCourse['progress'] ?? 0 ?>%</p>
                <p class="text-gray-700">Hoàn thành</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 text-center border border-gray-200">
                <p class="text-4xl font-bold text-green-600 mb-2">
                    <?= $selectedCourse['completed_lessons'] ?? 0 ?> / <?= $selectedCourse['total_lessons'] ?? 0 ?>
                </p>
                <p class="text-gray-700">Bài học</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 text-center border border-gray-200">
                <p class="text-4xl font-bold text-purple-600 mb-2"><?= $selectedCourse['duration'] ?? 'Chưa xác định' ?></p>
                <p class="text-gray-700">Thời lượng</p>
            </div>
        </div>

        <!-- Danh sách bài học -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Danh sách bài học</h2>
            <?php if (empty($selectedCourse['lessons'])): ?>
                <p class="text-center text-gray-500 py-8">Khóa học này chưa có bài học nào.</p>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($selectedCourse['lessons'] as $index => $lesson): 
                        $isCompleted = $index < ($selectedCourse['completed_lessons'] ?? 0);
                    ?>
                        <div class="flex items-center justify-between p-6 rounded-xl border <?= $isCompleted ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200' ?>">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-xl <?= $isCompleted ? 'bg-green-600' : 'bg-gray-400' ?>">
                                    <?= $isCompleted ? '✓' : ($index + 1) ?>
                                </div>
                                <div>
                                    <p class="text-lg font-medium text-gray-900"><?= htmlspecialchars($lesson['title']) ?></p>
                                    <p class="text-sm text-gray-500 mt-2 flex items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="<?= $lesson['type'] === 'video' ? 'M14.752 11.168l-6.525-3.763A1 1 0 007 8.25v7.5a1 1 0 001.227.968l6.525-3.763a1 1 0 000-1.936z' : 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' ?>"></path>
                                        </svg>
                                        <?= $lesson['duration'] ?? 'Chưa xác định' ?> • <?= $lesson['type'] === 'video' ? 'Video' : 'Tài liệu' ?>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <?php if ($isCompleted): ?>
                                    <span class="px-5 py-2 bg-green-100 text-green-700 rounded-full font-medium">Đã hoàn thành</span>
                                <?php else: ?>
                                    <a href="index.php?route=lesson_detail&lesson_id=<?= $lesson['id'] ?>&course_id=<?= $selectedCourse['id'] ?>"
                                       class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                                        Bắt đầu học
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include ROOT_PATH . '/views/includes/footer.php'; ?>