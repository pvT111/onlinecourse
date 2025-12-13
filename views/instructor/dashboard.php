<?php
$courses = $courses ?? [];
$user = $user ?? null;
require ROOT_PATH . '/views/includes/header.php';
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-gray-900 mb-2 text-2xl font-bold">Bảng điều khiển giảng viên</h1>
        </div>

        <div class="mb-6">
            <div class="border-b border-gray-200">
                <div class="flex gap-8 overflow-x-auto" id="instructor-tabs">
                    <a href="index.php?route=instructor_dashboard"
                       class="tab-button pb-4 px-1 border-b-2 border-blue-600 text-gray-900 whitespace-nowrap">Quản lý khóa học</a>
                    <a href="index.php?route=instructor_course_create"
                       class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap">Tạo khóa học mới</a>
                    <a href="index.php?route=instructor_students"
                       class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap">Danh sách học viên</a>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="flex justify-end items-center">
                <a href="index.php?route=instructor_course_create"
                   class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:opacity-90 transition">
                    + Tạo khóa học mới
                </a>
            </div>

            <?php if (empty($courses)): ?>
                <div class="bg-white rounded-xl shadow p-12 text-center">
                    <p class="text-lg text-gray-600">Bạn chưa có khóa học nào.</p>
                </div>
            <?php else: ?>
                <div class="space-y-6">
                    <?php foreach ($courses as $course):
                        $courseInitial = strtoupper(substr($course['title'] ?? 'C', 0, 1));
                        $lessonCount = $course['lesson_count'] ?? 0;
                        $status = $course['status'] ?? 'Chờ duyệt';

                        $statusClasses = match ($status) {
                            'Published' => 'bg-green-100 text-green-800',
                            'Draft' => 'bg-gray-100 text-gray-800',
                            default => 'bg-yellow-100 text-yellow-800',
                        };
                        ?>
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                            <div class="p-8 flex gap-8">
                                <div class="relative w-64 h-44 rounded-xl overflow-hidden">
                                    <?php if (!empty($course['thumbnail']) && $course['thumbnail'] !== 'default.jpg'): ?>
                                        <img src="/uploads/courses/<?= htmlspecialchars($course['']) ?>"
                                             alt="Thumbnail khóa học" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-5xl font-bold">
                                            <?= htmlspecialchars($courseInitial) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-5">
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-900">
                                                <?= htmlspecialchars($course['title']) ?>
                                            </h3>
                                            <p class="text-gray-600 mt-2">
                                                <?= htmlspecialchars($course['description'] ?? 'Chưa có mô tả ngắn.') ?>
                                            </p>
                                        </div>
                                        <span class="px-5 py-2 rounded-full <?= $statusClasses ?>">
                                            <?= htmlspecialchars($status) ?>
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-4 gap-6 mb-6">
                                        <div class="text-center">
                                            <p class="text-gray-500 text-sm">Học viên</p>
                                            <p class="text-3xl font-bold text-gray-900"><?= number_format($course['student_count'] ?? 0) ?></p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-gray-500 text-sm">Bài học</p>
                                            <p class="text-3xl font-bold text-gray-900"><?= number_format($lessonCount) ?></p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-gray-500 text-sm">Giá</p>
                                            <p class="text-3xl font-bold text-gray-900"><?= number_format($course['price'] ?? 0) ?>đ</p>
                                        </div>
                                        
                                    </div>

                                    <div class="flex gap-4">
                                        <a href="index.php?route=course_detail&id=<?= htmlspecialchars($course['id']) ?>"
                                           class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50">Xem</a>

                                        <a href="index.php?route=instructor_course_edit&id=<?= htmlspecialchars($course['id']) ?>"
                                           class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Chỉnh sửa</a>

                                        <a href="index.php?route=instructor_lesson_manage&course_id=<?= htmlspecialchars($course['id']) ?>"
                                           class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50">
                                            Quản lý bài học
                                        </a>

                                        <button class="px-6 py-3 border border-red-300 text-red-600 rounded-xl hover:bg-red-50">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/views/includes/footer.php'; ?>