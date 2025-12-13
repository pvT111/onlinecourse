<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Bảng điều khiển giảng viên</title>

  <!-- Bạn cần tự chỉnh lại đường dẫn CSS -->
  <link rel="stylesheet" href="../../assets/css/style.css">

  <style>
    .tab-content {
      display: none;
    }

    .tab-active {
      display: block;
    }

    .lesson-panel {
      display: none;
    }
  </style>
</head>

<body>

  <div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Bảng điều khiển giảng viên</h1>
        <p class="text-gray-600 mt-2">Chào mừng trở lại, <strong>Giảng viên Demo</strong>!</p>
      </div>
      // Dashboard
      <!-- Tabs -->
      <div class="mb-10 border-b border-gray-200">
        <div class="flex gap-10 -mb-px">
          <button data-tab="courses"
            class="tab-button tab-active pb-5 px-2 border-b-4 border-blue-600 text-blue-600 font-bold text-lg">
            Quản lý khóa học
          </button>

          <button data-tab="student-list"
            class="tab-button pb-5 px-2 border-b-4 border-transparent text-gray-600 font-bold text-lg">
            Danh sách học viên
          </button>

          <button data-tab="lessons"
            class="tab-button pb-5 px-2 border-b-4 border-transparent text-gray-600 font-bold text-lg">
            Quản lý bài học
          </button>

          <button data-tab="create"
            class="tab-button pb-5 px-2 border-b-4 border-transparent text-gray-600 font-bold text-lg">
            Tạo khóa học mới
          </button>
        </div>
      </div>
    </div>
  </div>
  //course/mangage
  <!-- TAB 1: QUẢN LÝ KHÓA HỌC -->
  <div class="tab-content tab-active space-y-8">

    <div class="flex justify-between items-center mb-8">
      <h2 class="text-2xl font-bold text-gray-900">Khóa học của bạn</h2>
      <button data-tab-switch="create"
        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl">
        Tạo khóa học mới
      </button>
    </div>

    <!-- MẪU 1 KHÓA HỌC -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
      <div class="p-8 flex gap-8">

        <div
          class="w-64 h-44 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-5xl font-bold">
          JS
        </div>

        <div class="flex-1">
          <div class="flex justify-between items-start mb-5">
            <div>
              <h3 class="text-2xl font-bold text-gray-900">Khoá học JavaScript</h3>
              <p class="text-gray-600 mt-2">Lập trình JavaScript cơ bản đến nâng cao.</p>
            </div>
            <span class="px-5 py-2 bg-yellow-100 text-yellow-800 rounded-full">Chờ duyệt</span>
          </div>

          <div class="grid grid-cols-4 gap-6 mb-6">
            <div class="text-center">
              <p class="text-gray-500 text-sm">Học viên</p>
              <p class="text-3xl font-bold text-gray-900">45</p>
            </div>
            <div class="text-center">
              <p class="text-gray-500 text-sm">Bài học</p>
              <p class="text-3xl font-bold text-gray-900">12</p>
            </div>
            <div class="text-center">
              <p class="text-gray-500 text-sm">Đánh giá</p>
              <p class="text-3xl font-bold text-gray-900">4.8</p>
            </div>
            <div class="text-center">
              <p class="text-gray-500 text-sm">Doanh thu</p>
              <p class="text-3xl font-bold text-purple-600">4.500.000đ</p>
            </div>
          </div>

          <div class="flex gap-4">
            <a href="#" class="px-6 py-3 border border-gray-300 rounded-xl">Xem</a>
            <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-xl">Chỉnh sửa</a>
            <button class="lesson-toggle px-6 py-3 border border-gray-300 rounded-xl" data-course-id="1"
              data-course-title="Khoá học JavaScript">
              Quản lý bài học
            </button>
            <button class="px-6 py-3 border border-red-300 text-red-600 rounded-xl">Xóa</button>
          </div>
        </div>

      </div>
    </div>
  </div>
  //student
  <!-- TAB 2: DANH SÁCH HỌC VIÊN -->
  <div id="student-list" class="tab-content space-y-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-8">Danh sách học viên</h2>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white">
            <tr>
              <th class="px-8 py-5 text-left">Họ tên</th>
              <th class="px-8 py-5 text-left">Email</th>
              <th class="px-8 py-5 text-left">Số khóa học</th>
              <th class="px-8 py-5 text-left">Ngày tham gia</th>
              <th class="px-8 py-5 text-left">Trạng thái</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">
            <tr class="hover:bg-emerald-50">
              <td class="px-8 py-6 flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-600 rounded-full text-white flex items-center justify-center">NT</div>
                <div>Nguyễn Văn A</div>
              </td>
              <td class="px-8 py-6">nguyenvana@gmail.com</td>
              <td class="px-8 py-6 text-center">12</td>
              <td class="px-8 py-6">01/10/2025</td>
              <td class="px-8 py-6"><span class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full">Hoạt
                  động</span></td>
            </tr>
          </tbody>

        </table>
      </div>
    </div>
  </div>
  //lesson
  <!-- TAB 3: QUẢN LÝ BÀI HỌC -->
  <div id="lessons" class="tab-content space-y-8">
    <div class="flex justify-between items-center mb-8">
      <h2 class="text-2xl font-bold text-gray-900">
        Quản lý bài học — <span id="lesson-course-title" class="text-blue-600">Khoá học </span>
      </h2>
      <button id="add-lesson-btn" class="px-6 py-3 bg-blue-600 text-white rounded-xl">
        + Thêm bài học mới
      </button>
    </div>

    <div id="lesson-list-content" class="bg-white rounded-2xl shadow-lg p-6">
      <p>Danh sách bài học của khóa học hiện tại...</p>
      <!-- foreach với hiện list lesson -->
    </div>
  </div>


  <!-- MODAL: THÊM BÀI HỌC MỚI -->
  <div id="add-lesson-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl m-4 transform transition-all scale-100">

      <div class="flex justify-between items-center p-6 border-b border-gray-200">
        <h3 class="text-xl font-bold text-gray-900">
          Thêm Bài Học <span id="modal-course-title" class="text-blue-600"></span>
        </h3>
        <button data-close-modal
          class="text-gray-400 hover:text-gray-700 text-3xl font-light leading-none">&times;</button>
      </div>

      <div class="p-6 space-y-6">
        <input type="hidden" id="modal-course-id" value="">

        <div>
          <label class="block text-gray-700 mb-2 font-medium">Tiêu đề bài học *</label>
          <input type="text"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div>
          <label class="block text-gray-700 mb-2 font-medium">Nội dung bài học (Content) *</label>
          <textarea rows="6"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
            placeholder="Nhập nội dung chi tiết của bài học..."></textarea>
        </div>

        <div class="grid grid-cols-2 gap-6">
          <div>
            <label class="block text-gray-700 mb-2 font-medium">URL Video (Video_URL)</label>
            <input type="url"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" />
          </div>

          <div>
            <label class="block text-gray-700 mb-2 font-medium">Thứ tự (Order) *</label>
            <input type="number"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
              min="1" />
          </div>
        </div>

      </div>

      <div class="p-6 border-t border-gray-200 flex justify-end gap-3">
        <button data-close-modal
          class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Hủy</button>
        <button class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700">Lưu Bài Học</button>
      </div>
    </div>
  </div>


  //course/create
  <!-- TAB 4: TẠO KHÓA HỌC -->
  <div id="create" class="tab-content max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Tạo khóa học mới</h2>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-6">

      <div>
        <label class="block text-gray-700 mb-2">Tên khóa học *</label>
        <input type="text" class="w-full px-4 py-3 border rounded-lg"
          placeholder="Ví dụ: Lập trình React từ cơ bản đến nâng cao" />
      </div>

      <div>
        <label class="block text-gray-700 mb-2">Mô tả ngắn *</label>
        <textarea rows="4" class="w-full px-4 py-3 border rounded-lg"
          placeholder="Mô tả ngắn gọn về khóa học..."></textarea>
      </div>

      <div class="grid grid-cols-2 gap-6">
        <div>
          <label class="block text-gray-700 mb-2">Danh mục *</label>
          <select class="w-full px-4 py-3 border rounded-lg">
            <option>Chọn danh mục</option>
            <option>Lập trình</option>
            <option>Marketing</option>
            <option>Thiết kế</option>
          </select>
        </div>

        <div>
          <label class="block text-gray-700 mb-2">Trình độ *</label>
          <select class="w-full px-4 py-3 border rounded-lg">
            <option>Cơ bản</option>
            <option>Trung cấp</option>
            <option>Nâng cao</option>
          </select>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-6">
        <div>
          <label class="block text-gray-700 mb-2">Giá (VNĐ) *</label>
          <input type="number" class="w-full px-4 py-3 border rounded-lg" placeholder="999000" />
        </div>

        <div>
          <label class="block text-gray-700 mb-2">Thời lượng *</label>
          <input type="text" class="w-full px-4 py-3 border rounded-lg" placeholder="10 giờ" />
        </div>
      </div>

      <div>
        <label class="block text-gray-700 mb-2">Ảnh đại diện khóa học</label>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
          <div class="text-gray-400 mb-2">Kéo thả ảnh hoặc click để chọn</div>
        </div>
      </div>

      <div class="flex justify-end">
        <button class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg">Tạo </button>
      </div>

    </div>
  </div>

  </div>
  </div>

  <!-- JavaScript -->
  <script>
    /* --------------------------------------------------
       1) XỬ LÝ CHUYỂN TAB
    -------------------------------------------------- */
    document.querySelectorAll('.tab-button').forEach(btn => {
      btn.addEventListener('click', () => {
        const tab = btn.dataset.tab;

        // reset style tab
        document.querySelectorAll('.tab-button').forEach(b => {
          b.classList.remove('tab-active', 'border-blue-600', 'text-blue-600');
          b.classList.add('border-transparent', 'text-gray-600');
        });

        btn.classList.add('tab-active', 'border-blue-600', 'text-blue-600');

        // hiển thị nội dung tab
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('tab-active'));
        document.getElementById(tab).classList.add('tab-active');
      });
    });

    /* --------------------------------------------------
       2) NÚT CHUYỂN TAB TỪ BÊN NGOÀI
    -------------------------------------------------- */
    document.querySelectorAll('[data-tab-switch]').forEach(btn => {
      btn.addEventListener('click', () => {
        const target = btn.dataset.tabSwitch;
        document.querySelector(`[data-tab="${target}"]`).click();
      });
    });

    /* --------------------------------------------------
       3) CHUYỂN TAB → LESSONS & LOAD THÔNG TIN KHÓA HỌC
    -------------------------------------------------- */
    document.querySelectorAll('.lesson-toggle').forEach(btn => {
      btn.addEventListener('click', function () {
        const courseId = this.dataset.courseId;
        const courseTitle = this.dataset.courseTitle;

        // chuyển tab
        document.querySelector('[data-tab="lessons"]').click();

        // cập nhật tiêu đề
        document.getElementById('lesson-course-title').textContent = courseTitle;

        // render nội dung
        document.getElementById('lesson-management-content').innerHTML = `
      <div class="text-center py-12">
        <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full mx-auto mb-8 flex items-center justify-center text-white text-5xl font-bold">
          ${courseTitle.substring(0, 2).toUpperCase()}
        </div>
        <h3 class="text-3xl font-bold text-gray-900 mb-4">Đang quản lý: <span class="text-blue-600">${courseTitle}</span></h3>
        <p class="text-gray-600 mb-8">Danh sách bài học sẽ hiển thị tại đây.</p>

        <a href="#" id="quick-add-lesson" 
           class="inline-block px-8 py-4 bg-blue-600 text-white rounded-xl">
          Thêm bài học mới
        </a>
      </div>
    `;

        // gán dữ liệu cho modal để thêm bài học
        setupLessonModal(courseId, courseTitle);

        // mở modal khi nhấn nút "Thêm bài học mới" trong phần này
        document.getElementById("quick-add-lesson").addEventListener("click", function (e) {
          e.preventDefault();
          openLessonModal();
        });
      });
    });

    /* --------------------------------------------------
       4) XỬ LÝ MODAL THÊM BÀI HỌC
    -------------------------------------------------- */
    const modal = document.getElementById("add-lesson-modal");
    const addLessonBtn = document.getElementById("add-lesson-btn");

    // hàm mở modal
    function openLessonModal() {
      modal.classList.remove("hidden");
    }

    // hàm đóng modal
    function closeLessonModal() {
      modal.classList.add("hidden");
    }

    // gán thông tin khóa học vào modal
    function setupLessonModal(courseId, courseTitle) {
      document.getElementById("modal-course-id").value = courseId;
      document.getElementById("modal-course-title").textContent = courseTitle;
    }

    // nút mở modal từ tab Lessons
    addLessonBtn?.addEventListener("click", openLessonModal);

    // nút đóng modal (Hủy + dấu X)
    document.querySelectorAll("[data-close-modal]").forEach(btn => {
      btn.addEventListener("click", closeLessonModal);
    });

    // click ra ngoài để đóng
    modal.addEventListener("click", (e) => {
      if (e.target === modal) closeLessonModal();
    });
  </script>

  <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>