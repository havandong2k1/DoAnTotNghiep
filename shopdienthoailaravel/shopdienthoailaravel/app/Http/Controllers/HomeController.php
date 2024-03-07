<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Product;
use App\Models\CategoryProductModels;
use Session;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    public function index(Request $request){

        // bài viết
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        // SEO
        $meta_desc = "Chuyên bán điện thoại, phụ kiện điện thoại chính hãng";
        $meta_keywords = "dien thoai, phu kien dien thoai, laptop, tai nghe";
        $meta_title = "Thanh Tuyển Mobile - chuyên điện thoại, phụ kiện chính hãng";
        $url_canonical = $request->url();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('category_id', 'desc')->paginate(9); 
        $cate_pro_tabs = CategoryProductModels::where('category_status', '0')->orderby('category_id', 'asc')->get();
       
       
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('cate_pro_tabs',$cate_pro_tabs);
    }
    public function search(Request $request){
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        
        // Slide
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
        
        // SEO
        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        
        // Data retrieval
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();
        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();

        // Message for no products found
        $no_product_message = $search_product->isEmpty() ? 'Sản phẩm không tồn tại' : null;

        // Pass variables to the view using an associative array
        return view('pages.sanpham.search', [
            'category' => $cate_product,
            'brand' => $brand_product,
            'search_product' => $search_product,
            'meta_desc' => $meta_desc,
            'meta_keywords' => $meta_keywords,
            'meta_title' => $meta_title,
            'url_canonical' => $url_canonical,
            'slider' => $slider,
            'category_post' => $category_post,
            'no_product_message' => $no_product_message,
        ]);
    }



    public function send_mail()
    {
        $to_name = "Thanh Tuyển Mobile";
        $to_email = "miomachi2001@gmail.com"; //gửi đến email này

        $data = array("name"=>"Mail from Guest", "body"=>"Kiểm tra kết nối"); //nội dung mail được gửi
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Test thử gửi mail google'); // gửi mail với nội dung
            $message->from($to_email,$to_name); //gửi từ email này
        });

        return Redirect('/')->with('message','');

    }

}
