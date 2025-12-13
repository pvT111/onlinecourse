// Tab functionality
function initTabs() {
  const tabButtons = document.querySelectorAll('.tab-button');
  const tabContents = document.querySelectorAll('.tab-content');

  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const targetTab = button.getAttribute('data-tab');

      // Remove active class from all buttons and contents
      tabButtons.forEach(btn => btn.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));

      // Add active class to clicked button and corresponding content
      button.classList.add('active');
      const targetContent = document.getElementById(targetTab);
      if (targetContent) {
        targetContent.classList.add('active');
      }
    });
  });
}

// Sidebar toggle for mobile
function initSidebar() {
  const menuBtn = document.getElementById('menu-btn');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  const closeBtn = document.getElementById('sidebar-close');

  if (menuBtn && sidebar) {
    menuBtn.addEventListener('click', () => {
      sidebar.classList.add('active');
      if (overlay) overlay.classList.add('active');
    });
  }

  if (closeBtn && sidebar) {
    closeBtn.addEventListener('click', () => {
      sidebar.classList.remove('active');
      if (overlay) overlay.classList.remove('active');
    });
  }

  if (overlay) {
    overlay.addEventListener('click', () => {
      sidebar.classList.remove('active');
      overlay.classList.remove('active');
    });
  }
}

// Accordion functionality
function initAccordion() {
  const accordionHeaders = document.querySelectorAll('.accordion-header');

  accordionHeaders.forEach(header => {
    header.addEventListener('click', () => {
      const content = header.nextElementSibling;
      const isOpen = content.classList.contains('active');

      // Close all accordions
      document.querySelectorAll('.accordion-content').forEach(c => {
        c.classList.remove('active');
        c.style.maxHeight = null;
      });

      document.querySelectorAll('.accordion-header').forEach(h => {
        h.classList.remove('active');
      });

      // Open clicked accordion if it was closed
      if (!isOpen) {
        content.classList.add('active');
        content.style.maxHeight = content.scrollHeight + 'px';
        header.classList.add('active');
      }
    });
  });
}

// Search functionality
function initSearch() {
  const searchInput = document.getElementById('search-input');
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      const searchTerm = e.target.value.toLowerCase();
      // Add your search logic here
      console.log('Searching for:', searchTerm);
    });
  }
}

// Modal functionality
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
  }
}

// Admin actions
function viewUser(userId) {
  console.log('View user:', userId);
  // Implement view user logic
}

function editUser(userId) {
  console.log('Edit user:', userId);
  // Implement edit user logic
}

function deleteUser(userId) {
  if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
    console.log('Delete user:', userId);
    // Implement delete user logic
  }
}

function toggleUserStatus(userId, currentStatus) {
  const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
  console.log(`Toggle user ${userId} from ${currentStatus} to ${newStatus}`);
  // Implement toggle status logic
}

function approveCourse(courseId) {
  if (confirm('Phê duyệt khóa học này?')) {
    console.log('Approve course:', courseId);
    // Implement approve logic
  }
}

function rejectCourse(courseId) {
  if (confirm('Từ chối khóa học này?')) {
    console.log('Reject course:', courseId);
    // Implement reject logic
  }
}

function addCategory() {
  const categoryName = prompt('Nhập tên danh mục mới:');
  if (categoryName) {
    console.log('Add category:', categoryName);
    // Implement add category logic
  }
}

function editCategory(categoryId) {
  console.log('Edit category:', categoryId);
  // Implement edit category logic
}

function deleteCategory(categoryId) {
  if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
    console.log('Delete category:', categoryId);
    // Implement delete category logic
  }
}

// Video player controls
function initVideoPlayer() {
  const playBtn = document.getElementById('play-btn');
  const video = document.getElementById('video-player');

  if (playBtn && video) {
    playBtn.addEventListener('click', () => {
      if (video.paused) {
        video.play();
        playBtn.textContent = '⏸';
      } else {
        video.pause();
        playBtn.textContent = '▶';
      }
    });
  }
}

// Initialize all functions when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  initTabs();
  initSidebar();
  initAccordion();
  initSearch();
  initVideoPlayer();
});

// Utility functions
function formatNumber(num) {
  return new Intl.NumberFormat('vi-VN').format(num);
}

function formatCurrency(amount) {
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND'
  }).format(amount);
}

function formatDate(dateString) {
  const date = new Date(dateString);
  return new Intl.DateTimeFormat('vi-VN').format(date);
}
