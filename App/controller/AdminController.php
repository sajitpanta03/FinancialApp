<?php

namespace App\controller;

use App\model\Admin;

class AdminController
{
    public $admin;

    public function __construct()
    {
        $this->admin = new Admin();
    }

    public function index()
    {
        return view('/Admin/adminPage');
    }

    public function adminDashboard()
    {  
        $totalUsers = $this->admin->totalUser();
        return view('/Admin/adminDashboard', ['totalUsers' => $totalUsers]);
    }

    public function adminUser()
    {
        $users = $this->admin->getAllUsers();
        return view('/Admin/adminUser', ['users' => $users]);
    }

    public function searchUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $searchTerm = $_POST['search'];
            error_log("Search term: " . $searchTerm);
            $searchUsers = $this->admin->search($searchTerm);
            error_log(print_r($searchUsers, true));
    
            if (!empty($searchUsers)) {
                return view('/Admin/adminPageSearch', ['searchUsers' => $searchUsers]);
            } else {
                error_log('No search results found.');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

}
