<?php namespace App\Http\Controllers;
use App\Product;
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

		return view('product.product', $data);
	}

	public function addView() {
		$errors = Session::get('errors');
		return view('product.add', ['errors'=>$errors]);
	}

	public function add(){
		$validator = Product::validate(Request::all());
		if (!$validator->fails()) {
			Product::save_product(Request::all());
			return redirect('product_manager');
		} else {
			return redirect()->to('/product/add')->withInput()->withErrors($validator->errors());
		}

	}

	public function editView($id) {
		$product = Product::find($id);
		return view('product.edit', ['product' => $product]);
	}

	public function update($id){

		$product = Product::find($id);

	    $validation = Product::validate(Request::all());

	    if ($product == null) {
		    return redirect('product_manager')->with('message', 'Product with id '.$id.' cannot be found');
	    } else if ($validation->fails()) {
		    return redirect('/product/'.$id.'/edit')->with('message', 'Validation error');
	    } else {
	      $product->update_product(Request::all());
		    return redirect('product_manager');
	    }

	}


	public function delete($id) {
		$product = Product::find($id);
		$product->delete();
	    return redirect('product_manager')->with('message', 'Product '.$product->name.' deleted!!');
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

	public function show($id) {
		$product = Product::find($id);

		return view('product.show', compact('product'));
	}
}
