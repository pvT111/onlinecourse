<?php
$courses = $courses ?? [];
$user = $user ?? null;
require ROOT_PATH . '/views/includes/header.php';
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Bảng điều khiển giảng viên</h1>
        </div>

        <!-- Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <div class="flex gap-8 overflow-x-auto" id="instructor-tabs">
                    <a href="index.php?route=instructor_dashboard"
                       class="tab-button pb-4 px-1 border-b-4 border-blue-600 text-blue-600 font-medium whitespace-nowrap">
                        Quản lý khóa học
                    </a>
                    <a href="index.php?route=instructor_course_create"
                       class="tab-button pb-4 px-1 border-b-4 border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300 whitespace-nowrap">
                        Tạo khóa học mới
                    </a>
                    <a href="index.php?route=instructor_students"
                       class="tab-button pb-4 px-1 border-b-4 border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300 whitespace-nowrap">
                        Danh sách học viên
                    </a>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <!-- Nút tạo khóa học -->
            <div class="flex justify-end">
                <a href="index.php?route=instructor_course_create"
                   class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:opacity-90 transition shadow-md">
                    + Tạo khóa học mới
                </a>
            </div>

            <!-- Danh sách khóa học dạng bảng -->
            <?php if (empty($courses)): ?>
                <div class="bg-white rounded-xl shadow-sm p-12 text-center border border-gray-200">
                    <p class="text-lg text-gray-600 mb-6">Bạn chưa tạo khóa học nào.</p>
                    <a href="index.php?route=instructor_course_create"
                       class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
                        Tạo khóa học đầu tiên
                    </a>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">Khóa học</th>
                                    <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">Mô tả </th>
                                    <th class="text-center py-4 px-6 text-sm font-medium text-gray-700">Danh mục</th>
                                    <th class="text-center py-4 px-6 text-sm font-medium text-gray-700">Trình độ</th>
                                    <th class="text-center py-4 px-6 text-sm font-medium text-gray-700">Giá</th>
                                    <th class="text-center py-4 px-6 text-sm font-medium text-gray-700">hình ảnh</th>
                                    <th class="text-center py-4 px-6 text-sm font-medium text-gray-700">Thời lượng</th>
                                    <th class="text-center py-4 px-6 text-sm font-medium text-gray-700">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php 
                                foreach ($courses as $course): 
                                ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <!-- Cột Khóa học -->
                                        <td class="py-5 px-6 text-center text-gray-700">
                                            <?=htmlspecialchars($course['title']) ?>
                                        </td>

                                        <!-- Mô tả  -->
                                        <td class="py-5 px-6 text-left">
                                            <p class="text-gray-700 line-clamp-3">
                                                <?= htmlspecialchars($course['description'] ?? 'Chưa có mô tả.') ?>
                                            </p>
                                        </td>

                                        
                                        <td class="py-5 px-6 text-center text-gray-700">
                                            <?= htmlspecialchars($course['category_name']?? 'Chưa chọn danh mục') ?>
                                        </td>

                                     
                                        <td class="py-5 px-6 text-center">
                                            <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                                                <?= htmlspecialchars($course['level']) ?>
                                            </span>
                                        </td>

                                       
                                        <td class="py-5 px-6 text-center font-semibold text-gray-900">
                                            <?= htmlspecialchars($course['price'] ?? 0) ?>đ
                                        </td>

                                      
                                        <td class="py-5 px-6 text-center">
                                            <?php if (!empty($course['image'])): ?>
                                                <img src="<?= htmlspecialchars($course['image']) ?>" alt="Hình ảnh khóa học" class="w-16 h-16 object-cover rounded-md mx-auto">
                                            <?php else: ?>
                                                <span class="text-gray-400 italic">Chưa có hình ảnh</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="py-5 px-6 text-center text-gray-700">
                                            <?= htmlspecialchars($course['duration_weeks'])  ?> tuần 
                                        </td>
                                        
                                        
                                        
                                        <td class="py-5 px-6">
                                            <div class="flex items-center justify-center gap-3">
                                                <a href="index.php?route=instructor_course_edit&id=<?= $course['id'] ?>"
                                                   class="p-2.5 bg-blue-100 hover:bg-blue-200 rounded-lg transition"
                                                   title="Chỉnh sửa khóa học">
                                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <a href="index.php?route=instructor_lesson_manage&course_id=<?= $course['id'] ?>"
                                                   class="p-2.5 bg-purple-100 hover:bg-purple-200 rounded-lg transition"
                                                   title="Quản lý bài học">
                                                    <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </a>

                                                <form action="index.php?route=instructor_course_delete" method="POST" class="inline"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa khóa học này? Tất cả bài học và dữ liệu liên quan sẽ bị xóa vĩnh viễn.');">
                                                    <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                                    <button type="submit"
                                                            class="p-2.5 bg-red-100 hover:bg-red-200 rounded-lg transition"
                                                            title="Xóa khóa học">
                                                        <svg class="w-5 h-5 text-red-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2.202 2.202 0 0116.138 21H7.862a2.202 2.202 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/views/includes/footer.php'; ?>