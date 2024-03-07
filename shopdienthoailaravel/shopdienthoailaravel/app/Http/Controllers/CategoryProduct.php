<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Toastr;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\CategoryProductModels;
use App\Models\Product;
session_start();
class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        $category = CategoryProductModels::orderby('category_id', 'desc')->get();
        return view('admin.add_category_product')->with(compact('category'));
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->paginate(10);
        $manager_category_product  = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);


    }
    public function save_category_product(Request $request){
        $this->AuthLogin();

        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status ;
        DB::table('tbl_category_product')->insert($data);
        Toastr::success('Thêm danh mục thành công','Success');
        return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id) -> update(['category_status' => 1]);
        Toastr::success('Gỡ thành công','Success');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id) -> update(['category_status' => 0]);
        Toastr::success('Kích hoạt thành công','Success');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();

        $category = CategoryProductModels::orderby('category_id', 'desc')->get();

        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id) -> get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product)->with('category', $category);
        return view('admin_layout') -> with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request ->category_product_name;
        $data['meta_keywords'] = $request ->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_desc'] = $request ->category_product_desc;
        DB::table('tbl_category_product')->where('category_id', $category_product_id) ->update($data);
        Toastr::success('Cập nhật thành công','Success');
        return Redirect::to('all-category-product');

    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id) ->delete();
        Toastr::success('Xóa thành công','Success');
        return Redirect::to('all-category-product');
    }

    // End Function Admin Page

    public function show_category_home(Request $request, $slug_category_product){
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();
        // $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product', $slug_category_product)->where('product_status', '=', 1)->paginate(9);

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product','=',
            $slug_category_product)->limit(1)->get();
        $category_by_slug = CategoryProductModels::where('slug_category_product', $slug_category_product)->get();

        foreach($category_by_slug as $key => $cate){
            $category_id = $cate->category_id;
        }
       

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by=='giam_dan') {
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderByRaw('CAST(product_price AS DECIMAL(10,2)) DESC')->paginate(9)->appends(request()->query());    
            }elseif($sort_by=='tang_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderByRaw('CAST(product_price AS DECIMAL(10,2)) ASC')->paginate(9)->appends(request()->query()); 
            }elseif($sort_by=='kytu_za'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_name', 'desc')->paginate(9)->appends(request()->query()); 
            }elseif($sort_by=='kytu_az'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_name', 'asc')->paginate(9)->appends(request()->query()); 
            }
        }else{
            $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_id', 'desc')->paginate(9);
        }
        $category_by_id = Product::with('category')
        ->where('category_id', $category_id)
        ->where('product_status', '0') // Add this line to exclude products with status 1
        ->orderBy('product_id', 'desc')
        ->paginate(9);

        foreach ($category_name as $key => $val) {
            
            $meta_desc = $val ->category_desc;
            $meta_keywords = $val ->category_desc;
            $meta_title = $val ->category_name;
            $url_canonical = $request->url();

        }

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    public function product_tabs(Request $request){
        $data = $request->all();
        $output ='';
        $product = Product::where('category_id', $data['cate_id'])->where('product_status','0')->orderBy('product_id', 'desc')->get();

        $product_count = $product->count();
        if ($product_count > 0) {
            $output.= '<div class="tab-content">
                            <div class="tab-pane fade active in" id="tshirt">';
            foreach($product as $key => $pro){
                $output.= '
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="'.url('/public/upload/product/'.$pro->product_image).'" alt="'.$pro->product_name.'" />
                                        <h2>'.number_format($pro->product_price,0,',','.').' VNĐ</h2>
                                        <p>'.$pro->product_name.'</p>
                                        <a href="'.url('/chi-tiet-san-pham/'.$pro->product_slug).'" class="btn btn-defualt add-to-cart">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
            
        $output.='  
                </div>
            </div>';
        }else{
            $output.= '
            <div class="tab-content"> 
                <div class="tab-pane fade active in" id="t-shirt">
                    <div class="col-sm-12">
                        <p style="color:red; text-align:center; font-weight:bold">Chưa có sản phẩm thuộc danh mục</p>
                    </div>
                </div>
            </div>
            ';  
        }
        
        echo $output;

    }




}
