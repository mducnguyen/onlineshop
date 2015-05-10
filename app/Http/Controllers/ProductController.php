<?php namespace App\Http\Controllers;
use App\Product;
use App\User;
use Request;
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
		$product = new Product();

		$product->name = REQUEST::input('name');
		$product->description = REQUEST::input('description');
		$product->technicalDisc = REQUEST::input('technicalDisc');
		$product->price = REQUEST::input('price');

	    $product->save();
	    return redirect('product');
	}

	public function editView($id) {
		$product = Product::find($id);
		return view('product.edit', ['product' => $product]);
	}

	public function update($id){
		$product = Product::find($id);

		$product->name = REQUEST::input('name');
		$product->description = REQUEST::input('description');
		$product->technicalDisc = REQUEST::input('technicalDisc');
		$product->price = REQUEST::input('price');

	    $product->save();

	    return redirect('product');
	}


	public function delete($id) {
		$product = Product::find($id);
		$product->delete();
	    return redirect('product')->with('message', 'Product '.$product->name.' deleted!!');
	}

	public function search(){
		$term = REQUEST::input('searchTerm');
		$products = Product::where('name', 'like', "%$term%")->get();
		return view('product.search', ['products' => $products]);
	}
}
