<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;;
use App\Http\Requests;
use App\Models\Gallery;
use Session;
use Toastr;
use Illuminate\Support\Facades\Redirect;
session_start();

class GalleryController extends Controller
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

    public function add_gallery($product_id){
        $pro_id = $product_id;
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }

    public function select_gallery(Request $request){
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output =  ' 
                    <form>
                    '.csrf_field().'
                    <table class="table table-condensed">
                    <thead>
                        <tr>
                        <th>Thứ tự</th>
                        <th>Tên hình ảnh</th>
                        <th>Hình ảnh</th>
                        <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
        

        if($gallery_count > 0){
            $i = 0;
            foreach($gallery as $i => $gal){
                $i++;
                $output.=' 
                    <tr>
                    <td>'.$i.'</td>
                    <td contenteditable class="edit_gallery_name">'.$gal->gallery_name.'</td>
                    <td>
                    <img src="'.url('public/upload/gallery/'.$gal->gallery_image).'" class="img-thumbnail" style="height: 150px; width: auto;">
                    <input type="file" class="file_image" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" name="file" accept="image/*" style="margin-top: 10px"/>
                    </td>
                    <td><button type="button" data-gal_id="'.$gal->gallery_id.'" class="btn btn-xs btn-danger delete_gallery">Xóa</button></td>
                    </tr> 
            ';
            }
        }else{
            $output.=' 
                    <tr>
                        <td colspan="4">Sản phẩm chưa có thư viện ảnh</td>
                    </tr>
                ';
        }
        echo $output;
    }

    public function insert_gallery(Request $request, $pro_id){
        $get_image = $request->file('images');
        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.'_'.date('Ymd_his').'.'.$image->getClientOriginalExtension();
                $image->move('public/upload/gallery', $new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }

            Toastr::success('Thêm ảnh thành công','Success');
        } else {
            
            Toastr::info('Vui lòng chọn ảnh cần tải lên!','Success');
        }

        
        return redirect()->back();

    }
    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('public/upload/gallery/'.$gallery->gallery_image);
        $gallery->delete();
    }

    public function update_gallery(Request $request){
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.'_'.date('Ymd_his').'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/gallery', $new_image);
            $gallery = Gallery::find($gal_id);
            
            unlink('public/upload/gallery/'.$gallery->gallery_image);
            $gallery->gallery_image = $new_image;
            $gallery->save();
        }
    }
}
