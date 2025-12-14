<?php $pageTitle = "Bảng điều khiển quản trị"; ?>
<?php include ROOT_PATH . '/views/includes/header.php'; ?>

<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Bảng điều khiển quản trị</h1>
        </div>

        <!-- Tabs -->
        <div class="mb-6 border-b border-gray-200">
            <div class="flex gap-8 overflow-x-auto">
                <button data-tab="users"
                    class="tab-button pb-4 px-1 border-b-4 border-blue-600 text-blue-600 font-medium">
                    Người dùng
                </button>
                <button data-tab="categories"
                    class="tab-button pb-4 px-1 border-b-4 border-transparent text-gray-600 hover:text-gray-900">
                    Danh mục khóa học
                </button>
            </div>
        </div>

        <!-- Tab Người dùng -->
        <div id="users" class="tab-content">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Danh sách người dùng</h2>
                <a href="index.php?route=admin_user_create"
                    class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-xl hover:opacity-90 transition shadow-md">
                    Thêm người dùng mới
                </a>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">

                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">ID</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">Họ tên</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">Email</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">Vai trò</th>

                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">Ngày tham gia</th>
                                <th class="text-center py-4 px-6 text-sm font-medium text-gray-700">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($users as $user): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6"><?= $user['id'] ?></td>
                                    <td class="py-4 px-6"><?= htmlspecialchars($user['fullname'] ?? 'Chưa đặt tên') ?></td>
                                    <td class="py-4 px-6"><?= htmlspecialchars($user['email']) ?></td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="px-3 py-1 text-xs font-medium rounded-full
                                        <?= $user['role'] === 'admin' ? 'bg-red-100 text-red-800' :
                                            ($user['role'] === 'instructor' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') ?>">
                                            <?= ucfirst($user['role'] ?? 'student') ?>
                                        </span>
                                    </td>

                                    <td class="py-4 px-6"><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-3">
                                            <!-- Nút chỉnh sửa -->
                                            <a href="index.php?route=admin_user_edit&id=<?= $user['id'] ?>"
                                                class="p-2 bg-blue-100 hover:bg-blue-200 rounded-lg transition"
                                                title="Chỉnh sửa">
                                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <!-- Nút xóa -->
                                            <form action="index.php?route=admin_user_delete" method="POST" class="inline"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?\nTất cả dữ liệu liên quan (nếu có) sẽ bị ảnh hưởng.');">
                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                <button type="submit"
                                                    class="p-2 bg-red-100 hover:bg-red-200 rounded-lg transition"
                                                    title="Xóa">
                                                    <svg class="w-5 h-5 text-red-700" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2.202 2.202 0 0116.138 21H7.862a2.202 2.202 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
        </div>

        <!-- Tab Danh mục -->
        <div id="categories" class="tab-content hidden">
            <div class="flex justify-end mb-6">
                <a href="index.php?route=admin_category_create"
                    class="px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white font-semibold rounded-xl hover:opacity-90">
                    + Thêm danh mục mới
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">ID</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">Tên danh mục</th>
                                <th class="text-left py-4 px-6 text-sm font-medium text-gray-700">Mô tả</th>
                                <th class="text-center py-4 px-6 text-sm font-medium text-gray-700">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($categories as $cat): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6"><?= $cat['id'] ?></td>
                                    <td class="py-4 px-6 font-medium"><?= htmlspecialchars($cat['name']) ?></td>
                                    <td class="py-4 px-6 text-gray-600">
                                        <?= htmlspecialchars($cat['description'] ?? 'Chưa có mô tả') ?></td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="index.php?route=admin_category_edit&id=<?= $cat['id'] ?>"
                                                class="p-2 bg-blue-100 hover:bg-blue-200 rounded-lg">
                                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="index.php?route=admin_category_delete" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Xóa danh mục này? Các khóa học liên quan sẽ mất danh mục.');">
                                                <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                                                <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 rounded-lg">
                                                    <svg class="w-5 h-5 text-red-700" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2.202 2.202 0 0116.138 21H7.862a2.202 2.202 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
        </div>
    </div>
</div>

<?php include ROOT_PATH . '/views/includes/footer.php'; ?>

<script>
    // Tab switching
    document.querySelectorAll('[data-tab]').forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.getAttribute('data-tab');

            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
            document.getElementById(target).classList.remove('hidden');

            document.querySelectorAll('[data-tab]').forEach(b => {
                b.classList.remove('border-blue-600', 'text-blue-600');
                b.classList.add('border-transparent', 'text-gray-600');
            });

            btn.classList.add('border-blue-600', 'text-blue-600');
            btn.classList.remove('border-transparent', 'text-gray-600');
        });
    });
</script>