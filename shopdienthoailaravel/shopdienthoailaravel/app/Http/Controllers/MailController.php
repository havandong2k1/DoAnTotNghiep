<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Mail;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CatePost;
use App\Models\Slider;
use DB;
use Toastr;

class MailController extends Controller
{

    public function send_coupon(){
        $customer = Customer::where('customer_status' ,1)->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mại ngày".' '.$now;
        $data= [];
        foreach($customer as $cus){
            $data['email'][] = $cus->customer_email;
        }
        
        Mail::send('pages.send_coupon', $data, function ($message) use ($title_mail, $data) {
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });
        Toastr::success('Gửi mail cho khách hàng thành công','Success');
        return redirect()->back();
    }

    public function quen_mat_khau(Request $request){
        // bài viết
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        // SEO
        $meta_desc = "Quên mật khẩu";
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Quên mật khẩu";
        $url_canonical = $request->url();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('category_id', 'desc')->paginate(9); 
        return view('pages.checkout.forget_pass')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    public function recover_pass(Request $request){
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Khôi phục mật khẩu".' '.$now;
        $customer = Customer::where('customer_email', '=' , $data['email_account'])->get();

        foreach($customer as $key => $value){
            $customer_id = $value->customer_id;
        }

        if ($customer) {
            $count_customer = $customer->count();
            if ($count_customer == 0) {
                return redirect()->back()->with('error', 'Email chưa được đăng ký để khôi phục mật khẩu');
            }
            else{
                $token_random = Str::random(20);
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();

                $to_email = $data['email_account']; // gửi đến email khôi phục 
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail, "body"=>$link_reset_pass, 'email'=>$data['email_account']); // nội dung body mail
                Mail::send('pages.checkout.forget_pass_notify', ['data'=>$data], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'],$title_mail);
                });
                // send mail
                return redirect()->back()->with('message', 'Gửi mail thành công, vui lòng check mail để lấy lại mật khẩu');

            }
        }

    }

    public function update_new_pass(Request $request){
        // bài viết
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        // SEO
        $meta_desc = "Quên mật khẩu";
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Quên mật khẩu";
        $url_canonical = $request->url();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('category_id', 'desc')->paginate(9); 
        return view('pages.checkout.new_pass_reset')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider',$slider)->with('category_post',$category_post);
    }

    public function reset_new_pass(Request $request){

        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=' ,$data['email'])->where('customer_token','=' , $data['token'])->get();
        $count = $customer->count();
        if ($count>0) {
            foreach($customer as $cus){
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('login-checkout')->with('message', 'Cập nhật mật khẩu thành công. Quay lại trang đăng nhập');
        }
        else {
            return redirect('quen-mat-khau')->with('error', 'Vui lòng đăng nhập lại email vì link quá hạn');
        }
    }

}
