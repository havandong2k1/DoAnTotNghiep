<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProductModels extends Model
{

    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'meta_keywords', 'category_name', 'slug_category_product','category_desc','category_parent','category_status'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    public function product(){
        return $this->hasMany('App\Models\Product');
    }
    public function brand(){
        return $this->hasMany('App\Models\Brand');
    }
}
