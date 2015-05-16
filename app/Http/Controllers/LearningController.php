<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LearningController extends Controller {

	public function showBlade(){
		return view('learning.showBlade');
	}
}
