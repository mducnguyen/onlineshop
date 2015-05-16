<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Request;

class Product extends Model {

	protected $table = 'products';
	protected $primaryKey = 'productID';
  protected $fillable = [
      'name',
      'description',
      'technicalDisc',
      'price',
  ];


  protected static $rules = [
    'name' => 'required',
    'description' => 'required|min:10',
    'technicalDisc' => 'required|min:10',
    'price' => 'required'
  ];


  static function validate(array $params){
    $validator = Validator::make($params, static::$rules);
    return $validator;
  }

  /**
   * @param array
   */
  static function save_product(array $params) {

      return Product::create($params);
      // $product = new Product();

      // $product->name = $params['name'];
      // $product->description = $params['description'];
      // $product->technicalDisc = $params['technicalDisc'];
      // $product->price = $params['price'];

      // return $product->save();
  }

  /**
   * @param array
   */
  function update_product(array $params) {

      $this->name = $params['name'];
      $this->description = $params['description'];
      $this->technicalDisc = $params['technicalDisc'];
      $this->price = $params['price'];

      return $this->save();
  }

  function images() {
    return $this->hasMany('App\Image', 'ProductID');
  }
}
