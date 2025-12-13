<?php
// views/instructor/students/list.php
// expects $students
?>
<div class="mb-6">
  <h2 class="text-2xl font-bold">Danh sách học viên</h2>
</div>

<div class="bg-white rounded-lg p-4">
  <div class="overflow-x-auto">
    <table class="w-full">
      <thead class="bg-gray-100 text-left">
        <tr>
          <th class="px-4 py-3">Họ tên</th>
          <th class="px-4 py-3">Email</th>
          <th class="px-4 py-3">Số khóa học</th>
          <th class="px-4 py-3">Ngày tham gia</th>
          <th class="px-4 py-3">Trạng thái</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        <?php foreach ($students as $s): ?>
          <tr>
            <td class="px-4 py-3"><?= htmlspecialchars($s['fullname'] ?? ($s['username'] ?? '')) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars($s['email'] ?? '') ?></td>
            <td class="px-4 py-3 text-center"><?= htmlspecialchars($s['courses_count'] ?? 1) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars(date('d/m/Y', strtotime($s['enrolled_date'] ?? ($s['created_at'] ?? date('Y-m-d'))))) ?></td>
            <td class="px-4 py-3"><span class="px-3 py-1 rounded bg-emerald-100 text-emerald-700"><?= htmlspecialchars($s['status'] ?? 'Hoạt động') ?></span></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
