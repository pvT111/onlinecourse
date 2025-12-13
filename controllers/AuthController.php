<?php
class AuthController 
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        
    }
    
    public function login()
    {
        if (isset($_SESSION['user_id']))
            redirect('');
        require_once ROOT_PATH . '/views/auth/login.php';
    }

    public function processLogin()
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin.";
            redirect('/index.php?route=login');
        }
 
        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = (int) $user['role'];
            redirect('');
        } else {
            $_SESSION['error'] = "Email hoặc mật khẩu không đúng.";
            redirect('/index.php?route=login');
        }
    }

    public function register()
    {
        if (isset($_SESSION['user_id']))
            redirect('');
        require_once ROOT_PATH . '/views/auth/register.php';
    }

    public function processRegister()
    {
        $fullname = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $pass = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($pass !== $confirm) {
            $_SESSION['error'] = "Mật khẩu xác nhận không khớp!";
            redirect('/index.php?route=register');
        }

        if ($this->userModel->findByEmail($email)) {
            $_SESSION['error'] = "Email đã được sử dụng!";
            redirect('/index.php?route=register');
        }

        $role = $_POST['role'] ?? 'student';
        $roleValue = ($role === 'instructor') ? 1 : 0; // 0 = student, 1 = instructor

        $data = [
            'fullname' => $fullname,
            'email' => $email,
            'password' => password_hash($pass, PASSWORD_BCRYPT),
            'username' => explode('@', $email)[0],
            'role' => $roleValue,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->userModel->insert($data);
        $_SESSION['success'] = "Đăng ký thành công! Hãy đăng nhập.";
        redirect('index.php?route=login');
    }

    public function logout()
    {
        session_destroy();
        redirect('');
    }
}
