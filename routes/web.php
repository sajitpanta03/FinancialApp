<?php

use App\middleware\AdminMiddleware;
use App\middleware\AuthMiddleware;

// Landing page
$router->get("/", "App\\controller\\HomeController@home");
$router->get("/about", "App\\controller\\HomeController@about");
$router->get("/contact", "App\\controller\\HomeController@contact");

// Auth 
$router->get("/register", "App\\controller\\UserAuthController@showRegister");
$router->post("/registerUser", "App\\controller\\UserAuthController@register");
$router->get("/login", "App\\controller\\UserAuthController@showLogin");
$router->post("/loginUser", "App\\controller\\UserAuthController@login");
$router->get("/logout", "App\\controller\\UserAuthController@logout");


// User dashboard
$router->get("/dashboard", "App\\controller\\UserController@showDashboard", [AuthMiddleware::class]);
$router->get('/budget', "App\\controller\\BudgetController@showBudget", [AuthMiddleware::class]);

// Goal dashboard
$router->get('/goal', "App\\controller\\GoalController@showGoal", [AuthMiddleware::class]);
$router->get('/AddGoal', "App\\controller\\GoalController@showAdd", [AuthMiddleware::class]);
$router->post('/goalStore', "App\\controller\\GoalController@storeGoal", [AuthMiddleware::class]);
$router->get('/EditGoal/{id}', "App\\controller\\GoalController@showEdit", [AuthMiddleware::class]);
$router->post('/goalEdit', "App\\controller\\GoalController@editGoal", [AuthMiddleware::class]);
$router->post('/deleteGoal', "App\\controller\\GoalController@deleteGoal", [AuthMiddleware::class]);
$router->post('/searchGoal', "App\\controller\\GoalController@searchGoals", [AuthMiddleware::class]);
$router->get('/getUserGoal', "App\\controller\\GoalController@getUserGoal", [AuthMiddleware::class]);

// Income dashboard
$router->get('/income', "App\\controller\\IncomeController@showIncomes", [AuthMiddleware::class]);
$router->get('/addIncome', "App\\controller\\IncomeController@showAdd", [AuthMiddleware::class]);
$router->post('/incomeStore', "App\\controller\\IncomeController@storeIncome", [AuthMiddleware::class]);
$router->get('/EditIncome/{id}', "App\\controller\\IncomeController@showEdit", [AuthMiddleware::class]);
$router->post('/incomeEdit', "App\\controller\\IncomeController@editIncome", [AuthMiddleware::class]);
$router->post('/deleteIncome', "App\\controller\\IncomeController@deleteIncome", [AuthMiddleware::class]);
$router->post('/searchIncome', "App\\controller\\IncomeController@searchIncomes", [AuthMiddleware::class]);

// Budget dashboard
$router->get('/budget', "App\\controller\\BudgetController@showBudgets", [AuthMiddleware::class]);
$router->get('/addBudget', "App\\controller\\BudgetController@showAdd", [AuthMiddleware::class]);
$router->post('/budgetStore', "App\\controller\\BudgetController@storeBudget", [AuthMiddleware::class]);
$router->get('/EditBudget/{id}', "App\\controller\\BudgetController@showEdit", [AuthMiddleware::class]);
$router->post('/budgetEdit', "App\\controller\\BudgetController@editBudget", [AuthMiddleware::class]);
$router->post('/deleteBudget', "App\\controller\\BudgetController@deleteBudget", [AuthMiddleware::class]);
$router->post('/searchBudget', "App\\controller\\BudgetController@searchBudget", [AuthMiddleware::class]);

// Expense dashboard
$router->get('/expense', "App\\controller\\ExpenseController@showExpense", [AuthMiddleware::class]);
$router->get('/AddExpense', "App\\controller\\ExpenseController@showAdd", [AuthMiddleware::class]);
$router->post('/expenseStore', "App\\controller\\ExpenseController@storeExpense", [AuthMiddleware::class]);
$router->get('/EditExpense/{id}', "App\\controller\\ExpenseController@showEdit", [AuthMiddleware::class]);
$router->post('/expenseEdit', "App\\controller\\ExpenseController@editExpense", [AuthMiddleware::class]);
$router->post('/deleteExpense', "App\\controller\\ExpenseController@deleteExpense", [AuthMiddleware::class]);
$router->post('/searchExpense', "App\\controller\\ExpenseController@searchExpenses", [AuthMiddleware::class]);
$router->get('/getUserExpense', "App\\controller\\ExpenseController@getUserExpense", [AuthMiddleware::class]);

// Analytic dashboard
$router->get('/analytic', "App\\controller\\AnalyticController@showAnalytic", [AuthMiddleware::class]);
$router->get('/apriori', "App\\controller\\AnalyticController@apriori", [AuthMiddleware::class]);
$router->get('/aprioriReport', 'App\\controller\\AnalyticController@apioriReport', [AuthMiddleware::class]);
$router->get('/aprioriPDF', 'App\\controller\\AnalyticController@generatePdfReport', [AuthMiddleware::class]);

// Calculation dashboard
$router->get('/calculation', "App\\controller\\CalculationController@showCalculation", [AuthMiddleware::class]);
$router->get('/amortizationSchedule', "App\\controller\\CalculationController@AmortizationSchedule", [AuthMiddleware::class]);
$router->post('/amortizationResult', "App\\controller\\AmortizationSchedule@amortizationResult", [AuthMiddleware::class]);


// Admin dashboard
$router->get('/admin', "App\\controller\\AdminController@index", [AdminMiddleware::class]);
$router->get('/adminDashboard', "App\\controller\\AdminController@adminDashboard", [AdminMiddleware::class]);