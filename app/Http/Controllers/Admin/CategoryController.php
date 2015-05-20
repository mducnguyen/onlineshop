<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller {

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
		$categories = Category::all();

		$data['categories'] = $categories;

		return view('admin.category.list', array_merge($data, $this->replacements));
	}

  // _TODO: idempotent
  public function create() {
    return view('admin.category.create', $this->replacements);
  }

  public function store(CategoryRequest $request) {

    Category::create($request->all());

    return redirect()->action('Admin\CategoryController@index');
  }

  public function update(CategoryRequest $request, $id) {

    $category = Category::find($id);

    $category->update($request->all());

    return redirect()->action('Admin\CategoryController@index')->with('message', 'Category '.$category->name.' updated.');;
  }

  public function edit($id) {

    $category = Category::find($id);

    $data =array_merge($this->replacements, ['category' => $category]) ;

    return view('admin.category.edit', $data);
  }

  public function show($id) {
  }

  public function destroy($id) {
		$category = Category::find($id);
    if ($category === null) {
      return redirect()->action('Admin\CategoryController@index')->with('message', 'Category with ID '.$category->id.' deleted.');
    } else {
      $category->delete();
      return redirect()->action('Admin\CategoryController@index')->with('message', 'Category '.$category->name.' deleted.');
    }
  }

}
