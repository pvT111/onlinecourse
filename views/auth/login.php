<?php $pageTitle = "Đăng nhập - LearnHub"; ?>
<?php include ROOT_PATH . '/views/includes/header.php'; ?>

<div class="min-h-screen bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center px-4">
    <div class="w-full max-w-96">/
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-5 text-center">
                <i class="fas fa-book-open text-4xl mb-4"></i>
                <h2 class="text-2xl font-bold">Đăng nhập</h2>
            </div>

            <div class="p-8">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?route=login">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" placeholder="you@email.com">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Mật khẩu</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" placeholder="••••••••">
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-4 rounded-lg hover:opacity-90 transition">
                        Đăng nhập
                    </button>
                </form>

                <p class="text-center mt-6 text-gray-600">
                    Chưa có tài khoản? <a href="index.php?route=register" class="text-purple-600 font-bold hover:underline">Đăng ký ngay</a>
                </p>
            </div>
            <div style="background: #f9fafb; padding: 1rem; text-align: center; border-top: 1px solid #e5e7eb;">
                <a href="index.php" style="color: #6b7280; text-decoration: none; font-size: 0.875rem;">
                 <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i>
                    Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

