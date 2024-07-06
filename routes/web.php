<?php

// Landing page
$router->get("/", "App\\controller\\HomeController@home");
$router->get("/about", "App\\controller\\HomeController@about");
$router->get("/contact", "App\\controller\\HomeController@contact");

// Auth 
$router->get("/register", "App\\controller\\UserAuthController@showRegister");
$router->get("/api/registerUser", "App\\controller\\UserAuthController@register");


