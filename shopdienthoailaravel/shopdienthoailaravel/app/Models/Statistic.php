<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = ['order_date','sales', 'profit','quantity','total_order'];
    protected $primaryKey = 'id_thongke   ';
    protected $table = 'tbl_thongke';
}
