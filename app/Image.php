<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image extends Model {

	public static function new_image(UploadedFile $file) {
		$image = new static();

		// _TODO: Name with product id
		$image->filename = $file->getClientOriginalName();

		$file->move(public_path().'/img/', $image->filename);
		
		return $image;
	} 

	protected $table = 'images';

	public function product() {
		return $this->belongsTo('App\Product', 'productID', 'productID');
	}
}
