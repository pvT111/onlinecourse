<?php $pageTitle = "Thêm người dùng mới"; ?>
<?php include ROOT_PATH . '/views/includes/header.php'; ?>

<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Thêm người dùng mới</h1>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <form action="index.php?route=admin_user_store" method="POST" class="space-y-8">

            <!-- Thông tin cơ bản -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Họ và tên <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="fullname" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Nguyễn Văn A">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email (làm tài khoản đăng nhập) <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="example@gmail.com">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Mật khẩu <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" required minlength="6"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ít nhất 6 ký tự">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Vai trò</label>
                    <select name="role" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="student">Học viên</option>
                        <option value="instructor">Giảng viên</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </div>    
            </div>


            <!-- Nút hành động -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                <a href="index.php?route=admin_dashboard"
                   class="px-8 py-3 bg-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-400 transition">
                    Hủy bỏ
                </a>
                <button type="submit"
                        class="px-8 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:opacity-90 transition shadow-md">
                    Tạo tài khoản mới
                </button>
            </div>
        </form>
    </div>
</div>

<?php include ROOT_PATH . '/views/includes/footer.php'; ?>