<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Order extends Model
{
    protected $fillable = ['customerID', 'orderedDate'];


    /**
     * @param User $user
     * @param array $items
     */
    public static function createOrder(User $user, Collection $items) {

        $order = new Order(['orderedDate' => Carbon::now()]);

        $user->orders()->save($order);

        foreach($items as $i) {
            $orderposition = new OrderPosition([
                'productID' => $i->productID,
                'mass' => $i->units,
            ]);
            $order->orderpositions()->save($orderposition);
        }

        return $order;
    }

    public function orderpositions()
    {
        return $this->hasMany('App\OrderPosition', 'orderID');
    }
}
