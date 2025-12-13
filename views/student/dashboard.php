<?php 
$pageTitle = "Student Dashboard";
include  ROOT_PATH   . '/views/includes/header.php';
?>
<div class="min-h-screen bg-gray-50 py-8">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-8">
      <h1 class="text-gray-900 mb-2 text-2xl font-bold">Học tập của tôi</h1>
      <p class="text-gray-600">Theo dõi tiến độ và tiếp tục học tập</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <!-- Card 1 -->
      <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between mb-2">
          <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m8-6H4" />
            </svg>
          </div>
        </div>
        <div class="text-gray-900 mb-1 text-xl font-semibold">4</div>
        <div class="text-gray-600">Khóa học đang học</div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between mb-2">
          <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
          </div>
        </div>
        <div class="text-gray-900 mb-1 text-xl font-semibold">2</div>
        <div class="text-gray-600">Hoàn thành</div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between mb-2">
          <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
        <div class="text-gray-900 mb-1 text-xl font-semibold">24.5</div>
        <div class="text-gray-600">Giờ học</div>
      </div>

      <!-- Card 4 -->
      <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <div class="flex items-center justify-between mb-2">
          <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center">
            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8l-3 4h6l-3 4" />
            </svg>
          </div>
        </div>
        <div class="text-gray-900 mb-1 text-xl font-semibold">2</div>
        <div class="text-gray-600">Chứng chỉ</div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="mb-6">
      <div class="border-b border-gray-200">
        <div class="flex gap-8">
          <button onclick="showTab('my-courses')" id="tab-my-courses"
            class="pb-4 px-1 border-b-2 border-blue-600 text-blue-600 transition-colors">
            Khóa học của tôi
          </button>
          <button onclick="showTab('progress')" id="tab-progress"
            class="pb-4 px-1 border-b-2 border-transparent text-gray-600 hover:text-gray-900 transition-colors">
            Chi tiết tiến độ
          </button>
        </div>
      </div>
    </div>

    <!-- My Courses -->
    <div id="my-courses-content">
      <div class="grid md:grid-cols-2 gap-6">
        <!-- Course 1 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow cursor-pointer"
          onclick="selectCourse(1)">
          <div class="h-40 bg-gradient-to-br from-blue-500 to-purple-600 relative">
            <div class="absolute bottom-4 left-4 right-4">
              <div class="bg-white/90 backdrop-blur-sm rounded-lg p-2">
                <div class="flex items-center justify-between mb-1">
                  <span class="text-gray-700">Tiến độ</span>
                  <span class="text-gray-900">60%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-blue-600 h-2 rounded-full" style="width:60%"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="p-6">
            <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-xs">Lập trình</span>
            <h3 class="text-gray-900 mt-2 mb-2 font-semibold">JavaScript Cơ bản</h3>
            <p class="text-gray-600 mb-4">Truy cập lần cuối: 02/02/2025</p>
            <button
              class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
              <i class="fas fa-play w-4 h-4"></i>
              Tiếp tục học
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Progress / Course Details -->
    <div id="progress-content" class="hidden">
      <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 mb-6">
        <button onclick="backToCourses()" class="text-blue-600 hover:text-blue-700 mb-4">← Quay lại</button>
        <h2 id="course-title" class="text-gray-900 mb-4 text-xl font-semibold">Tên khóa học</h2>

        <!-- Progress Overview -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
          <div class="p-4 bg-blue-50 rounded-lg">
            <div id="course-progress" class="text-blue-600 mb-1">60%</div>
            <div class="text-gray-600">Hoàn thành</div>
          </div>
          <div class="p-4 bg-green-50 rounded-lg">
            <div id="course-lessons" class="text-green-600 mb-1">3/5</div>
            <div class="text-gray-600">Bài học</div>
          </div>
          <div class="p-4 bg-purple-50 rounded-lg">
            <div id="course-duration" class="text-purple-600 mb-1">4h 30m</div>
            <div class="text-gray-600">Tổng thời lượng</div>
          </div>
        </div>

        <!-- Lesson List -->
        <h3 class="text-gray-900 mb-4">Chi tiết bài học</h3>
        <div id="lesson-list" class="space-y-3">
          <!-- Lesson items sẽ được JS thêm vào -->
        </div>
      </div>
    </div>

  </div>

  <script>
    // Dữ liệu mẫu
    const coursesData = {
      1: {
        title: "JavaScript Cơ bản",
        progress: 60,
        duration: "4h 30m",
        lessons: [
          { id: 1, title: "Giới thiệu JS", type: "video", duration: "15m" },
          { id: 2, title: "Biến và kiểu dữ liệu", type: "video", duration: "25m" },
          { id: 3, title: "Câu lệnh điều kiện", type: "video", duration: "30m" },
          { id: 4, title: "Vòng lặp", type: "video", duration: "40m" },
          { id: 5, title: "Hàm", type: "video", duration: "50m" },
        ]
      }
    };

    function showTab(tab) {
      const myCourses = document.getElementById('my-courses-content');
      const progress = document.getElementById('progress-content');
      const tabMy = document.getElementById('tab-my-courses');
      const tabProgress = document.getElementById('tab-progress');

      if (tab === 'my-courses') {
        myCourses.classList.remove('hidden');
        progress.classList.add('hidden');
        tabMy.classList.add('border-blue-600', 'text-blue-600');
        tabMy.classList.remove('border-transparent', 'text-gray-600');
        tabProgress.classList.remove('border-blue-600', 'text-blue-600');
        tabProgress.classList.add('border-transparent', 'text-gray-600');
      } else {
        myCourses.classList.add('hidden');
        progress.classList.remove('hidden');
        tabMy.classList.remove('border-blue-600', 'text-blue-600');
        tabMy.classList.add('border-transparent', 'text-gray-600');
        tabProgress.classList.add('border-blue-600', 'text-blue-600');
        tabProgress.classList.remove('border-transparent', 'text-gray-600');
      }
    }

    function selectCourse(courseId) {
      const course = coursesData[courseId];
      if (!course) return;

      // Hiển thị tab progress
      showTab('progress');

      // Điền dữ liệu vào HTML
      document.getElementById('course-title').innerText = course.title;
      document.getElementById('course-progress').innerText = course.progress + '%';
      document.getElementById('course-duration').innerText = course.duration;
      const completedLessons = Math.floor(course.lessons.length * course.progress / 100);
      document.getElementById('course-lessons').innerText = `${completedLessons}/${course.lessons.length}`;

      // Xây danh sách bài học
      const lessonList = document.getElementById('lesson-list');
      lessonList.innerHTML = '';
      course.lessons.forEach((lesson, index) => {
        const isCompleted = index < completedLessons;
        const lessonDiv = document.createElement('div');
        lessonDiv.className = `flex items-center justify-between p-4 rounded-lg border ${isCompleted ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200'}`;
        lessonDiv.innerHTML = `
          <div class="flex items-center gap-4">
            <div class="w-8 h-8 rounded-full flex items-center justify-center ${isCompleted ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-600'}">
              ${isCompleted ? '<i class="fas fa-check-circle"></i>' : index + 1}
            </div>
            <div>
              <p class="text-gray-900">${lesson.title}</p>
              <div class="flex items-center gap-2 mt-1 text-gray-500">
                <i class="fas fa-${lesson.type === 'video' ? 'play' : 'file-alt'} text-gray-400 w-4 h-4"></i>
                <span>${lesson.duration}</span>
              </div>
            </div>
          </div>
          ${isCompleted ? '<span class="text-green-600">Đã hoàn thành</span>' : ''}
        `;
        lessonList.appendChild(lessonDiv);
      });
    }

    function backToCourses() {
      showTab('my-courses');
    }
  </script>

</div>

<?php include ROOT_PATH . '/views/includes/footer.php'; ?>