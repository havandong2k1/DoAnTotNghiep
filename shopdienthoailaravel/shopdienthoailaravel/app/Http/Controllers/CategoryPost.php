<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Toastr;
use Auth;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use App\Models\CatePost;
class CategoryPost extends Controller
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

    public function add_category_post(){
        $this->AuthLogin();
        return view('admin.category_post.add_category_post');
    }
    public function all_category_post(){
        $this->AuthLogin();
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->paginate(6);
        
        return view('admin.category_post.list_category_post')->with(compact('category_post'));

    }
    public function save_category_post(Request $request){
        $this->AuthLogin();

        $data = $request->all();
        $category_post = new CatePost();
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();

         Toastr::success('Thêm bài viết thành công','Success');
        return Redirect()->back();
    }


    public function danh_muc_bai_viet($cate_post_slug){

    }
   
    public function edit_category_post($category_post_id){
        $this->AuthLogin();

        $category_post = CatePost::find($category_post_id);

        return view('admin.category_post.edit_category_post') -> with(compact('category_post'));
    }
    public function update_category_post(Request $request, $cate_id){
        $this->AuthLogin();
        $data = $request->all();
        $category_post = CatePost::find($cate_id);
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();
        Toastr::success('Cập nhật thành công','Success');
        return Redirect::to('/all-category-post');

    }
    public function search_categorypost(Request $request)
    {
        //seo 
        $meta_desc = "Tìm kiếm"; 
        $meta_keywords = "Tìm kiếm";
        $meta_title = "Tìm kiếm";
        $url_canonical = $request->url();
        //--seo
        $keywords = $request->keywords_submit;
        $search_categorypost = DB::table('tbl_category_post')->where('cate_post_name', 'like','%'.$keywords.'%')->get();

        return view('admin.category_post.search_category_post')->with('search_categorypost', $search_categorypost)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function delete_category_post($cate_id){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('cate_post_id', $cate_id)->delete();
        Toastr::success('Xóa thành công','Success');
        return Redirect::to('all-category-post');
    }
    

}
