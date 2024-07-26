<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/innerStyle.css">
    <title>Goals</title>
</head>

<body>
    <?php include "userPage.php"; ?>
    <div class="topContainer">
        <div class="addButton">
            <a href="addIncome" class="button">+</a>
        </div>
    </div>

    <?php if (!empty($message)) : ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Income Name</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th style="background-color: green;">Action</th>
                </tr>
            </thead>
            <tbody id="goalsList">
                <?php if (!empty($incomes)) : ?>
                    <?php foreach ($incomes as $index => $income) : ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($income['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo 'Rs ' . htmlspecialchars($income['amount'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($income['type'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($income['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="EditIncome/<?php echo $income['id']; ?>" class="edit">Edit</a>&nbsp;&nbsp;
                                <div class="deleteButton">
                                    <form action="deleteIncome" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $income['id']; ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this goal?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No goals found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>