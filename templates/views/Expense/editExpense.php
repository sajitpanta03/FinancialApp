<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/formStyle.css">
    <title>Edit Expense</title>
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
        <h1>Edit Expense</h1>
    </div>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class='{$_SESSION['message_type']}'>{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>

    <form id="goalForm" method="POST" action="/FinancialApp/expenseEdit">
        <fieldset>
            <legend>Expense Information</legend>

            <label for="name">Expense Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($expense['name']); ?>" required>

            <label for="name">Expense Description:</label>
            <input type="text" id="name" name="description" value="<?php echo htmlspecialchars($expense['description']); ?>" required>

            <label for="target_amount">Amount:</label>
            <input type="number" id="target_amount" name="amount" value="<?php echo htmlspecialchars($expense['amount']); ?>" required>

            <label for="budget_id">Budget:</label>
            <select id="budget_id" name="budget_id" required>
                <?php foreach ($budgets as $bud): ?>
                    <option value="<?php echo $bud['id']; ?>" <?php if ($expense['budget_id'] == $bud['id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($bud['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </fieldset>

        <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="submit" value="Submit">
    </form>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .h1Container {
            max-width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        .backButton {
            border-radius: 50%;
            cursor: pointer;
            background-color: black;
            height: 50px;
            width: 50px;
            border: none;
            margin-right: 186px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            padding: 15px;
        }

        legend {
            font-size: 1.2em;
            color: #333;
            font-weight: bold;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="email"] {
            width: calc(100% - 22px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #goalForm select {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        #goalForm select:focus {
            outline: none;
            border-color: #007bff;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</body>

</html>
