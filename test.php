<?php
require_once "config/Database.php";
require_once "models/BaseModel.php";
require_once "models/User.php";
require_once "models/Course.php";
require_once "models/Category.php";

$userModel = new User();

$data = [
    
    
        'fullname' => 'student',
        'email' => 'student@gmail.com',
        'password' => password_hash('123456', PASSWORD_BCRYPT), // mật khẩu là 123456
        'username' => 'student',
        'role' => 0,
        'created_at' => date('Y-m-d H:i:s')
    
];


$userModel->insert($data);
echo "tao user thanh cong";

