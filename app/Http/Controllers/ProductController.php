<?php namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\CreateProductRequest;
use App\Image;
use App\User;
use App\Category;
use Request;
use Session;
use Validator;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{

    /**
     * Show the application Test screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $data = ['products' => $products, 'categories' => $categories];

        return view('product.product', $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('product.create');
    }

    public function store(CreateProductRequest $request)
    {
        Product::save_product(Request::all());

        return redirect('/');

    }

    public function editView($id)
    {
        $product = Product::find($id);

        return view('product.edit', ['product' => $product]);
    }

    public function update($id)
    {
        $product = Product::find($id);
        $validation = Product::validate(Request::all());
        if ($product == null) {
            return redirect('product_manager')->with('message', 'Product with id ' . $id . ' cannot be found');
        } else if ($validation->fails()) {
            return redirect('/product/' . $id . '/edit')->with('message', 'Validation error');
        } else {
            $product->update_product(Request::all());

            return redirect('/');
        }

    }


    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('product_manager')->with('message', 'Product ' . $product->name . ' deleted!!');
    }

    public function search()
    {
        $term = REQUEST::input('searchTerm');
        $categories = Category::all();
        $validator = Validator::make(['searchTerm' => $term], ['searchTerm' => 'required']);
        if ($validator->fails()) {
            return view('product.search', ['products' => [], 'error' => 'Please enter search term']);

        } else {
            $products = Product::where('name', 'like', "%$term%")->get();

            return view('product.search', ['products' => $products, 'error' => '', 'categories' => $categories]);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('product.show', compact('product', 'categories'));
    }
}
