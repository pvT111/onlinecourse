<?php 
$pageTitle = "Chi tiết khóa học";
$hideCategories = true;
include  ROOT_PATH   . '/views/includes/header.php';
?>

<div class="bg-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      
      <!-- Back Button -->
      <a href ='index.php?route=courses' class="flex items-center gap-2 text-blue-200 hover:text-white mb-6 transition-colors">
        <span class="w-5 h-5 inline-block">←</span>
        Quay lại danh sách
        </a>

      <div class="grid lg:grid-cols-3 gap-8">

        <!-- Left Column - Course Info -->
        <div class="lg:col-span-2 space-y-4">
          <!-- Category & Level -->
          <div class="flex items-center gap-2 mb-4">
            <span class="px-3 py-1 bg-blue-600 rounded-full">Lập trình</span>
            <span class="px-3 py-1 bg-blue-600 rounded-full">Cơ bản</span>
          </div>

          <!-- Title & Description -->
          <h1 class="text-white text-3xl font-bold">Khóa học lập trình Web từ cơ bản đến nâng cao</h1>
          <p class="text-blue-100 text-lg">Học cách xây dựng website hiện đại với HTML, CSS, JavaScript và React.</p>

          <!-- Stats -->
          <div class="flex flex-wrap gap-6 mb-6">
            <div class="flex items-center gap-2">★ <span>4.8 đánh giá</span></div>
            <div class="flex items-center gap-2">👥 <span>5,678 học viên</span></div>
            <div class="flex items-center gap-2">⏰ <span>12 giờ</span></div>
            <div class="flex items-center gap-2">🌐 <span>Tiếng Việt</span></div>
          </div>

          <!-- Instructor -->
          <div class="flex items-center gap-4 pt-6 border-t border-blue-600">
            <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-lg">N</div>
            <div>
              <p class="text-blue-200">Giảng viên</p>
              <p class="text-white">Nguyễn Văn A</p>
            </div>
          </div>

          
          <!-- Tabs Content -->
          <section class="py-8">
    <!-- Tabs Container -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <!-- Tab Buttons -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
      <button data-tab="overview" class="tab-button border-b-2 border-blue-600 pb-2 font-medium text-blue-600">Tổng quan</button>
      <button data-tab="curriculum" class="tab-button border-b-2 border-transparent pb-2 font-medium text-gray-600 hover:text-blue-600">Nội dung</button>
    </div>

    <!-- Tab Contents -->
    <div>
      <!-- Tổng quan -->
      <div id="overview" class="tab-content">
        <div class="space-y-8">
          <div class="bg-white rounded-lg shadow-sm ">
            <h2 class="text-gray-900 mb-6 text-xl font-semibold">Bạn sẽ học được gì</h2>
            <div class="grid md:grid-cols-2 gap-4">
              <div class="flex items-start gap-3"><i class="fas fa-check-circle text-green-600 mt-1"></i><span class="text-gray-700 text-sm">Xây dựng website hoàn chỉnh từ đầu đến cuối</span></div>
              <div class="flex items-start gap-3"><i class="fas fa-check-circle text-green-600 mt-1"></i><span class="text-gray-700 text-sm">Thành thạo HTML5, CSS3 và JavaScript hiện đại</span></div>
              <div class="flex items-start gap-3"><i class="fas fa-check-circle text-green-600 mt-1"></i><span class="text-gray-700 text-sm">Làm việc với React và các thư viện phổ biến</span></div>
              <div class="flex items-start gap-3"><i class="fas fa-check-circle text-green-600 mt-1"></i><span class="text-gray-700 text-sm">Responsive Design cho mọi thiết bị</span></div>
              <div class="flex items-start gap-3"><i class="fas fa-check-circle text-green-600 mt-1"></i><span class="text-gray-700 text-sm">Tích hợp API và làm việc với Database</span></div>
              <div class="flex items-start gap-3"><i class="fas fa-check-circle text-green-600 mt-1"></i><span class="text-gray-700 text-sm">Deploy ứng dụng lên Production</span></div>
            </div>
            <!-- Course Description -->
            <div class="mt-6">
              <h3 class="mb-4 text-gray-900 font-semibold text-lg">Mô tả khóa học</h3>
              <p class="text-gray-700 mb-2">Khóa học này được thiết kế cho những người muốn bắt đầu sự nghiệp trong lĩnh vực phát triển web. Bạn sẽ học từ HTML, CSS đến React.</p>
              <p class="text-gray-700">Với hơn 12 giờ video hướng dẫn và bài tập thực hành, bạn sẽ có nền tảng vững chắc để phát triển sự nghiệp công nghệ.</p>
            </div>
          </div>
        </div>
      </div>

     
  <!-- JS Tab -->
  <script>
    const tabs = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        // Reset all tabs
        tabs.forEach(t => { t.classList.remove('border-blue-600','text-blue-600'); t.classList.add('border-transparent','text-gray-600'); });
        contents.forEach(c => c.classList.add('hidden'));
        // Activate clicked tab
        tab.classList.add('border-blue-600','text-blue-600');
        tab.classList.remove('border-transparent','text-gray-600');
        document.getElementById(tab.dataset.tab).classList.remove('hidden');
      });
    });
  </script>
</section>
        </div>

        <!-- Right Column - Enrollment Card -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg p-6 shadow-lg text-gray-900 sticky top-24 space-y-6">
            <div class="aspect-video bg-purple-600 rounded-lg flex items-center justify-center cursor-pointer hover:opacity-90 transition-opacity">
              ▶️
            </div>
            <div>
              <div class="text-blue-600 text-lg font-semibold">499,000₫</div>
              <div class="text-gray-500 line-through">999,000₫</div>
            </div>
            <button class="w-full py-3 bg-purple-600  text-white rounded-lg hover:bg-purple-700 transition-colors">Mua ngay</button>
            <button class="w-full py-3 border border-purple-600 text-purpleblue-600 rounded-lg hover:bg-blue-50 transition-colors">Giỏ hàng</button>
            <div class="pt-6 border-t border-gray-200 space-y-2">
              <p class="text-gray-900 font-medium">Khóa học bao gồm:</p>
              <div class="flex items-center gap-3 text-gray-600">▶️ <span>12 video</span></div>
              <div class="flex items-center gap-3 text-gray-600">📄 <span>120 bài học</span></div>
              <div class="flex items-center gap-3 text-gray-600">🏆 <span>Chứng chỉ hoàn thành</span></div>
              <div class="flex items-center gap-3 text-gray-600">⏰ <span>Truy cập trọn đời</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<style>
    @media (min-width: 1024px) {
        .grid-cols-3 > div:last-child {
            display: block !important;
        }
    }
</style>

<?php include ROOT_PATH . '/views/includes/footer.php'; ?>
