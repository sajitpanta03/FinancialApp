<?php
// Landing page
$router->get("/", "App\\controller\\HomeController@home");
$router->get("/about", "App\\controller\\HomeController@about");
$router->get("/contact", "App\\controller\\HomeController@1989contact");

// Auth 
$router->get("/register", "App\\controller\\UserAuthController@showRegister");
$router->post("/registerUser", "App\\controller\\UserAuthController@register");
$router->get("/login", "App\\controller\\UserAuthController@showLogin");
$router->post("/loginUser", "App\\controller\\UserAuthController@login");
$router->get("/logout", "App\\controller\\UserAuthController@logout");


// User dashboard
$router->get("/dashboard", "App\\controller\\UserController@showDashboard");
$router->get('/budget', "App\\controller\\BudgetController@showBudget");


// Goal dashboard
$router->get('/goal', "App\\controller\\GoalController@showGoal");
$router->get('/AddGoal', "App\\controller\\GoalController@showAdd");
$router->post('/goalStore', "App\\controller\\GoalController@storeGoal");
$router->get('/EditGoal/{id}', "App\\controller\\GoalController@showEdit");
$router->post('/goalEdit', "App\\controller\\GoalController@editGoal");
$router->post('/deleteGoal', "App\\controller\\GoalController@deleteGoal");
$router->post('/searchGoal', "App\\controller\\GoalController@searchGoals");
$router->get('/getUserGoal', "App\\controller\\GoalController@getUserGoal");


// Income dashboard
$router->get('/income', "App\\controller\\IncomeController@showIncomes");
$router->get('/addIncome', "App\\controller\\IncomeController@showAdd");
$router->post('/incomeStore', "App\\controller\\IncomeController@storeIncome");
$router->get('/EditIncome/{id}', "App\\controller\\IncomeController@showEdit");
$router->post('/incomeEdit', "App\\controller\\IncomeController@editIncome");
$router->post('/deleteIncome', "App\\controller\\IncomeController@deleteIncome");



