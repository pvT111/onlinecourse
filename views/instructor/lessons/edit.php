<?php
// views/instructor/lessons/edit.php
// expects $lesson
?>
<div class="max-w-3xl mx-auto">
  <h2 class="text-2xl font-bold mb-4">Chỉnh sửa bài học</h2>
  <form action="<?= BASE_URL ?>/instructor/update_lesson/<?= $lesson['id'] ?>" method="post" class="bg-white p-6 rounded-lg">
    <input type="hidden" name="course_id" value="<?= htmlspecialchars($lesson['course_id']) ?>">
    <div>
      <label>Tiêu đề *</label>
      <input name="title" required class="w-full px-4 py-3 border rounded-lg" value="<?= htmlspecialchars($lesson['title']) ?>" />
    </div>
    <div class="mt-4">
      <label>Nội dung</label>
      <textarea name="content" rows="6" class="w-full px-4 py-3 border rounded-lg"><?= htmlspecialchars($lesson['content']) ?></textarea>
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4">
      <div>
        <label>URL Video</label>
        <input name="video_url" class="w-full px-4 py-3 border rounded-lg" value="<?= htmlspecialchars($lesson['video_url']) ?>" />
      </div>
      <div>
        <label>Thứ tự</label>
        <input name="order" type="number" min="1" value="<?= htmlspecialchars($lesson['order']) ?>" class="w-full px-4 py-3 border rounded-lg" />
      </div>
    </div>
    <div class="mt-4 flex justify-end">
      <button class="px-6 py-3 bg-blue-600 text-white rounded">Lưu thay đổi</button>
    </div>
  </form>
</div>
