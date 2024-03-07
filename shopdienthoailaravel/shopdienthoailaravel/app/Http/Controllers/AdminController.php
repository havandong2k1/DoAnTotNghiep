<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Socialite;
use App\Models\Login;
use App\Models\Social;
use App\Http\Requests;
use App\Rules\Captcha;
use App\Models\Roles;
use App\Models\Statistic;
use App\Models\Visitors;
use App\Models\Order;
use App\Models\Product;
use App\Models\Post;
use App\Models\Customer;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles; 
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
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

    public function index(){
        return view('admin.custom_auth.login_auth');
    }
    public function show_dashboard(Request $request){
        $this->AuthLogin();
        //total
        $product = Product::all();
        $product_views = Product::orderBy('product_views', 'desc')->take(20)->get();
        $post = Post::all()->count();
        $post_views = Post::orderBy('post_views', 'desc')->take(20)->get();
        $order = Order::all()->count();
        $customer = Customer::all()->count();

        return view('admin.dashboard')->with(compact('product','post','order','customer','product_views','post_views'));
    }
    public function dashboard(Request $request){

        $data = $request->validate([
            //validation laravel 
            'admin_email' => 'required',
            'admin_password' => 'required',
            'g-recaptcha-response' => new Captcha(),    //dòng kiểm tra Captcha
        ]);

        $admin_email =  $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
       
        if($login){
            $login_count = $login->count();
            if($login_count>0){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                return Redirect::to('/dashboard');
            }
        }else{
            Session::put('message','Email hoặc mật khẩu sai. Vui lòng kiểm tra lại thông tin đăng nhập');
            return Redirect::to('/admin');
        }
        

    }
     public function logout(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date', [$from_date, $to_date])->orderby('order_date', 'asc')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, //period: giai đoạn từ bao nhiêu đến bao nhiêu
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);  
    }

    public function order_date(Request $request){
        $order_date = $_GET['date'];
        $order = Order::where('order_date', $order_date)->orderBy('created_at', 'desc')->get();
        return view('admin.order_date')->with(compact('order'));
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value']=='7ngay') {
            $get = Statistic::whereBetween('order_date',[$sub7days, $now])->orderby('order_date', 'asc')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc, $cuoi_thangtruoc])->orderby('order_date', 'asc')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay, $now])->orderby('order_date', 'asc')->get();
        }else{
            $get = Statistic::whereBetween('order_date',[$sub365days, $now])->orderby('order_date', 'asc')->get();
        }

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, //period: giai đoạn từ bao nhiêu đến bao nhiêu
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity

            );
        }
        echo $data = json_encode($chart_data);  
    }

    public function days_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date', [$sub30days,$now])->orderby('order_date', 'asc')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, //period: giai đoạn từ bao nhiêu đến bao nhiêu
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity

            );
        }
        echo $data = json_encode($chart_data); 
    }

}
