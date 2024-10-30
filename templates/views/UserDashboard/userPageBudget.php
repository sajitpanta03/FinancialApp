<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/innerStyle.css">
    <title>Budgets</title>
</head>

<body>
    <?php include "userPage.php"; ?>
    <div class="topContainer">
        <div class="addButton">
            <a href="addBudget" class="button">+</a>
        </div>
    </div>

    <div class="searchGoal">
        <form action="/FinancialApp/searchBudget" method="POST">
        <input type="text" id="search" name="search" class="searchTerm" placeholder="Search budget...">
        <button type="submit" class="searchButton">
            <svg fill="#000000" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 488.4 488.4" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6 s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2 S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7 S381.9,104.65,381.9,203.25z"></path> </g> </g> </g></svg>
        </button>
        </form>
    </div>

    <?php if (!empty($message)) : ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Budget Name</th>
                    <th>Total Amount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Created At</th>
                    <th style="background-color: green;">Action</th>
                </tr>
            </thead>
            <tbody id="goalsList">
                <?php if (!empty($budgets)) : ?>
                    <?php foreach ($budgets as $index => $budget) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($budget['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo 'Rs ' . htmlspecialchars($budget['total_amount'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($budget['start_date'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($budget['end_date'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($budget['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="EditBudget/<?php echo $budget['id']; ?>" class="edit">Edit</a>&nbsp;&nbsp;
                                <div class="deleteButton">
                                    <form action="deleteBudget" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $budget['id']; ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this goal?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No budgets found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>