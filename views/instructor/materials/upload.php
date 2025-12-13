<?php
// views/instructor/materials/upload.php
// expects $lesson_id and optionally $_GET['course']
$courseId = $_GET['course'] ?? '';
?>
<div class="max-w-2xl mx-auto">
  <h2 class="text-2xl font-bold mb-4">Tải tài liệu lên</h2>
  <form action="<?= BASE_URL ?>/instructor/store_material" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg">
    <input type="hidden" name="lesson_id" value="<?= htmlspecialchars($lesson_id) ?>">
    <input type="hidden" name="course_id" value="<?= htmlspecialchars($courseId) ?>">
    <div>
      <label>Chọn tệp</label>
      <input type="file" name="file" required class="w-full mt-2" />
    </div>
    <div class="mt-4 flex justify-end">
      <button class="px-6 py-3 bg-blue-600 text-white rounded">Tải lên</button>
    </div>
  </form>
</div>
