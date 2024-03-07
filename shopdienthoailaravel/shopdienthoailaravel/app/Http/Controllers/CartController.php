<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Models\Coupon;
use App\Models\Slider;
use App\Models\CatePost;
use Carbon\Carbon;
use DB;
use Toastr;
use Session;
use Cart;
session_start();
class CartController extends Controller{
    public function save_cart(Request $request){

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_infor = DB::table('tbl_product')->where('product_id', $productId)->first();

        $data['id'] = $product_infor->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_infor->product_name;
        $data['price'] = $product_infor->product_price;
        $data['weight'] = $product_infor->product_price;
        $data['options']['image'] = $product_infor->product_image;
        Cart::add($data);
        Cart::setGlobalTax(10);
        // Cart::destroy();

        return Redirect::to('/show-cart');
    }
    public function show_cart(Request $request){

         $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo 
        //seo 
        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        //--seo
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);    
    }

    public function delete_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }
    // Cart Ajax
    public function gio_hang(Request $request){
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo 

        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        //--seo
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','asc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get(); 

        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }
    public function add_cart_ajax(Request $request){
        
        $data = $request->all();
        $session_id = substr(md5(microtime()).rand(0,26),5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name'=> $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
            'session_id' => $session_id,
            'product_name'=> $data['cart_product_name'],
            'product_id' => $data['cart_product_id'],
            'product_image' => $data['cart_product_image'],
            'product_quantity' => $data['cart_product_quantity'],
            'product_qty' => $data['cart_product_qty'],
            'product_price' => $data['cart_product_price'],
            );
            Session::put('cart', $cart);
        }
        
        Session::save();
    }
    public function delete_product($session_id){
        $cart = Session::get('cart');
        
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết lượt sử dụng');
        }
    }
    public function update_cart(Request $request){
    $data = $request->all();
    $cart = Session::get('cart');
    if($cart==true){
        $message = '';
        foreach($data['cart_qty'] as $key => $qty){
            foreach($cart as $session => $val){
                if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){
                    $cart[$session]['product_qty'] = $qty;
                    $message.=' Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công';
                }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                    $message.='Cập nhật số lượng: '.$cart[$session]['product_name'].' thất bại do số lượng trong kho không đủ';
                }
            }
        }
        Session::put('cart',$cart);
        return redirect()->back()->with('message',$message);
    }else{
        return redirect()->back()->with('message','Cập nhật số lượng thất bại do số lượng trong kho không đủ');
    }
    }
    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ hàng thành công');
        }
    }

    // Check COUPON
    public function check_coupon(Request $request){
    $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');       
    $data = $request->all();
        if (Session::get('customer_id')) {
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end', '>=' ,$today)->where('coupon_used','LIKE','%'.Session::get('customer_id').'%')->first();
            if ($coupon) {
                return redirect()->back()->with('message','Mã đã được sử dụng. Vui lòng chọn mã khác');
            }else{
                $coupon_login = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end', '>=' ,$today)->first();
                if($coupon_login){
                $count_coupon = $coupon_login->count();
                if($count_coupon>0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session==true){
                        $is_avaiable = 0;
                        if($is_avaiable==0){
                            $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number,

                            );
                            Session::put('coupon',$cou);
                        }
                    }else{
                        $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number,

                            );
                        Session::put('coupon',$cou);
                    }
                    Session::save();
                    return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                }
                }else{
                    return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết lượt sử dụng');
                }   
            }
        }else{
            
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end', '>=' ,$today)->first();
            if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
            }else{
                return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết lượt sử dụng');
            }   
        
        }
    }

    public function show_cart_menu(){
        $cartCount = count(Session::get('cart'));

        // quay trở lại trang giỏ hàng bằng JSON
        return response()->json($cartCount);
    }
}