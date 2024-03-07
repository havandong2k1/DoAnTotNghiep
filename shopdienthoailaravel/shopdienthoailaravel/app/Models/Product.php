<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = ['product_name','product_quantity', 'product_slug','category_id','brand_id','product_desc','product_content','product_price','product_image','product_status','product_tags','product_views'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function cate_product(){
        return $this->belongsTo('App\Models\CategoryProductModels', 'category_id', 'category_id');
    }
    public function cate_brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\CategoryProductModels', 'category_id', 'category_id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }
    public function galleries(){
        return $this->hasMany('App\Models\Gallery', 'product_id', 'product_id');
    }
    public function product(){
        return $this->hasMany('App\Models\Comment');
    }
}
