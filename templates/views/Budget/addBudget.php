<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/formStyle.css">
    <title>Add Budget</title>
</head>

<body>

    <div class="backButton">
        <a href="javascript:history.back()" id="backButton">
            <svg height="50px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="50px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="100%" height="100%" fill="white" />
                <polygon points="352,128.4 319.7,96 160,256 160,256 160,256 319.7,416 352,383.6 224.7,256 " />
            </svg>
        </a>
    </div>

    <div class="h1Container">
        <h1>Add Budget</h1>
    </div>

    <form id="goalForm" method="POST" action="budgetStore">
        <fieldset>
            <legend>Budget Information</legend>

            <label for="name">Budget Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="amount">Budget Amount:</label>
            <input type="number" id="amount" name="total_amount" required>

            <label for="start_date">Start Date:</label>
            <input type="date" id="target_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="target_date" name="end_date" required>
        </fieldset>

        <input type="hidden" name="user_id" value="<?php
session_start();
echo $_SESSION['user_id'];
?>">
        <input type="submit" value="Submit">
    </form>

</body>

</html>
