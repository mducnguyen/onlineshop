<?php
namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Image;
use App\User;
use Request;
use Session;
use Validator;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller {

	/**
	 * Show the application Test screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$products = Product::all();

		$data = ['products' => $products];

		return view('admin.product.product', $data);
	}

	public function create() {
		return view('admin.product.create');
	}

	public function store(CreateProductRequest $request){

		Product::save_product(Request::all());
		return redirect('/');
	}

	public function edit($id) {
		$product = Product::find($id);
		return view('admin.product.edit', ['product' => $product]);
	}

	public function update($id, CreateProductRequest $request){

		$product = Product::find($id);

	    if ($product == null) {
		    return redirect('/admin/product')->with('message', 'Product with id '.$id.' cannot be found');
	    } else {
	    	$product->update_product(Request::all());
	    	return redirect('/admin/product');
	    }

	}


	public function delete($id) {
		$product = Product::find($id);
		$product->delete();
	    return redirect('/admin/product')->with('message', 'Product '.$product->name.' deleted!!');
	}

	public function search() {
		$term = REQUEST::input('searchTerm');

    	$validator = Validator::make(['searchTerm' => $term], ['searchTerm' => 'required']);

    	if ($validator->fails()) {
      		return view('product.search', ['products' => array(), 'error' => 'Please enter search term']);
    	
    	} else {
      		
        $products = Product::where('name', 'like', "%$term%")->get();
      	
      	return view('product.search', ['products' => $products, 'error' => '']);
    	}
	}

	// public function show($id) {
	// 	$product = Product::find($id);

	// 	return view('product.show', compact('product'));
	// }
}
