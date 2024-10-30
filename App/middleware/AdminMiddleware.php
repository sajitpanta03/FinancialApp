<?php

namespace App\middleware;

class AdminMiddleware
{
    private $sessionKey = 'admin_id';

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function handle()
    {
        if (!isset($_SESSION[$this->sessionKey])) {
            header('Location: login');
            exit;
        }
    }
}
