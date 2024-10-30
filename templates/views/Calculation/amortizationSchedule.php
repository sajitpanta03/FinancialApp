<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amortization Schedule</title>
    <style>
        /* Global Styles */
        body {
            background-color: #1e1e1e;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        h1 {
            color: #00e676;
        }

        /* Form Styles */
        form {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 350px;
            margin-top: 50px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #444;
            background-color: #555;
            color: #e0e0e0;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #00e676;
            color: #1e1e1e;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #00c853;
        }

        /* Table Styles */
        .tb {
            max-height: 400px;
            /* Adjust the height limit */
            overflow-y: auto;
            /* Enable vertical scroll */
            overflow-x: auto;
            /* Enable horizontal scroll */
            margin-top: 20px;
            border: 1px solid #444;
            /* Optional: Add a border around the table */
            border-radius: 5px;
            /* Optional: Rounded corners */
        }

        /* Table styles for better presentation */
        table {
            width: 100%;
            /* Take full width of the container */
            border-collapse: collapse;
            /* Merge borders */
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #444;
        }

        th {
            background-color: #444;
            color: #00e676;
        }

        td {
            background-color: #555;
            color: #e0e0e0;
        }

        tr:nth-child(even) td {
            background-color: #666;
        }

        /* Optional: Add a hover effect for table rows */
        tr:hover td {
            background-color: #777;
        }
    </style>
</head>

<body>

    <div class="form">
        <h1>Amortization Schedule Form</h1>
        <form action="amortizationResult" method="POST">
            <label for="principal">Principal Amount:</label>
            <input type="number" id="principal" name="principal" step="0.01" required>

            <label for="annual_rate">Annual Interest Rate (%):</label>
            <input type="number" id="annual_rate" name="annual_rate" step="0.01" required>

            <label for="terms_in_years">Terms (in years):</label>
            <input type="number" id="terms_in_years" name="terms_in_years" required>

            <input type="submit" value="Generate Schedule">
        </form>
    </div>

    <!-- Additional Information Display -->
    <!-- <div class="additional-info">
        <h2>Amortization Details:</h2>
        <p><strong>Principal Amount:</strong> $<?php echo htmlspecialchars($principal); ?></p>
        <p><strong>Annual Interest Rate:</strong> <?php echo htmlspecialchars($annual_rate); ?>%</p>
        <p><strong>Term:</strong> <?php echo htmlspecialchars($terms_in_years); ?> years</p>
    </div> -->

    <h1>Amortization Schedule</h1>
    <div class="tb">
        <table>
            <thead>
                <tr>
                    <th>Payment Number</th>
                    <th>Principal Payment</th>
                    <th>Interest Payment</th>
                    <th>Total Payment</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>

                <?php if (isset($scheduleData) && is_array($scheduleData)) : ?>
                    <?php foreach ($scheduleData as $data) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($data['Payment Number']); ?></td>
                            <td><?php echo htmlspecialchars($data['Principal Payment']); ?></td>
                            <td><?php echo htmlspecialchars($data['Interest Payment']); ?></td>
                            <td><?php echo htmlspecialchars($data['Total Payment']); ?></td>
                            <td><?php echo htmlspecialchars($data['Balance']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>


                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>