<?php

namespace App\utils;

class Apriori {
    private $minSupport;
    private $minConfidence;
    private $transactions;
    private $frequentItemsets;

    public function __construct($minSupport, $minConfidence) {
        $this->minSupport = $minSupport;
        $this->minConfidence = $minConfidence;
        $this->transactions = [];
        $this->frequentItemsets = [];
    }

    public function loadTransactions($transactions) {
        $this->transactions = $transactions;
    }

    public function getFrequentItemsets() {
        return $this->frequentItemsets;
    }

    private function generateCandidates($itemsets) {
        $candidates = [];
        $itemsetCount = count($itemsets);

        for ($i = 0; $i < $itemsetCount; $i++) {
            for ($j = $i + 1; $j < $itemsetCount; $j++) {
                $candidate = array_unique(array_merge($itemsets[$i], $itemsets[$j]));
                sort($candidate);
                if (count($candidate) == count($itemsets[0]) + 1) {
                    $candidates[] = $candidate;
                }
            }
        }
        return array_unique($candidates, SORT_REGULAR);
    }

    private function countSupport($itemset) {
        $count = 0;
        foreach ($this->transactions as $transaction) {
            if (count(array_intersect($itemset, $transaction)) == count($itemset)) {
                $count++;
            }
        }
        return $count;
    }

    private function getFrequentItemsetsFromCandidates($candidates) {
        $frequentItemsets = [];

        foreach ($candidates as $candidate) {
            $supportCount = $this->countSupport($candidate);
            if ($supportCount / count($this->transactions) >= $this->minSupport) {
                $frequentItemsets[] = [
                    'itemset' => $candidate,
                    'support' => $supportCount / count($this->transactions)
                ];
            }
        }
        return $frequentItemsets;
    }

    public function run() {
        $oneItemsets = [];
        foreach ($this->transactions as $transaction) {
            foreach ($transaction as $item) {
                $oneItemsets[] = [$item];
            }
        }
        $oneItemsets = array_unique($oneItemsets, SORT_REGULAR);
        $currentItemsets = $this->getFrequentItemsetsFromCandidates($oneItemsets);

        while (!empty($currentItemsets)) {
            $this->frequentItemsets = array_merge($this->frequentItemsets, $currentItemsets);
            $candidates = $this->generateCandidates(array_column($currentItemsets, 'itemset'));
            $currentItemsets = $this->getFrequentItemsetsFromCandidates($candidates);
        }
    }

    private function generateRules() {
        $rules = [];

        foreach ($this->frequentItemsets as $itemsetData) {
            $itemset = $itemsetData['itemset'];
            if (count($itemset) > 1) {
                $subsets = $this->getSubsets($itemset);
                foreach ($subsets as $subset) {
                    $confidence = $this->calculateConfidence($subset, $itemset);
                    if ($confidence >= $this->minConfidence) {
                        $rules[] = [
                            'rule' => [$subset, array_diff($itemset, $subset)],
                            'confidence' => $confidence
                        ];
                    }
                }
            }
        }

        return $rules;
    }

    private function getSubsets($itemset) {
        $subsets = [];
        $subsetCount = pow(2, count($itemset)) - 1;

        for ($i = 1; $i <= $subsetCount; $i++) {
            $subset = [];
            for ($j = 0; $j < count($itemset); $j++) {
                if ($i & (1 << $j)) {
                    $subset[] = $itemset[$j];
                }
            }
            $subsets[] = $subset;
        }

        return $subsets;
    }

    private function calculateConfidence($subset, $itemset) {
        $subsetSupport = $this->countSupport($subset);
        $itemsetSupport = $this->countSupport($itemset);

        return $itemsetSupport / $subsetSupport;
    }

    public function getAssociationRules() {
        return $this->generateRules();
    }
}
