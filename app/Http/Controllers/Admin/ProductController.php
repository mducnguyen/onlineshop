<?php
namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Image;
use App\User;
use Request;
use Session;
use Validator;

class ProductController extends Controller {

	public function  __construct() {
		$this->beforeFilter('@initpage');
	}

	public function initpage() {
		$this->replacements = ['page_title' => 'Admin'];
	}

	/**
	 * Show the application Test screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$products = Product::all();

		$data['products'] = $products;

		return view('admin.product.product', array_merge($data, $this->replacements));
	}

	public function create() {
		$all_cats = Category::all()->lists('name', 'id');
		$all_subparts = Product::all()->lists('name', 'productID');

		$data = array_merge($this->replacements, 
			['all_cats' => $all_cats, 
			'selected_cats' => [],
			'all_subparts' => $all_subparts,
			'selected_subparts' => [],
			'images' => []
			]);

		return view('admin.product.create', $data);
	}

	public function store(CreateProductRequest $request){

		Product::save_product($request->all());

		return redirect()->action('Admin\ProductController@index');
	}

	public function edit($id) {
		$product = Product::find($id);
		
		$all_cats = Category::all()->lists('name', 'id');
		$selected_cats = $product->categories->lists('id');

		$all_subparts = Product::all()->lists('name', 'productID');
		$selected_subparts = $product->subparts->lists('productID');

		$data = [
			'product' => $product,
			'all_cats' => $all_cats,
			'selected_cats' => $selected_cats,
			'all_subparts' => $all_subparts,
			'selected_subparts' => $selected_subparts,
			'images' => $product->images
		];

		$data = array_merge($this->replacements, $data);

		return view('admin.product.edit', $data);
	}

	public function update($id, CreateProductRequest $request){

		$product = Product::find($id);

		if ($product == null) {
			return redirect('/admin/product')->with('message', 'Product with id '.$id.' cannot be found');
		} else {
			$product->update_product($request->all());
			return redirect('/admin/product');
		}

	}


	public function destroy($id) {
		$product = Product::find($id);
		$product->delete();
		return redirect('/admin/product')->with('message', 'Product '.$product->name.' deleted!!');
	}

	public function search() {
		$term = REQUEST::input('searchTerm');

		$validator = Validator::make(['searchTerm' => $term], ['searchTerm' => 'required']);

		if ($validator->fails()) {

			$data =  ['products' => array(), 'error' => 'Please enter search term'];
			return view('product.search', array_merge($data, $this->replacements));

		} else {

			$products = Product::where('name', 'like', "%$term%")->get();
        //_TODO: refactor
			$data = ['products' => $products, 'error' => ''];	
			return view('product.search', array_merge($data, $this->replacements));
		}
	}

	public function addImageInput($id) {

	}
}
