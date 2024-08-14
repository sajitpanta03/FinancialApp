<?php
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
$router->post('/searchIncome', "App\\controller\\IncomeController@searchIncomes");

// Budget dashboard
$router->get('/budget', "App\\controller\\BudgetController@showBudgets");
$router->get('/addBudget', "App\\controller\\BudgetController@showAdd");
$router->post('/budgetStore', "App\\controller\\BudgetController@storeBudget");
$router->get('/EditBudget/{id}', "App\\controller\\BudgetController@showEdit");
$router->post('/budgetEdit', "App\\controller\\BudgetController@editBudget");
$router->post('/deleteBudget', "App\\controller\\BudgetController@deleteBudget");
$router->post('/searchBudget', "App\\controller\\BudgetController@searchBudget");

// Expense dashboard
$router->get('/expense', "App\\controller\\ExpenseController@showExpense");
$router->get('/AddExpense', "App\\controller\\ExpenseController@showAdd");
$router->post('/expenseStore', "App\\controller\\ExpenseController@storeExpense");
$router->get('/EditExpense/{id}', "App\\controller\\ExpenseController@showEdit");
$router->post('/expenseEdit', "App\\controller\\ExpenseController@editExpense");
$router->post('/deleteExpense', "App\\controller\\ExpenseController@deleteExpense");
$router->post('/searchExpense', "App\\controller\\ExpenseController@searchExpenses");
$router->get('/getUserExpense', "App\\controller\\ExpenseController@getUserExpense");

// Analytic dashboard
$router->get('/analytic', "App\\controller\\AnalyticController@showAnalytic");
$router->get('/apriori', "App\\controller\\AnalyticController@apriori");
$router->get('/aprioriReport', 'App\\controller\\AnalyticController@apioriReport');
$router->get('/aprioriPDF', 'App\\controller\\AnalyticController@generatePdfReport');

// Calculation dashboard
$router->get('/calculation', "App\\controller\\CalculationController@showCalculation");
$router->get('/amortizationSchedule', "App\\controller\\CalculationController@AmortizationSchedule");
$router->get('/amortizationResult', "App\\controller\\AmortizationSchedule@amortizationResult");

