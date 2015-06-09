<?php
    /**
     * Created by PhpStorm.
     * User: DucNguyenMinh
     * Date: 6/6/15
     * Time: 12:35 AM
     */
    namespace App\Services;

    use App\Product;
    use Illuminate\Support\Facades\DB;

    class ComponentLister
    {


        /**
         * @return array
         */
        public static function listComponent(Product $product)
        {
//            print_r($product);
            $partsList = [];
            $partsList[$product->productID] = ["name" => $product->name, "level" => 1, "units" => 1];

            foreach ($product->subParts as $level2) {
                $level2Component= DB::table('components')->where('upperPart', "$product->productID")->where('subPart', "$level2->productID", true)->first();
                $level2Units = $level2Component->units;

                $partsList[$level2->productID] = ["name" => "  ".$level2->name, "level" => 2, "units" => $level2Units];

                foreach ($level2->subParts as $level3) {
                    $level3Units = DB::table('components')->where('upperPart', "$level2->productID")->where('subPart', "$level3->productID",true)->first()->units;
                    $partsList[$level3->productID] = ["name" => "    ".$level3->name, "level" => 3, "units" => $level3Units*$level2Units];
                }
            }

            return $partsList;

        }


    }