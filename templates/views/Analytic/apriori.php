<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apriori Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        .download-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h1>Apriori Report</h1>

<h2>Transactions Data</h2>
<table>
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Items</th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($transactions)): ?>
            <?php foreach ($transactions as $index => $transaction): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo is_array($transaction) ? implode(', ', $transaction) : $transaction; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No transactions data available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h2>Frequent Itemsets</h2>
<table>
    <thead>
        <tr>
            <th>Itemset</th>
            <th>Support</th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($frequentItemsets)): ?>
            <?php foreach ($frequentItemsets as $itemsetData): ?>
                <tr>
                    <td><?php echo is_array($itemsetData['itemset']) ? implode(', ', $itemsetData['itemset']) : $itemsetData['itemset']; ?></td>
                    <td><?php echo $itemsetData['support']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No frequent itemsets data available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h2>Association Rules</h2>
<table>
    <thead>
        <tr>
            <th>Rule</th>
            <th>Confidence</th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($associationRules)): ?>
            <?php foreach ($associationRules as $rule): ?>
                <tr>
                    <td><?php echo is_array($rule['rule'][0]) ? implode(', ', $rule['rule'][0]) : $rule['rule'][0]; ?> => <?php echo is_array($rule['rule'][1]) ? implode(', ', $rule['rule'][1]) : $rule['rule'][1]; ?></td>
                    <td><?php echo $rule['confidence']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No association rules data available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<p><a href="aprioriReport" class="download-btn">Download Apriori Report</a></p>

</body>
</html>
