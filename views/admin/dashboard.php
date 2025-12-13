<?php
$pageTitle = "Admin Dashboard";
include ROOT_PATH . '/views/includes/header.php';
?>
<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-gray-900 mb-2 text-2xl font-bold">Bảng điều khiển quản trị</h1>
        </div>

        <!-- Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <div class="flex gap-8 overflow-x-auto" id="admin-tabs">
                    <button data-tab="users"
                        class="tab-button pb-4 px-1 border-b-2 border-blue-600 text-gray-900 whitespace-nowrap transition-colors">Người
                        dùng</button>
                    <button data-tab="courses"
                        class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap transition-colors">Khóa
                        học</button>
                    <button data-tab="categories"
                        class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap transition-colors">Danh
                        mục</button>
                    <button data-tab="pending"
                        class="tab-button pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 whitespace-nowrap transition-colors">Chờ
                        duyệt</button>
                </div>
            </div>
        </div>

        <!-- ==================== Users Tab ==================== -->
        <div id="users" class="tab-content space-y-6 mt-8">
            <div class="flex justify-end items-center">
                <div class="flex gap-3">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600">
                        <option>Tất cả vai trò</option>
                        <option>Học viên</option>
                        <option>Giảng viên</option>
                        <option>Admin</option>
                    </select>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-6 text-gray-600">Tên</th>
                                <th class="text-left py-3 px-6 text-gray-600">Email</th>
                                <th class="text-left py-3 px-6 text-gray-600">Vai trò</th>
                                <th class="text-left py-3 px-6 text-gray-600">Trạng thái</th>
                                <th class="text-left py-3 px-6 text-gray-600">Ngày tham gia</th>
                                <th class="text-left py-3 px-6 text-gray-600">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 text-gray-900">Nguyễn Văn A</td>
                                <td class="py-4 px-6 text-gray-600">a@example.com</td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">Học viên</span>
                                </td>
                                <td class="py-4 px-6">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer" readonly>
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </td>
                                <td class="py-4 px-6 text-gray-600">01/01/2025</td>
                                <td class="py-4 px-6">
                                    <div class="flex gap-2">
                                        <button class="p-2 hover:bg-gray-100 rounded transition-colors">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 4h2M4 11h16M4 19h16" />
                                            </svg>
                                        </button>
                                        <button class="p-2 hover:bg-red-100 rounded transition-colors">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ==================== Courses Tab ==================== -->
        <div id="courses" class="tab-content space-y-6 mt-8 hidden">
            <div class="flex justify-end items-center">
                
                <select class="px-4 py-2 border border-gray-300 rounded-lg text-white bg-gradient-to-r from-blue-600 to-purple-600">
                    <option>Tất cả trạng thái</option>
                    <option>Đã duyệt</option>
                    <option>Chờ duyệt</option>
                    <option>Từ chối</option>
                </select>
            </div>

            <div class="grid gap-4">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-900 mb-1">JavaScript nâng cao</h3>
                        <p class="text-gray-600 mb-2">Khóa học nâng cao về JavaScript...</p>
                        <div class="flex items-center gap-4 text-gray-600">
                            <span>Giảng viên: Trần Thị B</span>
                            <span>•</span>
                            <span>Lập trình</span>
                            <span>•</span>
                            <span>20 bài học</span>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full">Đã duyệt</span>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-900 mb-1">React cơ bản</h3>
                        <p class="text-gray-600 mb-2">Khóa học về React JS cơ bản...</p>
                        <div class="flex items-center gap-4 text-gray-600">
                            <span>Giảng viên: Nguyễn Văn C</span>
                            <span>•</span>
                            <span>Lập trình</span>
                            <span>•</span>
                            <span>15 bài học</span>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full">Chờ duyệt</span>
                </div>

                <!-- Thêm các khóa học khác tương tự -->
            </div>
        </div>
        <!-- ==================== Chờ duyệt Tab ==================== -->
        <div id="pending" class="tab-content space-y-6 mt-8 hidden">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Pending Course 1 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h3 class="text-gray-900 mb-1">JavaScript Cơ bản</h3>
                                    <p class="text-gray-600 mb-2 line-clamp-2">Khóa học cơ bản về JavaScript...</p>
                                    <div class="flex items-center gap-4 text-gray-600">
                                        <span>Giảng viên: Nguyễn Văn A</span>
                                        <span>•</span>
                                        <span>Lập trình</span>
                                        <span>•</span>
                                        <span>12 bài học</span>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full ml-4">Chờ duyệt</span>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <button
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12H9m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                    Xem xét
                                </button>
                            </div>
                        </div>

                        <!-- Pending Course 2 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h3 class="text-gray-900 mb-1">React nâng cao</h3>
                                    <p class="text-gray-600 mb-2 line-clamp-2">Khóa học nâng cao về React JS...</p>
                                    <div class="flex items-center gap-4 text-gray-600">
                                        <span>Giảng viên: Trần Thị B</span>
                                        <span>•</span>
                                        <span>Lập trình</span>
                                        <span>•</span>
                                        <span>18 bài học</span>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full ml-4">Chờ duyệt</span>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <button
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12H9m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                    Xem xét
                                </button>
                            </div>
                        </div>

                        <!-- Có thể thêm các khóa học khác tương tự -->
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== Danh mục Tab ==================== -->
        <div id="categories" class="tab-content space-y-6 mt-8 hidden">
            <div class="flex justify-end items-center">
                <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Thêm
                    danh
                    mục</button>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-6 text-gray-600">Tên danh mục</th>
                                <th class="text-left py-3 px-6 text-gray-600">Mô tả</th>
                                <th class="text-left py-3 px-6 text-gray-600">Số khóa học</th>
                                <th class="text-left py-3 px-6 text-gray-600">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Category 1 -->
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 text-gray-900">Lập trình web</td>
                                <td class="py-4 px-6 text-gray-600">Các khóa học về HTML, CSS, JS</td>
                                <td class="py-4 px-6 text-gray-600">12</td>
                                <td class="py-4 px-6">
                                    <div class="flex gap-2">
                                        <button class="p-2 hover:bg-gray-100 rounded transition-colors">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 4h2M4 11h16M4 19h16" />
                                            </svg>
                                        </button>
                                        <button class="p-2 hover:bg-red-100 rounded transition-colors">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Category 2 -->
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-6 text-gray-900">Thiết kế</td>
                                <td class="py-4 px-6 text-gray-600">Các khóa học về UX/UI, Photoshop</td>
                                <td class="py-4 px-6 text-gray-600">8</td>
                                <td class="py-4 px-6">
                                    <div class="flex gap-2">
                                        <button class="p-2 hover:bg-gray-100 rounded transition-colors">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 4h2M4 11h16M4 19h16" />
                                            </svg>
                                        </button>
                                        <button class="p-2 hover:bg-red-100 rounded transition-colors">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/views/includes/footer.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetTabId = button.getAttribute('data-tab');

                    // Ẩn tất cả nội dung tab
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Xóa trạng thái active khỏi tất cả nút
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-blue-600', 'text-gray-900');
                        btn.classList.add('border-transparent', 'text-gray-600', 'hover:text-gray-900');
                    });

                    // Hiển thị nội dung tab được chọn
                    const activeContent = document.getElementById(targetTabId);
                    if (activeContent) {
                        activeContent.classList.remove('hidden');
                    }

                    // Đặt trạng thái active cho nút được chọn
                    button.classList.add('border-blue-600', 'text-gray-900');
                    button.classList.remove('border-transparent', 'text-gray-600', 'hover:text-gray-900');
                });
            });
        });
    </script>