<?php

$pageTitle = "Trang chủ";
include  ROOT_PATH   . '/views/includes/header.php';
?>
<!-- Hero Section -->
<section style="background: linear-gradient(to right, #9333ea, #db2777); color: white; padding: 4rem 0;">
    <div class="container">
        <div class="grid grid-cols-2" style="align-items: center; gap: 3rem;">
            <div>
                <h1 style="color: white; margin-bottom: 1.5rem;">Học tập không giới hạn với hàng nghìn khóa học</h1>
                <p style="font-size: 1.125rem; margin-bottom: 2rem; opacity: 0.9;">
                    Khám phá kiến thức mới, nâng cao kỹ năng và phát triển sự nghiệp của bạn với các khóa học chất lượng cao từ các chuyên gia hàng đầu.
                </p>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="#" class="btn" style="background: white; color: var(--primary-color);">Khám phá ngay</a>
                    <a href="#" class="btn" style="background: transparent; border: 2px solid white; color: white;">Tìm hiểu thêm</a>
                </div>
            </div>
            <div style="display: none;">
                <img src="https://images.unsplash.com/photo-1546430498-05c7b929830e?w=600" alt="Online Learning" style="border-radius: 0.5rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
            </div>
        </div>
    </div>
</section>


<!-- Featured Courses -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-semibold text-gray-900">Khóa học nổi bật</h2>
            <a href="index.php?route=courses" class="text-blue-600 hover:underline">Xem tất cả →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Course Card 1 -->
            <?php foreach ($courses as $course ): ?>
            <?php 
                $detailUrl = "index.php?route=course_detail&id=" . htmlspecialchars($course['id']);
            ?>

            <a href="<?= $detailUrl ?>" class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-all cursor-pointer border border-gray-200 group block">
            
                <div class="h-40 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden"></div> 

                <div class="p-5">
                  <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-xs"><?= htmlspecialchars($course['category_name'] ?? 'N/A') ?></span>
                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs"><?= htmlspecialchars($course['level']) ?></span>
                  </div>

                  <h3 class="text-gray-900 mb-2 line-clamp-2 min-h-[3rem]"><?= htmlspecialchars($course['title']) ?></h3>

                  <p class="text-gray-600 mb-4 line-clamp-2"><?= htmlspecialchars($course['description']) ?></p>

                  <div class="flex items-center gap-4 mb-4 text-gray-600">
                    
                    <span>⏳ <?= htmlspecialchars($course['duration_weeks']) ?> Tuần</span>
                  </div>

                  <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <span class="text-gray-700"><?= htmlspecialchars($course['instructor_id']) ?></span>
                    <span class="text-blue-600 font-semibold"><?= htmlspecialchars($course['price']) ?></span>
                  </div>
                </div>
            </a>
          <?php endforeach; ?>
    </div>
</section>

<style>
    @media (max-width: 768px) {
        .grid-cols-2 > div:last-child {
            display: none !important;
        }
    }
    @media (min-width: 1024px) {
        .grid-cols-2 > div:last-child {
            display: block !important;
        }
    }
</style>

<?php include ROOT_PATH . '/views/includes/footer.php'; ?>
