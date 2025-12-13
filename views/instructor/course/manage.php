<?php
// views/instructor/course/manage.php
// expects $course, $lessons
?>
<div class="mb-6">
  <h2 class="text-2xl font-bold">Quản lý khóa học — <?= htmlspecialchars($course['title']) ?></h2>
  <div class="flex gap-4 mt-4">
    <a href="<?= BASE_URL ?>/instructor/create_lesson/<?= $course['id'] ?>" class="px-4 py-2 bg-blue-600 text-white rounded">Thêm bài học</a>
    <a href="<?= BASE_URL ?>/instructor/students/<?= $course['id'] ?>" class="px-4 py-2 border rounded">Danh sách học viên</a>
  </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
  <?php if (empty($lessons)): ?>
    <p>Chưa có bài học nào.</p>
  <?php else: ?>
    <ul class="divide-y">
      <?php foreach ($lessons as $l): ?>
        <li class="py-4 flex justify-between items-center">
          <div>
            <strong><?= htmlspecialchars($l['title']) ?></strong>
            <div class="text-sm text-gray-500">Thứ tự: <?= htmlspecialchars($l['order']) ?> • <?= htmlspecialchars($l['video_url']) ? 'Có video' : 'Không video' ?></div>
          </div>
          <div class="flex gap-2">
            <a href="<?= BASE_URL ?>/instructor/edit_lesson/<?= $l['id'] ?>" class="px-3 py-1 border rounded">Sửa</a>
            <a href="<?= BASE_URL ?>/instructor/delete_lesson/<?= $l['id'] ?>" class="px-3 py-1 border rounded text-red-600" onclick="return confirm('Xóa bài học?')">Xóa</a>
            <a href="<?= BASE_URL ?>/instructor/upload_material/<?= $l['id'] ?>?course=<?= $course['id'] ?>" class="px-3 py-1 border rounded">Tải tài liệu</a>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>
