<?php
/**
 * User: DucNguyenMinh
 * Date: 6/4/15
 * Time: 11:23 PM
 */

namespace App\Services;


use App\Product;
use Illuminate\Support\Collection;

class AbcAnalyser {

  /**
   * @var array
   */
  private $revenueMap;

  /**
   * @var double
   */
  private $totalRevenue;

  /**
   * @var array
   */
  private $productsClassA;
  /**
   * @var array
   */
  private $productsClassB;
  /**
   * @var array
   */
  private $productsClassC;

  /**
   * @param Illuminate\Support\Collection
   */
  public function __construct(Collection $products) {

      $values = [];
      $sum = 0;

      foreach($products as $product) {
        $orderpositions = $product->orderpositions ? $product->orderpositions : [];

        $value = 0;

        foreach($orderpositions as $orderposition) {
          $value += $orderposition->mass * $product->price;
        }

        $values[$product->productID] = $value;

        $sum += $value;
      }

      arsort($values);

      $this->revenueMap = $values;

      $this->totalRevenue = $sum;
      
      $this->analyse();
  }

  private function analyse() {

    $_75percent = $this->totalRevenue * 75 / 100;   
    $_95percent = $this->totalRevenue * 95 / 100;   

    $sum = 0;
    foreach ($this->revenueMap as $id => $value) {

      if ($sum <= $_75percent) {
        $this->productsClassA[] = $id;
      } else if ($sum <= $_95percent) {
        $this->productsClassB[] = $id;
      } else {
        $this->productsClassC[] = $id;
      }

      $sum += $value;
    }

  }

  public function getClassAProducts() {
    return $this->productsClassA;
  }

  public function getClassBProducts() {
    return $this->productsClassB;
  }

  public function getClassCProducts() {
    return $this->productsClassC;
  }

  public function getProductValues() { 
    return $this->revenueMap;
  }

}
