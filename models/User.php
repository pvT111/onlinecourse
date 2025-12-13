<?php
require_once "BaseModel.php";

class User extends BaseModel
{
    protected $table = "users";

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getNameByID($ID){
        $sql = "SELECT fullname FROM {$this->table} WHERE id = ?";       
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$ID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['fullname'];
        }
        return null;
    }
}
