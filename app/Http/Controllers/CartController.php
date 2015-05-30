<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Product;
use Session;
use App\Http\Controllers\Controller;
use \Illuminate\Database\Eloquent\ModelNotFoundException; 

use Illuminate\Http\Request;

class CartController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function add(Request $request)
	{
    $product_id = $request->input('productID');

    try {
      $product = Product::findOrfail($product_id);
      $items = Session::get('cart.items');
      if ($items === null || !is_array($items)) {
        $items = [ $product_id => 1 ];
      } else {
        $items[$product_id] = isset($items[$product_id]) ? $items[$product_id] + 1 : 1; 
      }

      Session::put('cart.items', $items); 

      return redirect('/');

    } catch (ModelNotFoundException $e) {
      // _TODO: redirect back
    }

    

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
