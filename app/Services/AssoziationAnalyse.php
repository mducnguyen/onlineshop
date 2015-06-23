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
     * @param array Product Ids
     * @param $minSupport
     * @param $minConfidence
     */
    public function __construct(array $productIDs, $minSupport = 0.1, $minConfidence = 0.7) {

        $this->productIDs = $productIDs;

        $this->minSupport = $minSupport;

        $this->minConfidence = $minConfidence;

        $this->fetchAllTransactions();
    }

    private function getSubset($itemSet, $n) {

        if( $n == 1 ) {
            $allSubsets = array_map(function ($item) {
                return [$item];
            }, $itemSet);
            return $allSubsets;
        }

        $allSubsets = [];

        for( $i = 0; $i < count($itemSet); $i++){

            $current  = $itemSet[$i];

            $postArray = array_slice($itemSet, $i+1);

            $postSubSets = self::getSubset($postArray, $n - 1);

            if(empty($postSubSets)) break;

            foreach($postSubSets as $postSubSet) {
                $allSubsets[] = array_merge([$current], $postSubSet);
            }

        }

        return $allSubsets;

    }


    public function analyse() {

        $productIDs = $this->productIDs;
        $lastFreqItemset = [];
        for($k = 1; true; $k++) {

            $fi = $this->getSubset($productIDs, $k);

            $supports = [];
            foreach ($fi as $itemset) {
                $support = $this->getSupportOf($itemset);
                if ($support >= $this->minSupport)
                    $supports[json_encode($itemset)] = $support;
            }

            if (empty($supports)){
                return $lastFreqItemset;
            }

            $lastFreqItemset = [];
            foreach($supports as $set => $support) {
                $lastFreqItemset[] = json_decode($set);
            }

            $productIDs = $this->getProductIDsFromFrequentItemset($lastFreqItemset);
        }

        return $fi;
    }

    /**
     * @param array Frequent Itemset
     * @return array
     */
    private function getProductIDsFromFrequentItemset(array $fi) {
        $productIDs = [];
        foreach ($fi as $itemset)  {
            $productIDs = array_merge($productIDs, $itemset);
        }

        return array_values(array_unique($productIDs));
    }

    /**
     * @param $productIDs // _TODO
     *
     * @return float support value of products
     */
    private function getSupportOf($productIDs){

        $support = 0;

        foreach($this->allTransactions as $transactions) {
            $contain = true;
            foreach($productIDs as $productID) {
                if(!in_array($productID, $transactions)){
                    $contain = false;
                    break;
                }
            }
            if($contain) $support++;
        }

        return ((double)$support)/count($this->allTransactions);
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
