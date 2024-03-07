<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use DB;
use Session;
use Toastr;
use Auth;
class SliderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_slider(){
        $all_slide = Slider::orderBy('slider_id','DESC')->paginate(10);
        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }
    public function add_slider(){
        return view('admin.slider.add_slider');
    }
    public function unactive_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>1]);
        
        Toastr::success('Gỡ slider thành công','Success');
        return Redirect::to('manage-slider');

    }
    public function active_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>0]);
        Toastr::success('Kích hoạt slide thành công','Success');
        return Redirect::to('manage-slider');

    }

    public function insert_slider(Request $request){

        $this->AuthLogin();

        $data = $request->all();
        $get_image = request('slider_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/slider', $new_image);

            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
            $slider->save();
            Toastr::success('Thêm slide thành công','Success');
            return Redirect::to('add-slider');
        }else{
            
            Toastr::warning('Làm ơn thêm hình ảnh','Warning');
            return Redirect::to('add-slider');
        }
        
    }
    public function delete_slide(Request $request, $slide_id){
        $slider = Slider::find($slide_id);
        $slider->delete();
        Toastr::success('Xóa slide thành công','Success');
        return redirect()->back();

    }
}
