<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Models\Roles;
use App\Models\Admin;
use App\Models\Customer;
use Spatie\Permission\Traits\HasRoles; 
use Session;
use DB;
use Toastr;
use Auth;
session_start();
class UserController extends Controller
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
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.user.all_users')->with(compact('admin'));
    }
    public function add_users(){
        return view('admin.user.add_users');
    }
    public function delete_user($admin_id){
        if(Auth::id() == $admin_id){
            Toastr::info('Thao tác không thành công');
            return redirect()->back();
        }
        $admin = Admin::find($admin_id);
        if($admin){
           $admin->roles()->detach();
           $admin->delete();
        }
        Toastr::success('Xóa nhân viên thành công','Success');
        return redirect()->back();
   
    }
    public function assignRoles(Request $request){
        $user = Admin::findOrFail($request->admin_id);

        // Detach tất cả các vai trò trước đó
        $user->roles()->detach();

        // Attach vai trò mới nếu được chọn
        if (!empty($request->roles)) {
            $user->roles()->attach(Roles::whereIn('name', $request->roles)->get());
        }

        // Redirect hoặc thực hiện các thao tác cần thiết sau khi phân quyền
        return response()->json([
            'status' => 1,
            'data' => $user->toArray(),
            'message' => 'success!'
        ]);
    }

    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','staff')->first());
        Toastr::success('Thêm user thành công','Success');
        return Redirect::to('users');
    }

    public function all_customer(){
        $this->AuthLogin();
        $all_customer = Customer::orderby('customer_id','desc')->get();
        $manager_customer = view('customer')->with('all_customer', $all_customer);
        return view('admin_layout') -> with('admin.all_customer', $manager_customer);
    }
    public function delete_customer($customer_id){
        $this->AuthLogin();
        DB::table('tbl_customer')->where('customer_id', $customer_id)->delete();
        Toastr::success('Xóa thành công','Success');
        return Redirect::to('all-customer');
    }

    
   
}
