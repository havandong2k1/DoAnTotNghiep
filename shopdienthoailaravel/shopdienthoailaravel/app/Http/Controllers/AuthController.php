<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use App\Models\Roles;
use Auth;
use Toastr;
use Session;
class AuthController extends Controller
{
    public function register_auth(){
        return view('admin.custom_auth.register');
    }
    public function register(Request $request){
        $this->validation($request);
        $data = $request->all();

        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return redirect('/register-auth')->with('message', 'Đăng ký thành công');
    }
    public function login_auth(){
        return view('admin.custom_auth.login_auth');
    }
    public function login(Request $request){
        $this->validate($request, [
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255',
        ]);
        // $data = $request->all();
        if (Auth::attempt(['admin_email'=>$request->admin_email,'admin_password'=>$request->admin_password ])) {
            Toastr::success('Đăng nhập thành công','Success');
            return Redirect::to('/dashboard');
        }
        else{
            
            Session::put('message','Email hoặc mật khẩu sai. Vui lòng kiểm tra lại thông tin đăng nhập');
            return Redirect::to('/login-auth');
        }
    }

    public function logout_auth(){
        Auth::logout();
        Session::put('message','Đăng xuất thành công');
        return Redirect::to('login-auth');
    }
}
