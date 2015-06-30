<?php
    /**
     * Created by PhpStorm.
     * User: DucNguyenMinh
     * Date: 6/23/15
     * Time: 11:42 PM
     */
    namespace App\Services;

    use App\Order;
    use App\Product;

    class ItemSet
    {

        /**
         * @var array all productIDs
         */
        private $productIDs;

        /**
         * @var int
         */
        private $size;

        /**
         * @var float support score
         */
        private $support;

        /**
         * @var array productIDs grouped by transactions
         */
        private static $transactions = [];

        /**
         * @param array $productIDs
         */
        function __construct(array $productIDs)
        {
            $this->productIDs = $productIDs;
            $this->size = count($productIDs);
            $this->support = null;
        }

        /**
         * @param $n number of elements in subsets
         *
         * @return array<ItemSet>
         */
        public function getSubsets($n)
        {
            $subsets_array = $this->getSubsetsArray($this->productIDs, $n);

            return array_map(function ($subset) {
                return new ItemSet($subset);
            }, $subsets_array);
        }

        /**
         * @param ItemSet $set
         * @return ItemSet
         */
        public function getComplementItemSet(ItemSet $set)
        {
            $complements = array_diff($this->getProductIDs(), $set->getProductIDs());

            return new ItemSet($complements);
        }

        private function getSubsetsArray($itemSet, $n)
        {
            if ($n == 1) {
                $allSubsets = array_map(function ($item) {
                    return [$item];
                }, $itemSet);

                return $allSubsets;
            }
            $allSubsets = [];
            for ($i = 0; $i < count($itemSet); $i++) {
                $current = $itemSet[$i];
                $postArray = array_slice($itemSet, $i + 1);
                $postSubSets = $this->getSubsetsArray($postArray, $n - 1);
                if (empty($postSubSets)) break;
                foreach ($postSubSets as $postSubSet) {
                    $allSubsets[] = array_merge([$current], $postSubSet);
                }

            }

            return $allSubsets;
        }

        /**
         * Return Support score
         * @return float
         */
        public function getSupport()
        {
            if ($this->support === null) {
                $this->support = $this->calculateSupport();
            }

            return $this->support;
        }

        /**
         * @return int
         */
        public function getSize()
        {
            return $this->size;
        }

        /**
         * Calculate Support score
         * @return void
         */
        private function calculateSupport()
        {
            $support = 0;
            foreach (self::getTransactions() as $transactions) {
                $contain = true;
                foreach ($this->productIDs as $productID) {
                    if (!in_array($productID, $transactions)) {
                        $contain = false;
                        break;
                    }
                }
                if ($contain) $support++;
            }

            return ((double)$support) / count(self::getTransactions());
        }

        /**
         * @return array
         */
        public function getProductIDs() {
            return $this->productIDs;
        }

        /**
         * @return array
         */
        public function getProducts() {
            return Product::find($this->getProductIDs());
        }

        /**
         * @param array $itemsets
         *
         * @return Itemset
         */
        public static function merge(array $itemsets)
        {
            $productIDs = [];
            foreach ($itemsets as $itemset)  {
                $productIDs = array_merge($productIDs, $itemset->getProductIDs());
            }

            $unique_productIDs = array_values(array_unique($productIDs));
            return new Itemset($unique_productIDs);
        }

        /**
         * productIDs grouped by Transactions
         * @return array
         */
        private static function getTransactions()
        {
            if (empty(self::$transactions)) {
                $allOders = Order::all();
                self::$transactions = [];
                foreach ($allOders as $order) {
                    self::$transactions[] = $order->orderpositions->lists('productID');
                }
            }
            echo "<pre>";
            print_r(self::$transactions);
            return self::$transactions;
        }
    }
