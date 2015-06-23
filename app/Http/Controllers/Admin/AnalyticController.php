<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Services\AbcAnalyser;
use App\Product;
use App\Http\Controllers\Controller;
use App\Services\AssoziationAnalyse;
use App\Services\ComponentLister;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AnalyticController extends Controller
{

    private function getPageVars() {
        return [
            'page_title' => 'Admin'
        ];
    }


    /**
     * @return Response
     */
    public function abcAnalyse()
    {
      $analyser = new AbcAnalyser(Product::all());

      $groupA_ids = $analyser->getClassAProducts();
      $groupB_ids = $analyser->getClassBProducts();
      $groupC_ids = $analyser->getClassCProducts();

      $abc_values = $analyser->getProductValues();

      $allproductsA = Product::findMany($groupA_ids);
      $allproductsB = Product::findMany($groupB_ids);
      $allproductsC = Product::findMany($groupC_ids);

      $productsA = [];
      $productsB = [];
      $productsC = [];
  
      foreach ($allproductsA as $p) {
        $productsA[$p->productID] = [
          'name' => $p->name,
          'abc' => $abc_values[$p->productID]
        ];
      }

      uasort($productsA, function($a, $b) {
        return $b['abc'] - $a['abc'];
      });

      foreach ($allproductsB as $p) {
        $productsB[$p->productID] = [
          'name' => $p->name,
          'abc' => $abc_values[$p->productID]
        ];
      }

      uasort($productsB, function($a, $b) {
        return $b['abc'] - $a['abc'];
      });

      foreach ($allproductsC as $p) {
        $productsC[$p->productID] = [
          'name' => $p->name,
          'abc' => $abc_values[$p->productID]
        ];
      }

      uasort($productsC, function($a, $b) {
        return $b['abc'] - $a['abc'];
      });

      $data = [
        "productsA" => $productsA,
        "productsB" => $productsB,
        "productsC" => $productsC
      ];

      $data = array_merge( $this->getPageVars(), $data);

      return view('admin.analytic.abc', $data);
    }


    public function showPartsList() {
        $data = [];

        $data = array_merge( $this->getPageVars(), $data);

        $products = Product::all();

//        print_r($products);
        $data['products'] = [ $products ];

        return view ('admin.analytic.partsList', $data);
    }

    public function partsListOf($id) {

        $product = Product::find($id);


        $products = Product::all();
        if($product !== null) {
            $partsList = ComponentLister::listComponent($product);
        }

        $data = [];
        $data = array_merge($this->getPageVars(), $data);

        $data['partsList'] = [$partsList];
        $data['products'] = [$products];

        return view('admin.analytic.partsList', $data);
    }

    public function associationAnalyse() {

        $productIDs = Product::all()->lists('productID');

        $assocAnalyzer = new AssoziationAnalyse($productIDs, 2);
        $itemsets = $assocAnalyzer->analyse();

        $product_sets = [];
        foreach($itemsets as $itemset) {
            $product_sets[] = Product::find($itemset->getProductIDs());
        }

        $data = ['product_sets' => $product_sets];
        $data = array_merge($this->getPageVars(), $data);

        return view ('admin.analytic.association', $data);
    }

}
