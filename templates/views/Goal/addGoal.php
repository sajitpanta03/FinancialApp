<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/formStyle.css">
    <title>Add Goal</title>
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
        <h1>Add Goal</h1>
    </div>

    <form id="goalForm" method="POST" action="goalStore">
        <fieldset>
            <legend>Goal Information</legend>

            <label for="name">Goal Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="target_amount">Target Amount:</label>
            <input type="number" id="target_amount" name="target_amount" required>

            <label for="target_date">Target Date:</label>
            <input type="date" id="target_date" name="target_date" required>

            <label for="risk_tolerance">Risk Tolerance:</label>
            <div class="selectRisk">
                <select id="risk_tolerance" name="risk_tolerance" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <?php
if (!empty($budgetOfThatUser)) {
    ?>

<label for="risk_tolerance">Associated Budget:</label>
<div class="selectRisk">
    <select id="risk_tolerance" name="budget_id" required>
        <?php foreach ($budgetOfThatUser as $budgetName): ?>
            <option value="<?php echo htmlspecialchars($budgetName['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($budgetName['name'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
        <?php endforeach;?>
    </select>
</div>
<?php
} else {
    echo '<p>No budget names available.</p>';
}?>
        </fieldset>

        <input type="hidden" name="user_id" value="<?php
session_start();
echo $_SESSION['user_id'];
?>">
        <input type="submit" value="Submit">
    </form>

</body>

</html>