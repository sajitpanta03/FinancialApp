<?php

namespace App\model;
use Exception;

abstract class UserModel 
{
    abstract public function getUser($id);
    abstract public function register($name, $email, $password, $type);
    abstract public function login($email, $password);
}

class Users extends UserModel
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
        $stmt = $this->conn->prepare("SELECT * FROM $this->table_name WHERE id = :id");
        $stmt->execute(['id', $id]);
        return $stmt->fetch();
    }

    public function register($name, $email, $password, $type)
    {
        try {
            $sql = "INSERT INTO $this->table_name (name, email, password, type) VALUES (?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $this->conn->error);
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bind_param('ssss', $name, $email, $hashed_password, $type);
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
                throw new Exception("Failed to prepare statement");
            }
    
            $stmt->bind_param('s', $email);
            if (!$stmt->execute()) {
                throw new Exception("Failed to execute statement");
            }
    
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
    
            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
    
                if ($user['type'] === 'user') {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['logged_in'] = true;
    
                    header("Location: /FinancialApp/dashboard");
                    exit;
                } elseif ($user['type'] === 'admin') {
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['logged_in'] = true;
    
                    header("Location: /FinancialApp/adminDashboard");
                    exit;
                }
            }
    
            if ($user) {
                $_SESSION['message'] = "Invalid credentials";
            } else {
                $_SESSION['message'] = "User not found.";
            }
    
            header("Location: /FinancialApp/login");
            exit;
    
        } catch (Exception $e) {
            error_log($e->getMessage());
            $_SESSION['message'] = "An error occurred. Please try again later.";
            header("Location: /FinancialApp/login");
            exit;
        }
    }
}
