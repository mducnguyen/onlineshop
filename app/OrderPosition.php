<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPosition extends Model {

    protected $fillable = ['orderID', 'productID', 'mass'];
    protected $table = 'orderpositions';

}
