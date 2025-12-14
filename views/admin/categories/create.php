<?php $pageTitle = "Thêm danh mục mới"; ?>
<?php include ROOT_PATH . '/views/includes/header.php'; ?>

<div class="max-w-2xl mx-auto py-12">
    <h1 class="text-3xl font-bold mb-8">Thêm danh mục mới</h1>

    <form action="index.php?route=admin_category_store" method="POST" class="bg-white rounded-xl shadow-sm p-8 space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tên danh mục <span class="text-red-500">*</span></label>
            <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mô tả</label>
            <textarea name="description" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                Thêm danh mục
            </button>
            <a href="index.php?route=admin_dashboard" class="px-8 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                Hủy
            </a>
        </div>
    </form>
</div>

<?php include ROOT_PATH . '/views/includes/footer.php'; ?>