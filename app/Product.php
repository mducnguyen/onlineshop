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
      'technicalSpec',
      'price',
      'units'
  ];


  protected static $rules = [
    'name' => 'required',
    'description' => 'required|min:10',
    'technicalSpec' => 'required|min:10',
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
  }

  /**
   * @param array
   */
  function update_product(array $params) {
      return Product::update($params);
  }

  function images() {
    return $this->hasMany('App\Image', 'ProductID');
  }

  function categories() {
    $this->belongsToMany('App\Category');
  }


  function subParts() {
    return $this->belongsToMany('App\Product', "components", "subPart");
  }
}
