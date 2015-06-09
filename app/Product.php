<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Request;

class Product extends Model
{

    protected $table = 'products';
    protected $primaryKey = 'productID';
    protected $fillable = ['name', 'description', 'technicalSpec', 'price', 'units'];


    protected static $rules = ['name' => 'required', 'description' => 'required|min:10', 'technicalSpec' => 'required|min:10', 'price' => 'required'];


    static function validate(array $params)
    {
        $validator = Validator::make($params, static::$rules);

        return $validator;
    }

    /**
     * @param array $params
     *
     * @return static
     */
    static function save_product(array $params)
    {
        $cat_ids = array_key_exists('categories', $params) ? $params['categories'] : [];
        $subpart_ids = array_key_exists('subparts', $params) ? $params['subparts'] : [];;
        $product = Product::create($params);
        print_r($params['image']);
        $image = Image::new_image($params['image']);
        $product->images()->save($image);
        foreach ($cat_ids as $id) {
            $product->categories()->attach($id);
        }
        $product->subparts()->detach();
        foreach ($subpart_ids as $id) {
            $product->subparts()->attach($id);
        }

        return $product;
    }

    /**
     * @param array $params
     *
     * @return bool|int
     */
    function update_product(array $params)
    {
        $cat_ids = array_key_exists('categories', $params) ? $params['categories'] : [];
        $subpart_ids = array_key_exists('subparts', $params) ? $params['subparts'] : [];
        // print_r($params['image']);
        if (array_key_exists('image', $params)) {
            $image = Image::new_image($params['image']);
            $this->images()->save($image);
        }
        $this->categories()->detach();
        foreach ($cat_ids as $id) {
            $this->categories()->attach($id);
        }
        $this->subparts()->detach();
        foreach ($subpart_ids as $id) {
            $this->subparts()->attach($id);
        }

        return $this->update($params);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function images()
    {
        return $this->hasMany('App\Image', 'ProductID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function subParts()
    {
        return $this->belongsToMany('App\Product', "components", "upperPart", "subPart")->withTimestamps();
    }

    function orderpositions()
    {
        return $this->hasMany('App\Orderposition','productID');
    }
}
