<?php namespace App\Http\Controllers;
use App\Product;
use App\User;
use Request;
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
		$productWithCoreI5 = Product::where('technicalDisc', '=', 'Corei5')->get();
		$data = ['products' => $products, 'productWithCoreI5' => $productWithCoreI5 ];
		return view('product.product', $data);
	}

	public function addView() {
		return view('product.add');
	}

	public function add(){
    $validator = Product::validate(Request::all());
    if (!$validator->fails()) {
      Product::save_product(Request::all());
      return redirect('product');
    } else {
      return redirect('product')->with('message', 'Validation error');
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
	    return redirect('product')->with('message', 'Product with id '.$id.' cannot be found');
    } else if ($validation->fails()) {
	    return redirect('product')->with('message', 'Validation error');
    } else {
      $product->update_product(Request::all());
	    return redirect('product');
    }

	}


	public function delete($id) {
		$product = Product::find($id);
		$product->delete();
	    return redirect('product')->with('message', 'Product '.$product->name.' deleted!!');
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
}
