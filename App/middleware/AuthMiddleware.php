<?php

namespace App\middleware;

class AuthMiddleware
{
    private $sessionKey = 'user_id';

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
