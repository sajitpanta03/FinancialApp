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
    
}
