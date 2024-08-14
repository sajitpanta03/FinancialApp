<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amortization Form</title>
</head>
<body>
    <h1>Amortization Schedule Form</h1>
    <form action="amortizationResult" method="POST">
        <label for="principal">Principal Amount:</label>
        <input type="number" id="principal" name="principal" step="0.01" required><br>

        <label for="annual_rate">Annual Interest Rate (%):</label>
        <input type="number" id="annual_rate" name="annual_rate" step="0.01" required><br>

        <label for="terms_in_years">Terms (in years):</label>
        <input type="number" id="terms_in_years" name="terms_in_years" required><br>

        <input type="submit" value="Generate Schedule">
    </form>
</body>
</html>


<?php
 echo '<h1>Amortization Schedule</h1>';
 echo '<table border="1">';
 echo '<tr><th>Payment Number</th><th>Principal Payment</th><th>Interest Payment</th><th>Total Payment</th><th>Balance</th></tr>';

 if (is_array($scheduleData)) {
     foreach ($scheduleData as $data) {
         echo '<tr>';
         echo '<td>' . htmlspecialchars($data['Payment Number']) . '</td>';
         echo '<td>' . htmlspecialchars($data['Principal Payment']) . '</td>';
         echo '<td>' . htmlspecialchars($data['Interest Payment']) . '</td>';
         echo '<td>' . htmlspecialchars($data['Total Payment']) . '</td>';
         echo '<td>' . htmlspecialchars($data['Balance']) . '</td>';
         echo '</tr>';
     }
 } else {
     echo '<tr><td colspan="5">No data available.</td></tr>';
 }

 echo '</table>';
?>