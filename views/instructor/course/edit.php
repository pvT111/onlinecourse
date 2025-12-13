<?php
// Biến $course được truyền từ controller, chứa thông tin khóa học cần chỉnh sửa
$course = $course ?? [];

require ROOT_PATH . '/views/includes/header.php';
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="index.php?route=instructor_dashboard" class="text-blue-600 hover:underline">&larr; Quay lại danh sách khóa học</a>
            <h1 class="text-gray-900 mt-4 text-2xl font-bold">Chỉnh sửa khóa học</h1>
        </div>

        <div class="max-w-3xl mx-auto">
            <form action="index.php?route=instructor_course_update" method="POST" enctype="multipart/form-data"
                  class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 space-y-6">

                
                <input type="hidden" name="id" value="<?= htmlspecialchars($course['id'] ?? '') ?>">

                <div>
                    <label for="course_title" class="block text-gray-700 mb-2">Tên khóa học *</label>
                    <input type="text" id="course_title" name="title" required
                           value="<?= htmlspecialchars($course['title'] ?? '') ?>"
                           class="w-full px-4 py-3 border rounded-lg"
                           placeholder="Ví dụ: Lập trình React từ cơ bản đến nâng cao" />
                </div>

                <div>
                    <label for="course_description" class="block text-gray-700 mb-2">Mô tả ngắn *</label>
                    <textarea rows="4" id="course_description" name="description" required
                              class="w-full px-4 py-3 border rounded-lg"
                              placeholder="Mô tả ngắn gọn về khóa học..."><?= htmlspecialchars($course['description'] ?? '') ?></textarea>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="course_category" class="block text-gray-700 mb-2">Danh mục *</label>
                        <select id="course_category" name="category_id" required
                                class="w-full px-4 py-3 border rounded-lg">
                            <option value="">Chọn danh mục</option>
                            <option value="1" <?= (isset($course['category_id']) && $course['category_id'] == 1) ? 'selected' : '' ?>>Lập trình</option>
                            <option value="2" <?= (isset($course['category_id']) && $course['category_id'] == 2) ? 'selected' : '' ?>>Marketing</option>
                            <option value="3" <?= (isset($course['category_id']) && $course['category_id'] == 3) ? 'selected' : '' ?>>Thiết kế</option>
                            
                        </select>
                    </div>

                    <div>
                        <label for="course_level" class="block text-gray-700 mb-2">Trình độ *</label>
                        <select id="course_level" name="level" required class="w-full px-4 py-3 border rounded-lg">
                            <option value="Basic" <?= (isset($course['level']) && $course['level'] === 'Basic') ? 'selected' : '' ?>>Cơ bản</option>
                            <option value="Intermediate" <?= (isset($course['level']) && $course['level'] === 'Intermediate') ? 'selected' : '' ?>>Trung cấp</option>
                            <option value="Advanced" <?= (isset($course['level']) && $course['level'] === 'Advanced') ? 'selected' : '' ?>>Nâng cao</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="course_price" class="block text-gray-700 mb-2">Giá (VNĐ) *</label>
                        <input type="number" id="course_price" name="price" required min="0"
                               value="<?= htmlspecialchars($course['price'] ?? 0) ?>"
                               class="w-full px-4 py-3 border rounded-lg" placeholder="999000" />
                    </div>

                    <div>
                        <label for="course_duration" class="block text-gray-700 mb-2">Thời lượng *</label>
                        <input type="text" id="course_duration" name="duration" required
                               value="<?= htmlspecialchars($course['duration'] ?? '') ?>"
                               class="w-full px-4 py-3 border rounded-lg" placeholder="10 giờ" />
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 mb-2">Ảnh đại diện khóa học hiện tại</label>
                    <div class="mb-4">
                        <?php if (!empty($course['image']) && $course['image'] !== 'default.jpg'): ?>
                            <img src="/uploads/courses/<?= htmlspecialchars($course['image']) ?>"
                                 alt="Thumbnail hiện tại" class="w-64 h-44 object-cover rounded-xl border border-gray-300">
                            <p class="text-sm text-gray-600 mt-2">Tên file: <?= htmlspecialchars($course['image']) ?></p>
                        <?php else: ?>
                            <div class="w-64 h-44 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-5xl font-bold rounded-xl">
                                <?= strtoupper(substr($course['title'] ?? 'C', 0, 1)) ?>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">Chưa có ảnh đại diện (sử dụng chữ cái đầu)</p>
                        <?php endif; ?>
                    </div>

                    <label for="course_thumbnail_new" class="block text-gray-700 mb-2">Thay đổi ảnh đại diện (tùy chọn)</label>
                    <input type="file" id="course_thumbnail_new" name="thumbnail" accept="image/*" class="hidden">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer"
                         onclick="document.getElementById('course_thumbnail_new').click()">
                        <div class="text-gray-400 mb-2">Kéo thả ảnh mới hoặc click để chọn (để trống nếu không muốn thay đổi)</div>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="index.php?route=instructor_dashboard"
                       class="px-6 py-3 border rounded-lg hover:bg-gray-50">
                        Hủy
                    </a>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Cập nhật khóa học
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/views/includes/footer.php'; ?>