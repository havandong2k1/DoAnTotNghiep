<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;
use App\Http\Requests;
use App\Models\Slider;
use App\Models\CatePost;
use Illuminate\Support\Facades\Redirect;
session_start();
class ContactController extends Controller
{
    public function lien_he(Request $request){

    	// bài viết
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        // SEO
        $meta_desc = "Liên hệ với chúng tôi";
        $meta_keywords = "Liên hệ";
        $meta_title = "Liên hệ với chúng tôi";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();
    	return view('pages.lienhe.contact')->with('category', $cate_product)->with('brand', $brand_product)->with('category_post', $category_post)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider',$slider);
    }
}
