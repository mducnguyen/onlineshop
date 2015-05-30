<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    protected $fillable = ['customerID', 'orderedDate'];


    public function orderpositions()
    {
        return $this->hasMany('App\OrderPosition', 'orderID');
    }
}
