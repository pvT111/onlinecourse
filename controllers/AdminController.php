<?php
class AdminController
{
    public function dashboard()
    {
        require ROOT_PATH . "/views/admin/dashboard.php";
    }

    public function manageUsers()
    {
        $users = (new User())->all();
        require ROOT_PATH . "/views/admin/users/manage.php";
    }

    public function manageCategories()
    {
        $categories = (new Category())->all();
        require ROOT_PATH . "/views/admin/categories/list.php";
    }
}
