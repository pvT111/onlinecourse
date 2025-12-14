<?php
// controllers/AdminController.php

class AdminController
{
    private $userModel;
    private $categoryModel;

    public function __construct()
    {
        $this->userModel     = new User();
        $this->categoryModel = new Category();
    }

    // ==================== DASHBOARD ====================
    public function dashboard()
    {
        $users      = $this->userModel->all('id DESC');
        $categories = $this->categoryModel->all('name ASC');

        require ROOT_PATH . "/views/admin/dashboard.php";
    }

    // ==================== QUẢN LÝ DANH MỤC ====================

    public function categoryCreate()
    {
        require ROOT_PATH . "/views/admin/categories/create.php";
    }

    public function categoryStore()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=admin_dashboard');
        }

        $name        = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (empty($name)) {
            $_SESSION['error'] = "Tên danh mục là bắt buộc.";
            redirect('index.php?route=admin_category_create');
        }

        $data = [
            'name'        => $name,
            'description' => $description,
        ];

        if ($this->categoryModel->insert($data)) {
            $_SESSION['success'] = "Thêm danh mục thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi thêm danh mục.";
        }

        redirect('index.php?route=admin_dashboard');
    }

    public function categoryEdit($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            $_SESSION['error'] = "Không tìm thấy danh mục.";
            redirect('index.php?route=admin_dashboard');
        }

        require ROOT_PATH . "/views/admin/categories/edit.php";
    }

    public function categoryUpdate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=admin_dashboard');
        }

        $id   = $_POST['id'] ?? 0;
        $name = trim($_POST['name'] ?? '');

        if (empty($name)) {
            $_SESSION['error'] = "Tên danh mục là bắt buộc.";
            redirect('index.php?route=admin_category_edit&id=' . $id);
        }

        $category = $this->categoryModel->find($id);
        if (!$category) {
            $_SESSION['error'] = "Danh mục không tồn tại.";
            redirect('index.php?route=admin_dashboard');
        }

        $data = [
            'name'        => $name,
            'description' => trim($_POST['description'] ?? ''),
        ];

        if ($this->categoryModel->update($id, $data)) {
            $_SESSION['success'] = "Cập nhật danh mục thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi cập nhật danh mục.";
        }

        redirect('index.php?route=admin_dashboard');
    }

    public function categoryDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=admin_dashboard');
        }

        $id = $_POST['id'] ?? 0;

        $category = $this->categoryModel->find($id);
        if (!$category) {
            $_SESSION['error'] = "Danh mục không tồn tại.";
            redirect('index.php?route=admin_dashboard');
        }

        // Kiểm tra xem có khóa học nào đang dùng danh mục này không
        $pdo  = Database::getInstance();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM courses WHERE category_id = ?");
        $stmt->execute([$id]);

        if ($stmt->fetchColumn() > 0) {
            $_SESSION['error'] = "Không thể xóa danh mục vì đang có khóa học sử dụng.";
            redirect('index.php?route=admin_dashboard');
        }

        if ($this->categoryModel->delete($id)) {
            $_SESSION['success'] = "Xóa danh mục thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi xóa danh mục.";
        }

        redirect('index.php?route=admin_dashboard');
    }

    // ==================== QUẢN LÝ NGƯỜI DÙNG ====================

    public function userCreate()
    {
        require ROOT_PATH . "/views/admin/users/create.php";
    }

    public function userStore()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=admin_dashboard');
        }

        $fullname = trim($_POST['fullname'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $role     = $_POST['role'] ?? 'student';

        // Validate dữ liệu đầu vào
        if (empty($fullname) || empty($email) || empty($password)) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ họ tên, email và mật khẩu.";
            redirect('index.php?route=admin_user_create');
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = "Mật khẩu phải có ít nhất 6 ký tự.";
            redirect('index.php?route=admin_user_create');
        }

        // Kiểm tra email đã tồn tại
        if ($this->userModel->where('email', $email)) {
            $_SESSION['error'] = "Email này đã được sử dụng.";
            redirect('index.php?route=admin_user_create');
        }

        // Validate role
        $allowedRoles = ['student', 'instructor', 'admin'];
        $role = in_array($role, $allowedRoles) ? $role : 'student';

        $data = [
            'fullname' => $fullname,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $role,
        ];

        if ($this->userModel->insert($data)) {
            $_SESSION['success'] = "Tạo tài khoản thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi tạo tài khoản.";
        }

        redirect('index.php?route=admin_dashboard');
    }

    public function userEdit($id)
{
    $user = $this->userModel->find($id);

    if (!$user) {
        $_SESSION['error'] = "Không tìm thấy người dùng.";
        redirect('index.php?route=admin_dashboard');
    }

    // ĐẢM BẢO DÒNG NÀY CHÍNH XÁC 100%
    require ROOT_PATH . "/views/admin/users/edit.php";
    
    // Không được để thêm bất kỳ require nào khác ở dưới nữa
}

    public function userUpdate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=admin_dashboard');
        }

        $id   = $_POST['id'] ?? 0;
        $role = $_POST['role'] ?? 'student';

        $user = $this->userModel->find($id);
        if (!$user) {
            $_SESSION['error'] = "Người dùng không tồn tại.";
            redirect('index.php?route=admin_dashboard');
        }

        // Không cho phép thay đổi role của chính mình
        if ($user['id'] == $_SESSION['user_id']) {
            $_SESSION['error'] = "Bạn không thể thay đổi vai trò của chính tài khoản đang đăng nhập.";
            redirect('index.php?route=admin_user_edit&id=' . $id);
        }

        // Validate role
        $allowedRoles = ['student', 'instructor', 'admin'];
        $role = in_array($role, $allowedRoles) ? $role : 'student';

        $data = ['role' => $role];

        if ($this->userModel->update($id, $data)) {
            $_SESSION['success'] = "Cập nhật vai trò người dùng thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi cập nhật.";
        }

        redirect('index.php?route=admin_dashboard');
    }

    public function userDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('index.php?route=admin_dashboard');
        }

        $id = $_POST['id'] ?? 0;

        $user = $this->userModel->find($id);
        if (!$user) {
            $_SESSION['error'] = "Người dùng không tồn tại.";
            redirect('index.php?route=admin_dashboard');
        }

        // Không cho phép xóa chính mình
        if ($user['id'] == $_SESSION['user_id']) {
            $_SESSION['error'] = "Bạn không thể xóa chính tài khoản đang đăng nhập!";
            redirect('index.php?route=admin_dashboard');
        }

        if ($this->userModel->delete($id)) {
            $_SESSION['success'] = "Xóa người dùng thành công!";
        } else {
            $_SESSION['error'] = "Có lỗi khi xóa người dùng.";
        }

        redirect('index.php?route=admin_dashboard');
    }
}