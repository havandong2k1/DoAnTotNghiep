<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Toastr;
use App\Models\Brand;
use App\Models\Slider;
use App\Http\Requests;
use App\Models\CatePost;
use App\Models\Product;
use App\Models\CategoryProductModels;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
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
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = Brand::orderby('brand_id','desc')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout') -> with('admin.all_brand_product', $manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();

        Toastr::success('Thêm danh mục thành công','Success');
        return Redirect::to('add-brand-product');

    }

    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id) -> update(['brand_status' => 1]);
        Toastr::success('Gỡ thành công','Success');
        return Redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id) -> update(['brand_status' => 0]);
       
        Toastr::success('Kích hoạt thành công','Success');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id) -> get();
        $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout') -> with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request, $brand_product_id){
        $this->AuthLogin();
        // $data = array();
        // $data['brand_name'] = $request ->brand_product_name;
        // $data['brand_product_slug'] = $request->brand_slug;
        // $data['brand_desc'] = $request ->brand_product_desc;
        // DB::table('tbl_brand')->where('brand_id', $brand_product_id) ->update($data);
        $data = $request->all();
        $brand =  Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
         Toastr::success('Cập nhật thành công','Success');
        return Redirect::to('all-brand-product');

    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        Toastr::success('Xóa thành công','Success');
        return Redirect::to('all-brand-product');
    }

    // End Function Admin Page
    public function show_brand_home(Request $request, $brand_slug){
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();
        // $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug', $brand_slug)->paginate(9);
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug', '=',$brand_slug)->limit(1)->get();
        $brand_by_slug = Brand::where('brand_slug', $brand_slug)->get();

        foreach($brand_by_slug as $key => $bra){
            $brand_id = $bra->brand_id;
        }
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by=='giam_dan') {
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderByRaw('CAST(product_price AS DECIMAL(10,2)) DESC')->paginate(9)->appends(request()->query());    
            }elseif($sort_by=='tang_dan'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderByRaw('CAST(product_price AS DECIMAL(10,2)) ASC')->paginate(9)->appends(request()->query()); 
            }elseif($sort_by=='kytu_za'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_name', 'desc')->paginate(9)->appends(request()->query()); 
            }elseif($sort_by=='kytu_az'){
                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_name', 'asc')->paginate(9)->appends(request()->query()); 
            }
        }else{
            $brand_by_id = Product::with('brand')->where('brand_id',$brand_id)->orderBy('product_id', 'desc')->paginate(9);
        }
        $brand_by_id = Product::with('brand')
        ->where('brand_id', $brand_id)
        ->where('product_status', '0') // Add this line to exclude products with status 1
        ->orderBy('product_id', 'desc')
        ->paginate(9);
        foreach($brand_name as $key => $val){
            
            //seo 
            $meta_desc = $val->brand_desc; 
            $meta_keywords = $val->brand_desc;
            $meta_title = $val->brand_name;
            $url_canonical = $request->url();
            //--seo
        }

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }
}
