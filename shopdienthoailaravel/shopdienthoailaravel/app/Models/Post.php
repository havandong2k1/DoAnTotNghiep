<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = ['post_title', 'post_desc','post_slug', 'post_content','post_meta_desc','post_meta_keywords','post_status','post_image', 'cate_post_id','post_views'];
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_posts';

    public function cate_post(){
        return $this->belongsTo('App\Models\CatePost', 'cate_post_id', 'cate_post_id');
    }
}
