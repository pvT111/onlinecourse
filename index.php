
<?php
session_start();

define('ROOT_PATH', __DIR__);
define('BASE_URL', '/onlinecourse/'); 

function redirect($url)
{
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
function requireLogin()
{
    if (!isset($_SESSION['user_id'])) {
        redirect('index.php?route=login');
        exit();
    }
}

function requireRole($requiredRole)
{
    requireLogin();
    if ($_SESSION['role'] != $requiredRole) {
        http_response_code(403);
        echo "Forbidden: Bạn không có quyền truy cập.";
        exit();
    }
}

// ------------------------------------------------------------
// ROUTING
// ------------------------------------------------------------
switch ($route) {

    
    case 'home':
        (new HomeController())->index();
        break;

    case 'courses':
        (new CourseController())->index();
        break;

    case 'course_detail':
        $id = $_GET['id'] ?? 0;
        (new CourseController())->detail($id);
        break;


    case 'login':
        $auth = new AuthController();
        $method === 'POST' ? $auth->processLogin() : $auth->login();
        break;

    case 'register':
        $auth = new AuthController();
        $method === 'POST' ? $auth->processRegister() : $auth->register();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    // --------------------------------------------------------
    // STUDENT (ROLE = 0)
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
    // INSTRUCTOR (ROLE = 1)
    // --------------------------------------------------------
    case 'instructor_dashboard':
        requireLogin();
        requireRole(1);
        (new InstructorController())->dashboard();
        break;

    case 'instructor_course_create':
        requireLogin();
        requireRole(1);
        (new InstructorController())->courseCreate();
        break;

    case 'instructor_course_store':
        requireLogin();
        requireRole(1);
        if ($method === 'POST') {
            (new InstructorController())->courseStore();
        } else {
            redirect('index.php?route=instructor_dashboard');
        }
        break;

    case 'instructor_course_edit':
        requireLogin();
        requireRole(1);
        $id = $_GET['id'] ?? 0;
        (new InstructorController())->courseEdit($id);
        break;

    case 'instructor_course_update':
        requireLogin();
        requireRole(1);
        if ($method === 'POST') {
            (new InstructorController())->courseUpdate();
        } else {
            redirect('index.php?route=instructor_dashboard');
        }
        break;

    case 'instructor_course_delete':
        requireLogin();
        requireRole(1);
        if ($method === 'POST') {
            (new InstructorController())->courseDelete();
        } else {
            redirect('index.php?route=instructor_dashboard');
        }
        break;

    case 'instructor_lesson_manage':
        requireLogin();
        requireRole(1);
        $course_id = $_GET['course_id'] ?? 0;
        (new InstructorController())->lessonManage($course_id);
        break;

    case 'instructor_lesson_create':
        requireLogin();
        requireRole(1);
        $course_id = $_GET['course_id'] ?? 0;
        (new InstructorController())->lessonCreate($course_id);
        break;

    case 'instructor_lesson_store':
        requireLogin();
        requireRole(1);
        if ($method === 'POST') {
            (new InstructorController())->lessonStore();
        } else {
            redirect('index.php?route=instructor_dashboard');
        }
        break;

    case 'instructor_lesson_edit':
        requireRole(1);
        $id = $_GET['id'] ?? 0;
        (new InstructorController())->lessonEdit($id);
        break;

    case 'instructor_lesson_update':
        requireRole(1);
        if ($method === 'POST') {
            (new InstructorController())->lessonUpdate();
        } else {
            redirect('index.php?route=instructor_dashboard');
        }
        break;

    case 'instructor_lesson_delete':
        requireLogin();
        requireRole(1);
        if ($method === 'POST') {
            (new InstructorController())->lessonDelete();
        } else {
            redirect('index.php?route=instructor_dashboard');
        }
        break;

    // --------------------------------------------------------
    // ADMIN (ROLE = 2)
    // --------------------------------------------------------
    case 'admin_dashboard':
        requireLogin();
        requireRole(2);
        (new AdminController())->dashboard();
        break;

    // Quản lý danh mục
    case 'admin_category_create':
        requireLogin();
        requireRole(2);
        (new AdminController())->categoryCreate();
        break;

    case 'admin_category_store':
        requireLogin();
        requireRole(2);
        if ($method === 'POST') {
            (new AdminController())->categoryStore();
        } else {
            redirect('index.php?route=admin_dashboard');
        }
        break;

    case 'admin_category_edit':
        requireLogin();
        requireRole(2);
        $id = $_GET['id'] ?? 0;
        (new AdminController())->categoryEdit($id);
        break;

    case 'admin_category_update':
        requireLogin();
        requireRole(2);
        if ($method === 'POST') {
            (new AdminController())->categoryUpdate();
        } else {
            redirect('index.php?route=admin_dashboard');
        }
        break;

    case 'admin_category_delete':
        requireLogin();
        requireRole(2);
        if ($method === 'POST') {
            (new AdminController())->categoryDelete();
        } else {
            redirect('index.php?route=admin_dashboard');
        }
        break;

    case 'admin_user_create':
        requireLogin();
        requireRole(2);
        (new AdminController())->userCreate();
        break;

    case 'admin_user_store':
        requireLogin();
        requireRole(2);
        if ($method === 'POST') {
            (new AdminController())->userStore();
        } else {
            redirect('index.php?route=admin_dashboard');
        }
        break;

    case 'admin_user_edit':
        requireLogin();
        requireRole(2);
        $id = $_GET['id'] ?? 0; 
        (new AdminController())->userEdit($id);
        break;

    case 'admin_user_update':
        requireLogin();
        requireRole(2);
        if ($method === 'POST') {
            (new AdminController())->userUpdate();
        } else {
            redirect('index.php?route=admin_dashboard');
        }
        break;

    case 'admin_user_delete':
        requireLogin();
        requireRole(2);
        if ($method === 'POST') {
            (new AdminController())->userDelete();
        } else {
            redirect('index.php?route=admin_dashboard');
        }
        break;
        
    default:
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}