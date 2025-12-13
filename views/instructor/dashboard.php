<?php
// Tối ưu hóa: Khai báo biến mặc định ngay từ đầu, giảm toán tử null coalescing trong HTML
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
                    <button data-tab="courses"
                        class="tab-button pb-4 px-1 border-b-2 border-blue-600 text-gray-900 whitespace-nowrap transition-colors">Quản
                        lý khóa học</button>
                    <button data-tab="students-list"
                        class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap transition-colors">Danh
                        sách học viên</button>
                    <button data-tab="create-course"
                        class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap transition-colors ">Tạo
                        khóa học mới</button>
                    <button data-tab="lesson-manager"
                        class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap transition-colors ">Quản
                        lý bài học</button>
                </div>
            </div>
        </div>

        <div id="tab-content-wrapper" class="space-y-8">

            <div id="courses" class="tab-content space-y-8 tab-active">
                <div class="flex justify-end items-center ">
                    <button data-action="show-create-tab" data-tab-target="create-course"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:opacity-90 transition">
                        + Tạo khóa học mới
                    </button>
                </div>

                <?php if (empty($courses)): ?>
                    <div class="bg-white rounded-xl shadow p-12 text-center">
                        <p class="text-lg text-gray-600">Bạn chưa có khóa học nào.</p>
                    </div>
                <?php else: ?>
                    <div class="space y-6">
                        <?php foreach ($courses as $course):
                            // ... Logic PHP hiển thị khóa học ...
                            $courseInitial = strtoupper(substr($course['title'] ?? 'C', 0, 1));
                            $lessonCount = $course['lesson_count'] ?? 0;
                            $rating = $course['average_rating'] ?? 0;
                            $revenue = $course['total_revenue'] ?? 0;
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
                                            <img src="/uploads/courses/<?= htmlspecialchars($course['thumbnail']) ?>"
                                                alt="Thumbnail khóa học" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-5xl font-bold">
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
                                                <p class="text-3xl font-bold text-gray-900">
                                                    <?= number_format($course['student_count'] ?? 0) ?>
                                                </p>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-gray-500 text-sm">Bài học</p>
                                                <p class="text-3xl font-bold text-gray-900"><?= number_format($lessonCount) ?>
                                                </p>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-gray-500 text-sm">Giá</p>
                                                <p class="text-3xl font-bold text-gray-900">
                                                    <?= number_format($course['price'] ?? 0) ?>đ
                                                </p>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-gray-500 text-sm">Doanh thu</p>
                                                <p class="text-3xl font-bold text-purple-600"><?= number_format($revenue) ?>đ
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex gap-4">
                                            <a href="index.php?route=course_detail&id=<?= htmlspecialchars($course['id']) ?>"
                                                class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50">Xem</a>

                                            <a href="index.php?route=instructor_course_edit&id=<?= htmlspecialchars($course['id']) ?>"
                                                class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Chỉnh
                                                sửa</a>

                                            <button type="button" data-action="open-lesson-tab" data-tab-target="lesson-manager"
                                                data-course-id="<?= (int) $course['id'] ?>"
                                                data-course-title="<?= htmlspecialchars($course['title']) ?>"
                                                class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50">
                                                Quản lý bài học
                                            </button>

                                            <button
                                                class="px-6 py-3 border border-red-300 text-red-600 rounded-xl hover:bg-red-50">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div id="create-course" class="tab-content max-w-3xl mx-auto hidden">
                <div class="flex items-center gap-4 mb-8">
                    <button data-action="back-to-courses" data-tab-target="courses"
                        class="text-blue-600 hover:underline">&larr; Quay lại</button>
                </div>

                <form action="index.php?route=instructor_course_store" method="POST" enctype="multipart/form-data"
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 space-y-6">
                    <div>
                        <label for="course_title" class="block text-gray-700 mb-2">Tên khóa học *</label>
                        <input type="text" id="course_title" name="title" required
                            class="w-full px-4 py-3 border rounded-lg"
                            placeholder="Ví dụ: Lập trình React từ cơ bản đến nâng cao" />
                    </div>
                    <div>
                        <label for="course_description" class="block text-gray-700 mb-2">Mô tả ngắn *</label>
                        <textarea rows="4" id="course_description" name="description" required
                            class="w-full px-4 py-3 border rounded-lg"
                            placeholder="Mô tả ngắn gọn về khóa học..."></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="course_category" class="block text-gray-700 mb-2">Danh mục *</label>
                            <select id="course_category" name="category_id" required
                                class="w-full px-4 py-3 border rounded-lg">
                                <option value="">Chọn danh mục</option>
                                <option value="1">Lập trình</option>
                                <option value="2">Marketing</option>
                                <option value="3">Thiết kế</option>
                            </select>
                        </div>

                        <div>
                            <label for="course_level" class="block text-gray-700 mb-2">Trình độ *</label>
                            <select id="course_level" name="level" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="Basic">Cơ bản</option>
                                <option value="Intermediate">Trung cấp</option>
                                <option value="Advanced">Nâng cao</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="course_price" class="block text-gray-700 mb-2">Giá (VNĐ) *</label>
                            <input type="number" id="course_price" name="price" required min="0"
                                class="w-full px-4 py-3 border rounded-lg" placeholder="999000" />
                        </div>

                        <div>
                            <label for="course_duration" class="block text-gray-700 mb-2">Thời lượng *</label>
                            <input type="text" id="course_duration" name="duration" required
                                class="w-full px-4 py-3 border rounded-lg" placeholder="10 giờ" />
                        </div>
                    </div>

                    <div>
                        <label for="course_thumbnail" class="block text-gray-700 mb-2">Ảnh đại diện khóa học</label>
                        <input type="file" id="course_thumbnail" name="thumbnail" accept="image/*" class="hidden">
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer"
                            onclick="document.getElementById('course_thumbnail').click()">
                            <div class="text-gray-400 mb-2">Kéo thả ảnh hoặc click để chọn</div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <button type="button" data-action="back-to-courses" data-tab-target="courses"
                            class="px-6 py-3 border rounded-lg hover:bg-gray-50">
                            Hủy
                        </button>
                        <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Tạo khóa học
                        </button>
                    </div>
                </form>
            </div>

            <div id="students-list" class="tab-content hidden">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Danh sách học viên</h2>
                <div class="bg-white rounded-xl shadow p-12 text-center">
                    <p class="text-lg text-gray-600">Nội dung quản lý học viên sẽ hiển thị ở đây.</p>
                </div>
            </div>

            <div id="lesson-manager" class="tab-content space-y-8 hidden">
                <button data-action="back-to-courses" data-tab-target="courses"
                            class="text-blue-600 hover:underline">&larr; Quay lại</button>
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-4">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Quản lý bài học — <span id="lesson-course-title" class="text-blue-600"></span>
                        </h2>
                    </div>
                    <button data-action="show-add-lesson-modal" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl">
                        + Thêm bài học mới
                    </button>
                </div>

                <div id="lesson-list-content" class="bg-white rounded-2xl shadow-lg p-6">
                    <?php foreach ($lessons as $lesson):?>
                    <p>Danh sách bài học của khóa học hiện tại </p>
                    <?php endforeach;?>
                </div>
            </div>

        </div>

        <div id="add-lesson-modal"
            class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl m-4 transform transition-all scale-100">
                <form id="form-add-lesson" method="POST" action="index.php?route=instructor_lesson_store">
                    <div class="flex justify-between items-center p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900">
                            Thêm Bài Học — <span id="modal-course-title" class="text-blue-600"></span>
                        </h3>
                        <button type="button" data-close-modal
                            class="text-gray-400 hover:text-gray-700 text-3xl font-light leading-none">&times;</button>
                    </div>

                    <div class="p-6 space-y-6">
                        <input type="hidden" id="modal-course-id" name="course_id" value="">

                        <div>
                            <label for="lesson_title" class="block text-gray-700 mb-2 font-medium">Tiêu đề bài học
                                *</label>
                            <input type="text" id="lesson_title" name="title" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                        </div>

                        <div>
                            <label for="lesson_content" class="block text-gray-700 mb-2 font-medium">Nội dung bài học
                                (Content) *</label>
                            <textarea rows="6" id="lesson_content" name="content" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Nhập nội dung chi tiết của bài học..."></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="lesson_video_url" class="block text-gray-700 mb-2 font-medium">URL Video
                                    (Video_URL)</label>
                                <input type="url" id="lesson_video_url" name="video_url"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
                            </div>

                            <div>
                                <label for="lesson_order" class="block text-gray-700 mb-2 font-medium">Thứ tự (Order)
                                    *</label>
                                <input type="number" id="lesson_order" name="lesson_order" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    min="1" />
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
                        <button type="button" data-close-modal
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Hủy</button>
                        <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700">Lưu Bài
                            Học</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('#instructor-tabs .tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            const createCourseButton = document.querySelector('[data-action="show-create-tab"]');
            const backToCourseButtons = document.querySelectorAll('[data-action="back-to-courses"]');
            const openLessonButtons = document.querySelectorAll('[data-action="open-lesson-tab"]');
            const lessonCourseTitle = document.getElementById('lesson-course-title');
            const modalCourseId = document.getElementById('modal-course-id');
            const modalCourseTitle = document.getElementById('modal-course-title');
            const addLessonModal = document.getElementById('add-lesson-modal');
            const closeModals = document.querySelectorAll('[data-close-modal]');
            const showAddLessonModalButton = document.querySelector('[data-action="show-add-lesson-modal"]');

            // --- Hàm chung cho việc chuyển tab ---
            function switchTab(targetTabId) {
                // 1. Ẩn tất cả nội dung và reset tab button
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    // Loại bỏ class 'tab-active' nếu bạn có dùng nó để ẩn/hiện, nhưng hiện tại dùng 'hidden'
                });
                tabButtons.forEach(button => {
                    button.classList.remove('border-blue-600', 'text-gray-900');
                    button.classList.add('border-transparent', 'text-gray-600', 'hover:text-gray-900');
                });

                // 2. Hiển thị nội dung tab mục tiêu
                const targetContent = document.getElementById(targetTabId);
                if (targetContent) {
                    targetContent.classList.remove('hidden');
                    targetContent.classList.add('tab-active'); // Giữ lại lớp tab-active nếu cần CSS phức tạp hơn

                    // 3. Đánh dấu nút tab mục tiêu là active
                    const targetButton = document.querySelector(`.tab-button[data-tab="${targetTabId}"]`);
                    if (targetButton) {
                        targetButton.classList.add('border-blue-600', 'text-gray-900');
                        targetButton.classList.remove('border-transparent', 'text-gray-600', 'hover:text-gray-900');
                    }
                }
            }

            // --- Sự kiện click vào các nút Tab trên thanh nav ---
            tabButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const targetTab = this.getAttribute('data-tab');
                    switchTab(targetTab);
                });
            });

            // --- Sự kiện nút "Tạo khóa học mới" (Trong tab Quản lý khóa học) ---
            createCourseButton.addEventListener('click', function () {
                const targetTab = this.getAttribute('data-tab-target'); // 'create-course'
                switchTab(targetTab);
            });

            // --- Sự kiện nút "Quay lại" / "Hủy" (Trong form Tạo khóa học/Quản lý bài học) ---
            backToCourseButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const targetTab = this.getAttribute('data-tab-target'); // 'courses'
                    switchTab(targetTab);
                });
            });

            // --- Sự kiện nút "Quản lý bài học" (Trong danh sách khóa học) ---
            openLessonButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const courseId = this.getAttribute('data-course-id');
                    const courseTitle = this.getAttribute('data-course-title');
                    const targetTab = this.getAttribute('data-tab-target'); // 'lesson-manager'

                    // 1. Cập nhật tiêu đề trong tab Quản lý bài học
                    lessonCourseTitle.textContent = courseTitle;

                    modalCourseId.value = courseId;
                    modalCourseTitle.textContent = courseTitle;

                    switchTab(targetTab);


                });

                // --- Sự kiện Modal ---
                showAddLessonModalButton.addEventListener('click', function () {
                    addLessonModal.classList.remove('hidden');
                    addLessonModal.classList.add('flex');
                });

                closeModals.forEach(button => {
                    button.addEventListener('click', function () {
                        addLessonModal.classList.add('hidden');
                        addLessonModal.classList.remove('flex');
                    });
                });


                if (!document.querySelector('.tab-content.tab-active')) {
                    switchTab('courses');
                } else {
                    // Lấy tab active hiện tại và cập nhật button (để xử lý trường hợp URL có tham số)
                    const activeContentId = document.querySelector('.tab-content.tab-active').id;
                    const activeTabButton = document.querySelector(`.tab-button[data-tab="${activeContentId}"]`);
                    if (activeTabButton) {
                        activeTabButton.classList.add('border-blue-600', 'text-gray-900');
                        activeTabButton.classList.remove('border-transparent', 'text-gray-600', 'hover:text-gray-900');
                    }
                }
            }
            );
        }
        )
    </script>

    <?php require ROOT_PATH . '/views/includes/footer.php'; ?>