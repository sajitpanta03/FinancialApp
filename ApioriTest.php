<?php
require "Apiori.php";

$expenses = [
    ['food', 'transport'],
    ['food', 'entertainment'],
    ['transport', 'food'],
    ['food', 'bills'],
    ['bills', 'transport']
];

$minSupport = 0.5;
$minConfidence = 0.6;

$apriori = new Apriori($minSupport, $minConfidence);
$apriori->loadTransactions($expenses);
$apriori->run();

$frequentItemsets = $apriori->getFrequentItemsets();
print_r($frequentItemsets);
