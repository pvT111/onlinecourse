<?php $pageTitle = "Chỉnh sửa người dùng"; 
 include ROOT_PATH . '/views/includes/header.php'; ?>
<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Chỉnh sửa người dùng</h1>
    </div>

    <!-- Hiển thị thông báo -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <?= $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <form action="index.php?route=admin_user_update" method="POST" class="space-y-8">
        <p class="text-sm text-gray-500">
</p>

            <!-- Thông tin hiển thị (không chỉnh sửa được) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-lg">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">ID tài khoản</label>
                    <p class="text-lg font-semibold text-gray-900"><?= $user['id'] ?></p>

                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Ngày tham gia</label>
                    <p class="text-lg font-semibold text-gray-900">
                        <?= date('d/m/Y H:i', strtotime($user['created_at'])) ?>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Họ và tên</label>
                    <p class="text-lg font-semibold text-gray-900">
                        <?= htmlspecialchars($user['fullname'] ?? 'Chưa đặt tên') ?>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email (đăng nhập)</label>
                    <p class="text-lg font-semibold text-gray-900">
                        <?= htmlspecialchars($user['email']) ?>
                    </p>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $user['id'] ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Vai trò <span class="text-red-500">*</span>
                    </label>
                    <select name="role" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <<option value="0" <?= $user['role'] == 0 ? 'selected' : '' ?>>Học viên</option>
                            <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>Giảng viên</option>
                            <option value="2" <?= $user['role'] == 2 ? 'selected' : '' ?>>Quản trị viên</option>
                    </select>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="flex justify-end gap-4 pt-8 border-t border-gray-200">
                <a href="index.php?route=admin_dashboard"
                    class="px-8 py-3 bg-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-400 transition">
                    Hủy bỏ
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:opacity-90 transition shadow-md">
                    Cập nhật thông tin
                </button>
            </div>
        </form>
    </div>

    <!-- Cảnh báo nếu đang chỉnh sửa chính mình -->
    <?php if ($user['id'] == $_SESSION['user_id']): ?>
        <div class="mt-8 p-6 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800">
            <strong>Lưu ý:</strong> Bạn đang chỉnh sửa chính tài khoản của mình.
            Hệ thống sẽ không cho phép khóa tài khoản hoặc thay đổi vai trò gây mất quyền truy cập.
        </div>
    <?php endif; ?>
    </div>

    <?php include ROOT_PATH . '/views/includes/footer.php'; ?>