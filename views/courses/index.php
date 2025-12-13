<?php

$pageTitle = "Danh sách khóa học ";
include ROOT_PATH . '/views/includes/header.php';
?>

<div class="min-h-screen bg-gray-50 py-8">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-8">
      <h1 class="text-gray-900 mb-2 text-2xl font-semibold">Khám phá khóa học</h1>
      <p class="text-gray-600">Tìm khóa học phù hợp với mục tiêu của bạn</p>
    </div>

    <div class="mb-6">
      <div class="relative">
        <input id="searchInput" type="text" placeholder="Tìm kiếm khóa học..."
          class="w-full pl-4 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
      </div>
    </div>

    <div class="flex gap-8">

      <div class="w-64 flex-shrink-0">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 sticky top-24">

          <h3 class="text-gray-900 mb-6 font-medium">Bộ lọc</h3>

          <div class="mb-6">
            <label for="categorySelect" class="block text-gray-700 mb-3 font-medium">Danh mục</label>
            <select id="categorySelect" name="category"
              class="w-full pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700">

              <option value="">-- Tất cả Danh mục --</option>

              <?php foreach ($categorys as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>">
                  <?= htmlspecialchars($category['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-6">
            <label class="block text-gray-700 mb-3 font-medium">Trình độ</label>
            <div id="levelFilter" class="space-y-2">
              <?php
              // BƯỚC 1: LỌC CÁC LEVEL DUY NHẤT TRƯỚC VÒNG LẶP
              $all_levels = array_column($courses, 'level');
              $unique_levels = array_unique($all_levels);
              ?>

              <?php foreach ($unique_levels as $level): ?>
                <label class="flex items-center space-x-2">
                  <input type="radio" name="level" value="<?= htmlspecialchars($level) ?>"
                    class="text-blue-600 focus:ring-blue-500">

                  <span class="text-gray-700"><?= htmlspecialchars($level) ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>
          <button id="resetBtn" class="w-full py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
            Xóa bộ lọc
          </button>
        </div>
      </div>

      <div class="flex-1">

        <div id="courseCount" class="mb-4 text-gray-600">
          <?php
          $courseCount = count($courses);
          echo "Tìm thấy {$courseCount} khóa học";
          ?>
        </div>

        <div id="courseGrid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

          <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
              <?php
              $displayInstructor = htmlspecialchars($course['instructor_name'] ?? 'Giảng viên');
              $displayCategory = htmlspecialchars($course['category_name'] ?? 'N/A');
              $detailUrl = "index.php?route=course_detail&id=" . htmlspecialchars($course['id']);
              ?>

              <a href="<?= $detailUrl ?>"
                class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-all cursor-pointer border border-gray-200 group block">

                <div class="h-40 bg-purple-600 relative overflow-hidden"></div>

                <div class="p-5">
                  <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-xs"><?= $displayCategory ?></span>
                    <span
                      class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs"><?= htmlspecialchars($course['level']) ?></span>
                  </div>

                  <h3 class="text-gray-900 mb-2 line-clamp-2 min-h-[3rem]"><?= htmlspecialchars($course['title']) ?></h3>

                  <p class="text-gray-600 mb-4 line-clamp-2"><?= htmlspecialchars($course['description']) ?></p>

                  <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <span class="text-gray-700"><?= $displayInstructor ?></span>
                    <span class="text-blue-600 font-semibold">
                      <?= htmlspecialchars($course['price']) ?>
                    </span>
                  </div>
                </div>
              </a>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-span-full text-center py-12">
              <p class="text-gray-500">Không tìm thấy khóa học phù hợp</p>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</div>
<?php include ROOT_PATH . '/views/includes/footer.php'; ?>