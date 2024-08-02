<?php

namespace App\model;

class Users
{
    public $conn;
    private $table_name = "users";
    protected $fillable = ['name', 'email', 'password'];

    public function __construct()
    {
        $database = new \Database();
        $this->conn = $database->dbConnection();
    }

    public function getUser($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM  $table_name WHERE id = :id");
        $stmt->execute(['id', $id]);
        return $stmt->fetch();
    }

    public function register($name, $email, $password)
    {

        try {
            $sql = "INSERT INTO $this->table_name (name, email, password) VALUES (?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bind_param('sss', $name, $email, $hashed_password);
            if (!$stmt->execute()) {
                throw new Exception("Registration failed: " . $this->conn->error);
            }

            return true;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM $this->table_name WHERE email = ?";

            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }

            $stmt->bind_param('s', $email);
            if (!$stmt->execute()) {
                throw new Exception("Login failed: " . $this->conn->error);
            }

            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    return $user;
                } else {
                    $_SESSION['message'] = "Invalid Credentials";
                    header("Location: /FinancialApp/login");
                    exit;
                }
            } else {
                $_SESSION['message'] = "Invalid Credentials";
                header("Location: /FinancialApp/login");
                exit;
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
