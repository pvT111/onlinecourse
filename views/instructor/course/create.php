<?php
// views/instructor/course/create.php
// expects $categories
?>
<div class="max-w-4xl mx-auto">
  <h2 class="text-2xl font-bold mb-6">Tạo khóa học mới</h2>
  <form action="<?= BASE_URL ?>/instructor/store" method="post" class="bg-white rounded-lg p-6 space-y-4">
    <div>
      <label class="block text-gray-700">Tên khóa học *</label>
      <input name="title" type="text" required class="w-full px-4 py-3 border rounded-lg"/>
    </div>
    <div>
      <label class="block text-gray-700">Mô tả</label>
      <textarea name="description" rows="4" class="w-full px-4 py-3 border rounded-lg"></textarea>
    </div>
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label>Danh mục</label>
        <select name="category_id" class="w-full px-4 py-3 border rounded-lg">
          <option value="">Chọn danh mục</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label>Trình độ</label>
        <select name="level" class="w-full px-4 py-3 border rounded-lg">
          <option value="Beginner">Cơ bản</option>
          <option value="Intermediate">Trung cấp</option>
          <option value="Advanced">Nâng cao</option>
        </select>
      </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label>Giá (VNĐ)</label>
        <input name="price" type="number" class="w-full px-4 py-3 border rounded-lg" />
      </div>
      <div>
        <label>Thời lượng (tuần)</label>
        <input name="duration_weeks" type="number" class="w-full px-4 py-3 border rounded-lg" />
      </div>
    </div>

    <div class="flex justify-end">
      <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg">Tạo</button>
    </div>
  </form>
</div>
