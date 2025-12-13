<?php
$course  = $course  ?? [];
$lesson  = $lesson  ?? [];
require ROOT_PATH . '/views/includes/header.php';
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="index.php?route=instructor_lesson_manage&course_id=<?= $course['id'] ?? '' ?>"
               class="text-blue-600 hover:underline">&larr; Quay lại</a>
            <h1 class="text-3xl font-bold text-gray-900 mt-4">
                Chỉnh sửa bài học — <span class="text-blue-600"><?= htmlspecialchars($lesson['title'] ?? '') ?></span>
            </h1>
        </div>

        <form action="index.php?route=instructor_lesson_update&id=<?= $lesson['id'] ?>" method="POST"
              class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 space-y-8">

            <input type="hidden" name="course_id" value="<?= $course['id'] ?? '' ?>">

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Tiêu đề bài học *</label>
                <input type="text" name="title" required value="<?= htmlspecialchars($lesson['title'] ?? '') ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg" />
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Nội dung bài học *</label>
                <textarea name="content" rows="10" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg"><?= htmlspecialchars($lesson['content'] ?? '') ?></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">URL Video</label>
                    <input type="url" name="video_url" value="<?= htmlspecialchars($lesson['video_url'] ?? '') ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg" />
                </div>
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Thứ tự hiển thị *</label>
                    <input type="number" name="lesson_order" required min="1" value="<?= $lesson['lesson_order'] ?? 1 ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg" />
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <a href="index.php?route=instructor_lesson_manage&course_id=<?= $course['id'] ?? '' ?>"
                   class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Hủy
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700">
                    Cập nhật bài học
                </button>
            </div>
        </form>
    </div>
</div>

<?php require ROOT_PATH . '/views/includes/footer.php'; ?>