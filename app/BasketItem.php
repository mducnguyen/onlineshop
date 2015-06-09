<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model {

    protected $fillable = [
        'productID', 'userID', 'units'
    ];

    public function product() {
      return $this->belongsTo('App\Product', 'productID');
    }

}
