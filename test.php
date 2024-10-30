<?php

function fibonacci($num)
{
    $num = $num - 2;
    $fibo = [0, 1];

    for ($i = 0; $i <= $num; $i++) {

            if ($num == 1) {
                return $fibo;
            }
            elseif ($num > 2) {
                $set = $fibo[$i] + $fibo[$i + 1];
                $fibo[] = $set;
            }
        
    }
    return $fibo;
}

$fiboSeries = fibonacci(10);
print_r($fiboSeries);
