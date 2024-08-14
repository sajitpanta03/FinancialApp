<?php
 echo '<h1>Amortization Schedule</h1>';
    echo '<table border="1">';
    echo '<tr><th>Payment Number</th><th>Principal Payment</th><th>Interest Payment</th><th>Total Payment</th><th>Balance</th></tr>';
    
    foreach ($scheduleData as $data) {
        echo '<tr>';
        echo '<td>' . $data['Payment Number'] . '</td>';
        echo '<td>' . $data['Principal Payment'] . '</td>';
        echo '<td>' . $data['Interest Payment'] . '</td>';
        echo '<td>' . $data['Total Payment'] . '</td>';
        echo '<td>' . $data['Balance'] . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
?>