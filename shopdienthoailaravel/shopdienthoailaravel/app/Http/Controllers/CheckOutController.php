<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use Toastr;
use App\Models\Slider;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\CatePost;
use App\Models\Coupon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CheckOutController extends Controller
{
    public function AuthLogin(){ 
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
           
        }
        else{
            return Redirect::to('admin')->send();
        }
    }

    public function login_checkout(Request $request){  
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();

         //seo 
        $meta_desc = "Đăng nhập"; 
        $meta_keywords = "Đăng nhập";
        $meta_title = "Đăng nhập";
        $url_canonical = $request->url();
        //--seo 

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();


        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    public function add_customer(Request $request) {
        // Kiểm tra xem email đã tồn tại hay chưa
        $existingCustomer = DB::table('tbl_customer')->where('customer_email', $request->customer_email)->first();

        if ($existingCustomer) {
            // Nếu email đã tồn tại, bạn có thể xử lý theo ý của mình, ví dụ: thông báo lỗi và redirect lại trang đăng ký
            return redirect('/login-checkout')->with('error', 'Email đã tồn tại. Vui lòng chọn email khác.');
        }
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_status'] = 1;
        $data['customer_password'] = md5($request->customer_password);
        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return Redirect::to('/show-checkout');
    }

    public function show_checkout(Request $request){
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        // seo
        $meta_desc = "Điền thông tin thanh toán"; 
        $meta_keywords = "Điền thông tin thanh toán";
        $meta_title = "Điền thông tin thanh toán";
        $url_canonical = $request->url();
        //--seo 

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();
        

        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }

    public function payment(Request $request) {
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo 

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post);
    }

    public function order_place(Request $request){
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //seo 
        $meta_desc = "Đăng nhập thanh toán"; 
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        //--seo


        //thêm hình thức thanh toán
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang xử lý đơn hàng';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //thêm order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] =  $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang xử lý đơn hàng';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //thêm order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] =  $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insertGetId($order_d_data);
        }
        if ( $data['payment_method']==1) {
            echo 'Thanh toán thẻ ATM';
        }
        elseif ( $data['payment_method']== 2) {
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

            return view('pages.checkout.cash_payment')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post);
            
        }
        else{
            echo 'Thanh toán thẻ Visa';
        }

        // return Redirect::to('/payment');
    }

    public function logout_checkout(){

        Session::forget('customer_id');
        Session::forget('coupon');
        Session::forget('cart');
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();

        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/show-checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
        Session::save();   
    }

    public function confirm_order(Request $request){
        $data = $request->all();
        // get coupon
        if (Session::get('coupon')==true) {
            $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
            $coupon->coupon_used = $coupon->coupon_used.','.Session::get('customer_id'); // chỉ được dùng mã giảm giá 1 lần
            $coupon->coupon_time = $coupon->coupon_time - 1 ;
            $coupon->save();


            // vận chuyển
            $shipping = new Shipping();
            $shipping->shipping_name = $data['shipping_name'];
            $shipping->shipping_email = $data['shipping_email'];
            $shipping->shipping_phone = $data['shipping_phone'];
            $shipping->shipping_address = $data['shipping_address'];
            $shipping->shipping_notes = $data['shipping_notes'];
            $shipping->shipping_method = $data['shipping_method'];
            $shipping->save();
            $shipping_id = $shipping->shipping_id;

            $checkout_code = substr(md5(microtime()),rand(0,26),5);

            
            $order = new Order;
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = $shipping_id;
            $order->order_status = 1;
            $order->order_code = $checkout_code;

            // date_default_timezone_set('Asia/Ho_Chi_Minh');
     
          
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order->created_at = now();
            $order->save();
            

            if(Session::get('cart')==true){
                foreach(Session::get('cart') as $key => $cart){
                    $order_details = new OrderDetails;
                    $order_details->order_code = $checkout_code;
                    $order_details->product_id = $cart['product_id'];
                    $order_details->product_name = $cart['product_name'];
                    $order_details->product_price = $cart['product_price'];
                    $order_details->product_sales_quantity = $cart['product_qty'];
                    $order_details->product_coupon =  $data['order_coupon'];
                    $order_details->product_feeship = $data['order_fee'];
                    $order_details->save();
                }
            }
            Session::forget('coupon');
            Session::forget('fee');
            Session::forget('cart');
        }else{
            $shipping = new Shipping();
            $shipping->shipping_name = $data['shipping_name'];
            $shipping->shipping_email = $data['shipping_email'];
            $shipping->shipping_phone = $data['shipping_phone'];
            $shipping->shipping_address = $data['shipping_address'];
            $shipping->shipping_notes = $data['shipping_notes'];
            $shipping->shipping_method = $data['shipping_method'];
            $shipping->save();
            $shipping_id = $shipping->shipping_id;

            $checkout_code = substr(md5(microtime()),rand(0,26),5);

            
            $order = new Order;
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = $shipping_id;
            $order->order_status = 1;
            $order->order_code = $checkout_code;

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order->created_at = now();
            $order->save();

            if(Session::get('cart')==true){
                foreach(Session::get('cart') as $key => $cart){
                    $order_details = new OrderDetails;
                    $order_details->order_code = $checkout_code;
                    $order_details->product_id = $cart['product_id'];
                    $order_details->product_name = $cart['product_name'];
                    $order_details->product_price = $cart['product_price'];
                    $order_details->product_sales_quantity = $cart['product_qty'];
                    $order_details->product_coupon =  $data['order_coupon'];
                    $order_details->product_feeship = $data['order_fee'];
                    $order_details->save();
                }
            }
            Session::forget('coupon');
            Session::forget('fee');
            Session::forget('cart');
        }    
    }

    // Thanh toán onepay
    public function onepay_payment(Request $request){

        /* -----------------------------------------------------------------------------

         Version 2.0

         @author OnePAY

        ------------------------------------------------------------------------------*/

        // *********************
        // START OF MAIN PROGRAM
        // *********************

        // Define Constants
        // ----------------
        // This is secret for encoding the MD5 hash
        // This secret will vary from merchant to merchant
        // To not create a secure hash, let SECURE_SECRET be an empty string - ""
        // $SECURE_SECRET = "secure-hash-secret";
        // Khóa bí mật - được cấp bởi OnePAY
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";

        // add the start of the vpcURL querystring parameters
        // *****************************Lấy giá trị url cổng thanh toán*****************************
        $vpcURL = 'https://mtf.onepay.vn/onecomm-pay/vpc.op' . "?";

        // Remove the Virtual Payment Client URL from the parameter hash as we 
        // do not want to send these fields to the Virtual Payment Client.
        // bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
        // unset($_POST["virtualPaymentClientURL"]); 
        // unset($_POST["SubButL"]);
        $data = $request->all();
        $code_cart = rand(0000,999999);
        $vpc_Merchant = 'ONEPAY';
        $vpc_AccessCode = 'D67342C2';
        $vpc_MerchTxnRef = date('YmdHis');
        $vpc_OrderInfo = $code_cart;
        $vpc_Amount = $_POST['total_onepay'];
        $vpc_ReturnURL = 'http://localhost/shopdienthoailaravel/show-checkout';
        $vpc_Version = '2';
        $vpc_Command = 'queryDR';
        $vpc_Locale = 'vn';
        $vpc_Currency = 'VND';
        $data = array(
            'vpc_Merchant' => $vpc_Merchant,
            'vpc_AccessCode' => $vpc_AccessCode,
            'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
            'vpc_OrderInfo' => $vpc_OrderInfo,
            'vpc_Amount' => $vpc_Amount,
            'vpc_ReturnURL' => $vpc_ReturnURL,
            'vpc_Version' => $vpc_Version,
            'vpc_Command' => $vpc_Command,
            'vpc_Locale' => $vpc_Locale,
            'vpc_Currency' => $vpc_Currency
        );
        //$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
        $stringHashData = "";
        // sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
        // arrange array data a-z before make a hash
        ksort ($data);

        // set a parameter to show the first pair in the URL
        // đặt tham số đếm = 0
        $appendAmp = 0;

        foreach($data as $key => $value) {

            // create the md5 input and URL leaving out any fields that have no value
            // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value; 
                //*********************sử dụng cả tên và giá trị tham số để mã hóa*************************
                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }
        //*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
        $stringHashData = rtrim($stringHashData, "&");
        // Create the secure hash and append it to the Virtual Payment Client Data if
        // the merchant secret has been provided.
        // thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
        if (strlen($SECURE_SECRET) > 0) {
            //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
            // *****************************Thay hàm mã hóa dữ liệu*****************************
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
        }

        // FINISH TRANSACTION - Redirect the customers using the Digital Order
        // ===================================================================
        // chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
        // header("Location: ".$vpcURL);
        return redirect()->to($vpcURL);
        // *******************
        // END OF MAIN PROGRAM
        // *******************


    }


    // Thanh toán VnPay
    public function vnpay_payment(Request $request){
        $data = $request->all();
        $code_cart = rand(0000,999999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/shopdienthoailaravel/show-checkout";
        $vnp_TmnCode = "SY8SX570";//Mã website tại VNPAY 
        $vnp_HashSecret = "KXCSIEUIIQTZXNCGJLDPYBTKGWAXBGRD"; //Chuỗi bí mật

        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'bill payment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                return redirect()->to($vnp_Url);
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
    }

    

}
