<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = ['comment_name', 'comment', 'comment_date','comment_product_id', 'comment_parent','comment_status'];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';

    public function product(){
        return $this->belongsTo('App\Models\Product','comment_product_id');
    }
}
