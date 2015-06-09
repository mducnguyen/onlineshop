<?php namespace App\Http\Controllers;

use App\BasketItem;
use App\Http\Requests;
use App\Order;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use App\Http\Controllers\Controller;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user() === null)
            return redirect('auth\login');

//        print_r();
        $data =  [
            'basket_items' => $this->allBasketItemsData()
        ];

        return view('cart.index', $data);
    }

    /**
     * @return array
     */
    private function allBasketItemsData() {

        $user = Auth::user();

        $items = $user->basketItems;

        $basket_items = [];
        foreach ($items as $i) {
            $item = [
                'itemID' => $i->id,
                'image' => '/img/'.$i->product->images->first()->filename,
                'name' => $i->product->name,
                'productID' => $i->product->productID,
                'price' => $i->product->price,
                'units' => $i->units,
                'total' => $i->units * $i->product->price,
            ];

            $basket_items[] = $item;
        }

        return $basket_items;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function add(Request $request)
    {
        $product_id = $request->input('productID');

        if (($user = Auth::user()) !== null) {
            try {
                $product = Product::findOrfail($product_id);

                $item = BasketItem::where(['userID' => $user->id, 'productID' => $product_id])->first();

                if ($item == null) {
                    $item = new BasketItem(['productID' => $product_id, 'units' => 1]);
                } else {
                    $item->units++;
                }

                $user->basketItems()->save($item);

                return redirect('/');

            } catch (ModelNotFoundException $e) {
                // _TODO: redirect back
            }
        } else {
            return redirect('cart');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update(Requests\UpdateBasketItems $request ,$id)
    {
        $item = BasketItem::findOrFail($id);

        $item->units = $request->input("units");

        $item->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        BasketItem::destroy($id);
        return redirect()->back();
    }

    public function checkout() {

        $user = Auth::user();
        if($user === null || $user->basketItems->isEmpty()) {
           return redirect('/cart/');
        }

        $data =  [
            'basket_items' => $this->allBasketItemsData(),
            'user' => $user
        ];

        return view('cart.checkout', $data);
    }

    public function order() {

        $user = Auth::user();

        if($user === null || $user->basketItems->isEmpty()) {
           return redirect('/cart/');
        }
        $order = Order::createOrder($user, $user->basketItems);

//        $basket_item_ids = array_map(function($i) { return $i['id']; }, Auth::user()->basketItems->toArray());
//        BasketItem::destroy($basket_item_ids);

        $user->basketItems()->delete();


        return view('cart.confirm', compact('order'));
    }
}
