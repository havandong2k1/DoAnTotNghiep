<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Models\Slider;
use App\Models\Product;
use App\Models\CatePost;
use App\Models\Gallery;
use App\Models\Comment;
use Session;
use Toastr;
use File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

session_start();
class ProductController extends Controller
{
    public function AuthLogin(){ 
       $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);

    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id', 'desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout') -> with('admin.all_product', $manager_product);


    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request ->product_name;
        $data['product_tags'] = $request ->product_tags;
        $data['product_quantity'] = $request ->product_quantity;
        $data['product_price'] = $request ->product_price;
        $data['product_slug'] = $request->product_slug;
        $data['product_desc'] = $request ->product_desc;
        $data['product_content'] = $request ->product_content;
        $data['category_id'] = $request ->product_cate;
        $data['brand_id'] = $request ->product_brand;
        $data['product_status'] = $request ->product_status;
        $data['product_image'] = $request ->product_status;
        $get_image = $request->file('product_image');
        $path = 'public/upload/product/';
        $path_gallery  = 'public/upload/gallery/';

        if ($get_image) {
            $get_name_image =  $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.'_'.date('Ymd_his').'.'.$get_image->getClientOriginalExtension();
            $get_image -> move($path, $new_image);
            File::copy($path.$new_image,$path_gallery.$new_image    );
            $data['product_image'] = $new_image;
           
        }
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();

        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        // DB::table('tbl_product')->insert($data);
        Toastr::success('Thêm sản phẩm thành công','Success');
        return Redirect::to('all-product');

    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id) -> update(['product_status' => 1]);
        Toastr::success('Gỡ sản phẩm thành công','Success');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id) -> update(['product_status' => 0]);
        Toastr::success('Hiển thị sản phẩm thành công','Success');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id) -> get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout') -> with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_tags'] = $request ->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image = $name_image.'_'.date('Ymd_his').'.'.$image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['product_image'] = $new_image;
                    DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
            
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Toastr::success('Cập nhật sản phẩm thành công','Success');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id) ->delete();
        Toastr::success('Xóa sản phẩm thành công','Success');
        return Redirect::to('all-product');
    }


    // End Admin Page
    public function details_product(Request $request, $product_slug)
    {
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();


        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();
        $details_product = Product::with('galleries')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=','tbl_product.brand_id')
        ->where('tbl_product.product_slug', $product_slug)->get();

        

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $meta_desc = $value->product_desc;
            $meta_keywords = $value->product_name;
            $meta_title = $value->product_name;
            $url_canonical = $request->url();
        }
        //Gallery
        $gallery = Gallery::where('product_id', $product_id)->get();
        //update view product
        $product = Product::where('product_id', $product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();
        // sản phẩm liên quan
        $relate_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=','tbl_product.brand_id')
        ->whereNotIn('tbl_product.product_slug',[$product_slug])->orderby(DB::raw('RAND()'))->paginate(6);


        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate', $relate_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post)->with('gallery',$gallery);
        
        
    }
    public function tag(Request $request, $product_tag){
        // cate
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();


        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();
        
        $tag = str_replace("-"," ", $product_tag);
        $pro_tag = Product::where('product_status', 0)->where('product_tags', 'LIKE', '%'.$tag.'%')->get();
        
        $meta_desc = 'Tags:' .$product_tag;
        $meta_keywords = 'Tags:' .$product_tag;
        $meta_title = 'Tags tìm kiếm:' .$product_tag;
        $url_canonical = $request->url();
       
        return view('pages.sanpham.tag')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('category_post',$category_post)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('product_tag',$product_tag)->with('pro_tag',$pro_tag);

    }

    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = Gallery::where('product_id', $product_id)->get();
        $output['product_gallery'] = '';
        foreach ($gallery as $key => $gal) {
            $output['product_gallery'] .= '<p><img width="100%" src="public/upload/gallery/'.$gal->gallery_image.'"></p>';  
        }
        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price,0,',','.').' '.'VNĐ';
        $output['product_image'] = '<p><img width="100%" src="public/upload/product/'.$product->product_image.'"></p>';
        
        $output['product_button'] = '<input type="button" value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview" data-id_product="'.$product->product_id.'" name="add-to-cart">';
        $output['product_quickview_value'] = '
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
       
        ';
        echo json_encode($output);

    }
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_parent','=',0)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent','>',0)->get();

        $output = '';
        foreach($comment as $cmt){
            $output .= '
            <div class="row style_comment">
                <div class="col-md-2 img_user ">
                   
                    <img style="width: 80%; height: auto;" src="'.url('/public/frontend/images/R.png').'" class="img img-reponsive img-thumbnail">
                </div>
                <div class="col-md-10 cmt_user">
                    <p style="color:#363432; font-weight: bold; font-size: 16px;">'.$cmt->comment_name.'</p>
                    <p style="color:#363432; font-weight: bold; font-size: 16px;">'.$cmt->comment_date.'</p>
                    <p>'.$cmt->comment.'</p>
                </div>
            </div>
            <p></p>
            ';
            foreach($comment_rep as $key => $rep_comment){
            if ($rep_comment->comment_parent==$cmt->comment_id) {
                   
                $output .= '
                <div class="row style_comment" style="margin: 5px 0px; margin-left:40px">
                    <div class="col-md-2 img_user">
                       
                        <img style="width: 50%; height: auto;" src="'.url('/public/frontend/images/OIP.jpeg').'" class="img img-reponsive img-thumbnail">
                    </div>
                    <div class="col-md-10 cmt_user">
                        <p style="color:#363432; font-weight: bold; font-size: 16px;">Thanh Tuyển Mobile</p>
                        <p style="color:#363432; font-weight: bold; font-size: 16px;">'.$rep_comment->comment.'</p>
                        <p></p>
                    </div>
                </div>
                <p></p>';
                }
            }
          
        } 
        echo $output;

    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment_name = $comment_name;
        $comment->comment = $comment_content;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 0;
        $comment->comment_parent = 0;
        $comment->save();


    }

    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent','=',0)->orderBy('comment_status', 'desc')->get();
        $comment_rep = Comment::with('product')->where('comment_parent','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }

    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id']; 
        $comment->comment_parent = $data['comment_id']; 
        $comment->comment_status = 0; 
        $comment->comment_name = 'Admin'; 
        $comment->save();
    }

    public function delete_comment($comment_id){
        $comment = Comment::find($comment_id);
        $comment->delete();
        Toastr::success('Xóa bình luận thành công','Success');
        return Redirect()->back();
    }
 
}
