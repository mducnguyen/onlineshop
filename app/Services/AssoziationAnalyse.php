<?php
/**
 * Created by PhpStorm.
 * User: DucNguyenMinh
 * Date: 6/21/15
 * Time: 10:28 PM
 */

namespace App\Services;


use App\Order;
use App\Product;
use Illuminate\Support\Collection;

class AssoziationAnalyse {

    /**
     * @var array
     */
    private $allTransactions;

    /**
     * @var Collection
     */
    private $productIDs;

    /**
     * @var int >= 2
     */
    private $associationLevel;

    /**
     * @param array Product Ids
     * @param $associationLevel
     * @param $minSupport
     * @param $minConfidence
     */
    public function __construct(array $productIDs, $associationLevel = null, $minSupport = 0.1, $minConfidence = 0.4) {

        $this->productIDs = $productIDs;

        $this->minSupport = $minSupport;

        $this->minConfidence = $minConfidence;

        $this->associationLevel = (is_null($associationLevel) || $associationLevel < 2) ? PHP_INT_MAX - 1 : $associationLevel;

        $this->fetchAllTransactions();
    }

    public function analyseConfidence()
    {
        $rules = [];

        $itemsets = $this->analyse();

        foreach($itemsets as $itemset) {

            $size = $itemset->getSize();

            for($i = 1; $i < $size; $i++) {

                $subsets = $itemset->getSubsets($i);

                foreach($subsets as $set) {

                    $rule = new Rule($itemset, $set);
                    if ($rule->getConfidence() >= $this->minConfidence) {
                        $rules[] = $rule;
                    }

                }

            }
        }

        return $rules;
    }

    /**
     * @return array<Itemset>
     */
    public function analyse() {

        $anItemset = new Itemset($this->productIDs);
        $lastFreqItemset = [];
        for($k = 1; true; $k++) {

            // generate candidate itemsets
            $candicate_fi = $anItemset->getSubsets($k);

            // take only qualified itemsets
            $fi = [];
            foreach ($candicate_fi as $itemset) {
                if ($itemset->getSupport() >= $this->minSupport)
                    $fi[] = $itemset;
            }

            // if no new frequent itemset found, return the last one
            if (empty($fi) || $k == $this->associationLevel + 1){
                return $lastFreqItemset;
            }

            // save found frequent itemset
            $lastFreqItemset = $fi;

            $anItemset = ItemSet::merge($fi);
        }

        return $candicate_fi;
    }

    private function fetchAllTransactions()
    {
        $allOders = Order::all();
        $this->allTransactions = [];
        foreach ($allOders as $order) {
            $this->allTransactions[] = $order->orderpositions->lists('productID');
        }
    }

}
