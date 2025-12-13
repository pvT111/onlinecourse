<?php 
$pageTitle = "Đăng ký tài khoản - LearnHub";
include ROOT_PATH . '/views/includes/header.php'; 
?>

<div class="min-h-screen bg-white flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-96">
        <!-- Card chính -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header gradient -->
            <div class="bg-purple-600 text-white px-5 py-6 text-center">
                <i class="fas fa-user-plus text-4xl mb-4"></i>
                <h2 class="text-2xl font-bold mb-2">Đăng ký</h2>
               
            </div>

            <!-- Form -->
            <div class="px-10 py-8">
                <!-- Thông báo lỗi / thành công -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                        <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                        <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?route=register" id="registerForm">
                    <!-- Họ và tên -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Họ và tên</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="fullname" required placeholder="Nguyễn Văn A"
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" name="email" required placeholder="your@email.com"
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                        </div>
                    </div>

                    <!-- Mật khẩu -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Mật khẩu</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" name="password" id="password" required minlength="6" placeholder="••••••••"
                                class="w-full pl-12 pr-14 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <button type="button" id="togglePassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Tối thiểu 6 ký tự</p>
                    </div>

                    <!-- Xác nhận mật khẩu -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Xác nhận mật khẩu</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" name="confirm_password" id="confirmPassword" required placeholder="••••••••"
                                class="w-full pl-12 pr-14 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <button type="button" id="toggleConfirmPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Chọn vai trò -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-3">Bạn muốn</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-purple-500 transition has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50">
                                <input type="radio" name="role" value="student" checked class="mr-3">
                                <i class="fas fa-graduation-cap text-xl mr-3 text-purple-600"></i>
                                <span class="font-medium">Học tập</span>
                            </label>
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-purple-500 transition has-[:checked]:border-purple-500 has-[:checked]:bg-purple-50">
                                <input type="radio" name="role" value="instructor" class="mr-3">
                                <i class="fas fa-chalkboard-teacher text-xl mr-3 text-blue-600"></i>
                                <span class="font-medium">Giảng dạy</span>
                            </label>
                        </div>
                    </div>

                    <!-- Đồng ý điều khoản -->
                    <div class="mb-8">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="terms" required class="mt-1">
                            <span class="text-sm text-gray-600">
                                Tôi đồng ý với <a href="#" class="text-purple-600 hover:underline">Điều khoản dịch vụ</a> và 
                                <a href="#" class="text-purple-600 hover:underline">Chính sách bảo mật</a>
                            </span>
                        </label>
                    </div>

                    <!-- Nút đăng ký -->
                    <button type="submit"
                        class="w-full bg-purple-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 rounded-lg transition transform hover:scale-105 shadow-lg">
                        <i class="fas fa-user-plus mr-2"></i>
                        Đăng ký 
                    </button>

                    <!-- Đã có tài khoản -->
                    <p class="text-center mt-8 text-gray-600">
                        Đã có tài khoản? 
                        <a href="index.php?route=login" class="font-bold text-purple-600 hover:underline">Đăng nhập</a>
                    </p>
                </form>
            </div>

            <!-- Footer card -->
            <div class="bg-gray-50 px-10 py-6 text-center border-t">
                <a href="<?= BASE_URL ?>/" class="text-gray-600 hover:text-gray-900 flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JS Toggle Password -->
<script>
    document.getElementById('togglePassword')?.addEventListener('click', function () {
        const field = document.getElementById('password');
        const icon = this.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    document.getElementById('toggleConfirmPassword')?.addEventListener('click', function () {
        const field = document.getElementById('confirmPassword');
        const icon = this.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
</script>

