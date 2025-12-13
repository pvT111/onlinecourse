<?php
session_start();

define('ROOT_PATH', __DIR__);
define('BASE_URL', '/onlinecourse/');  // ĐƯỜNG DẪN TỪ GỐC WEB

function redirect($url) {
    header("Location: " . BASE_URL . $url);
    exit();
}

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/BaseModel.php';

// Models
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Course.php';
require_once __DIR__ . '/models/Category.php';
require_once __DIR__ . '/models/Enrollment.php';
require_once __DIR__ . '/models/Lesson.php';
require_once __DIR__ . '/models/Material.php';

// Controllers
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/CourseController.php';
require_once __DIR__ . '/controllers/EnrollmentController.php';
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/InstructorController.php';


$route = $_GET['route'] ?? 'home';
$method = $_SERVER['REQUEST_METHOD'];

// ------------------------------------------------------------
// AUTH HELPERS
// ------------------------------------------------------------
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        redirect('index.php?route=login');   // dùng hàm redirect mới
        exit();
    }
}

function requireRole($requiredRole) {
    if (!isset($_SESSION['user_id'])) {
        redirect('index.php?route=login');
        exit();
    }
    if ($_SESSION['role'] != $requiredRole) {  
        http_response_code(403);
        echo "Forbidden: Bạn không có quyền truy cập.";
        exit();
    }
}

switch ($route) {

    // --------------------------------------------------------
    // HOME
    // --------------------------------------------------------
    case 'home':
        (new HomeController())->index();
        break;

    // --------------------------------------------------------
    // AUTH
    // --------------------------------------------------------
    case 'login':
        $auth = new AuthController();
        ($method == 'POST') ? $auth->processLogin() : $auth->login();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;
    case 'register':
        $auth = new AuthController();
        ($method == 'POST') ? $auth->processRegister() : $auth->register();
        break;
    // --------------------------------------------------------
    // COURSES (PUBLIC)
    // --------------------------------------------------------
    case 'courses':
        (new CourseController())->index();
        break;

    case 'course_detail':
        $id = $_GET['id'] ?? 0;
        (new CourseController())->detail($id);
        break;

    // --------------------------------------------------------
    // ENROLLMENTS (STUDENT ONLY)
    // --------------------------------------------------------
    case 'enroll':
        requireLogin();
        requireRole(0); // student
        $id = $_GET['id'] ?? 0;
        (new EnrollmentController())->enroll($id);
        break;

    case 'student_dashboard':
        requireLogin();
        requireRole(0);
        (new EnrollmentController())->dashboard();
        break;

    // --------------------------------------------------------
    // ADMIN (ROLE = 2)
    // --------------------------------------------------------
    case 'admin_dashboard':
        requireLogin();
        requireRole(2);
        (new AdminController())->dashboard();
        break;

    // --------------------------------------------------------
    // INSTRUCTOR DASHBOARD (ROLE = 1)
    // --------------------------------------------------------
    case 'instructor_dashboard':
        requireLogin();
        requireRole(1);
        (new InstructorController())->dashboard();
        break;

    // --------------------------------------------------------
    // DEFAULT 404
    // --------------------------------------------------------
    default:
        http_response_code(404);
        echo "404 - Page not found";
        break;
}
