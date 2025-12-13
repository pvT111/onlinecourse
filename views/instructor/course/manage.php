<?php
// $course và $lessons được truyền từ controller
$course  = $course  ?? [];
$lessons = $lessons ?? [];
require ROOT_PATH . '/views/includes/header.php';
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <a href="index.php?route=instructor_dashboard" class="text-blue-600 hover:underline">&larr; Quay lại danh sách khóa học</a>
                <h1 class="text-3xl font-bold text-gray-900 mt-4">
                    Quản lý bài học — <span class="text-blue-600"><?= htmlspecialchars($course['title'] ?? 'Khóa học') ?></span>
                </h1>
            </div>
            <a href="index.php?route=instructor_lesson_create&course_id=<?= $course['id'] ?? '' ?>"
               class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:opacity-90 transition">
                + Thêm bài học mới
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="p-6">
                <?php if (empty($lessons)): ?>
                    <div class="text-center py-12">
                        <p class="text-lg text-gray-600">Chưa có bài học nào trong khóa học này.</p>
                        <a href="index.php?route=instructor_lesson_create&course_id=<?= $course['id'] ?? '' ?>"
                           class="mt-4 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Thêm bài học đầu tiên
                        </a>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($lessons as $index => $lesson): ?>
                            <div class="flex items-center justify-between p-6 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                                <div class="flex items-center gap-6">
                                    <div class="text-2xl font-bold text-gray-400 w-12 text-center">
                                        <?= $index + 1 ?>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            <?= htmlspecialchars($lesson['title']) ?>
                                        </h3>
                                        <p class="text-gray-600 mt-1">
                                            <?= nl2br(htmlspecialchars(substr($lesson['content'] ?? '', 0, 150))) ?>
                                            <?= strlen($lesson['content'] ?? '') > 150 ? '...' : '' ?>
                                        </p>
                                        <?php if (!empty($lesson['video_url'])): ?>
                                            <p class="text-sm text-blue-600 mt-2">
                                                Video: <?= htmlspecialchars($lesson['video_url']) ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <a href="index.php?route=instructor_lesson_edit&id=<?= $lesson['id'] ?>&course_id=<?= $course['id'] ?>"
                                       class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                                        Sửa
                                    </a>
                                    <form action="index.php?route=instructor_lesson_delete" method="POST" class="inline"
                                          onsubmit="return confirm('Xóa bài học này sẽ bị xóa vĩnh viễn. Tiếp tục?')">
                                        <input type="hidden" name="id" value="<?= $lesson['id'] ?>">
                                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                        <button type="submit"
                                                class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/views/includes/footer.php'; ?>