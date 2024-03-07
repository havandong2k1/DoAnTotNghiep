<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use Session;
use DB;
use Auth;
use Toastr;
use Illuminate\Support\Facades\Redirect;
session_start();
class CouponController extends Controller
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
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){

            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
    }
    public function insert_coupon(){

        return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Toastr::success('Xóa mã giảm giá thành công','Success');
        return Redirect::to('list-coupon');
    }
    public function list_coupon(){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon = Coupon::orderby('coupon_id','DESC')->paginate(10);
        return view('admin.coupon.list_coupon')->with(compact('coupon','today'));
    }
    public function insert_coupon_code(Request $request){
        $data = $request->all();

        $coupon = new Coupon;

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
        $coupon->coupon_date_end = $data['coupon_date_end'];
        $coupon->save();

        Toastr::success('Thêm mã giảm giá thành công','Success');
        return Redirect::to('insert-coupon');


    }
     public function search_coupon_code(Request $request)
    {
        //seo 
        $meta_desc = "Tìm kiếm"; 
        $meta_keywords = "Tìm kiếm";
        $meta_title = "Tìm kiếm";
        $url_canonical = $request->url();
        //--seo
        $keywords = $request->keywords_submit;
        $search_coupon = DB::table('tbl_coupon')->where('coupon_code', 'like','%'.$keywords.'%')->get();

        return view('admin.coupon.search_coupon')->with('search_coupon', $search_coupon)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}
