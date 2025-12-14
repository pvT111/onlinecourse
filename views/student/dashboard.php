<?php $pageTitle = "Học tập của tôi"; ?>
<?php include ROOT_PATH . '/views/includes/header.php'; ?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Học tập của tôi</h1>
            <p class="text-gray-600 mt-2">Theo dõi tiến độ và tiếp tục các khóa học của bạn</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
                <p class="text-3xl font-bold text-blue-600"><?= $stats['enrolled'] ?? 0 ?></p>
                <p class="text-gray-600 mt-2">Khóa học đang học</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
                <p class="text-3xl font-bold text-green-600"><?= $stats['completed'] ?? 0 ?></p>
                <p class="text-gray-600 mt-2">Đã hoàn thành</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
                <p class="text-3xl font-bold text-purple-600"><?= $stats['hours'] ?? '0' ?></p>
                <p class="text-gray-600 mt-2">Tổng giờ học</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
                <p class="text-3xl font-bold text-orange-600"><?= $stats['certificates'] ?? 0 ?></p>
                <p class="text-gray-600 mt-2">Chứng chỉ</p>
            </div>
        </div>

        <!-- Danh sách khóa học -->
        <?php if (empty($enrolledCourses)): ?>
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <p class="text-gray-500 text-lg mb-6">Bạn chưa đăng ký khóa học nào.</p>
                <a href="index.php?route=courses" class="px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Khám phá khóa học ngay
                </a>
            </div>
        <?php else: ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($enrolledCourses as $course): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl transition">
                        <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 relative">
                            <?php if (!empty($course['image']) && $course['image'] !== 'default.jpg'): ?>
                                <img src="<?= BASE_URL ?>uploads/courses/<?= htmlspecialchars($course['image']) ?>"
                                     alt="<?= htmlspecialchars($course['title']) ?>"
                                     class="w-full h-full object-cover">
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-black/30"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="bg-white/95 backdrop-blur rounded-lg p-4">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-700 font-medium">Tiến độ</span>
                                        <span class="font-bold"><?= $course['progress'] ?? 0 ?>%</span>
                                    </div>
                                    <div class="w-full bg-gray-300 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-3 rounded-full" style="width: <?= $course['progress'] ?? 0 ?>%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <span class="inline-block px-4 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full mb-3">
                                <?= htmlspecialchars($course['category_name'] ?? 'Chưa phân loại') ?>
                            </span>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3"><?= htmlspecialchars($course['title']) ?></h3>
                            <p class="text-sm text-gray-500 mb-6">
                                Truy cập lần cuối: <?= date('d/m/Y', strtotime($course['last_accessed'] ?? 'now')) ?>
                            </p>
                            <a href="index.php?route=student_course_process&id=<?= $course['id'] ?>"
                               class="block text-center py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:opacity-90 transition">
                                Tiếp tục học →
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include ROOT_PATH . '/views/includes/footer.php'; ?>