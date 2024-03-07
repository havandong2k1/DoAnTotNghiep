<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Models\Slider;
use App\Models\Post;
use App\Models\CatePost;
use Session;
use Toastr;
use Illuminate\Support\Facades\Redirect;

session_start();

class PostController extends Controller
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
    public function add_post(){
        $this->AuthLogin();

        $cate_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        
        return view('admin.post.add_post')->with(compact('cate_post'));

    }
    public function all_post(){
        $this->AuthLogin();
        $all_post = Post::with('cate_post')->orderBy('post_id')->paginate(10);


        return view('admin.post.list_post')->with(compact('all_post'));
    }

    public function save_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $post = new Post();
        $post->post_title = $data['post_title'];
        $post->post_desc = $data['post_desc'];
        $post->post_slug = $data['post_slug'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->post_status = $data['post_status'];
        $post->cate_post_id = $data['cate_post_id'];
        $get_image = $request->file('post_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // lấy tên hình ảnh
            $name_image = current(explode('.', $get_name_image)); 
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image -> move('public/upload/post', $new_image);
            $post->post_image = $new_image;
            $post->save();
            Toastr::success('Thêm bài viết thành công','Success');
            return Redirect()->back();

        }
        else{
            
            Toastr::warning('Làm ơn thêm ảnh bài viết','Warning');
            return Redirect()->back();

        }


    }

    public function edit_post($post_id){
        $cate_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        $post = Post::find($post_id);
        return view('admin.post.edit_post')->with(compact('post','cate_post'));
    }

    public function delete_post($post_id){
        $this->AuthLogin();
        $post =Post::find($post_id);
        $post_image = $post->post_image;
        if($post_image){
            $path = 'public/upload/post/'.$post_image;
            unlink($path);
        }
        $post->delete();
         Toastr::success('Xóa thành công','Success');
        return Redirect()->back();
    }

    public function update_post(Request $request, $post_id){
        $this->AuthLogin();
        $data = $request->all();
        $post = Post::find($post_id);
        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];
        $get_image = $request->file('post_image');
        if ($get_image) {
            // xóa ảnh cũ
            $post_image_old = $post->post_image;
            $path = 'public/upload/post/'.$post_image_old;
            unlink($path);
            // cập nhật ảnh mới
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image -> move('public/upload/post', $new_image);
            $post->post_image = $new_image; 
            

        }
        $post->save();
         Toastr::success('Cập nhật bài viết thành công','Success');
        return Redirect()->back();

    }

    public function danh_muc_bai_viet(Request $request, $post_slug){
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();

        $cate_post = CatePost::where('cate_post_slug', $post_slug)->take(1)->get();

        foreach ($cate_post as $key => $cate) {
            //seo 
            $meta_desc = $cate->cate_post_desc; 
            $meta_keywords = $cate->cate_post_slug;
            $meta_title = $cate->cate_post_name;
            $cate_id = $cate->cate_post_id;
            $url_canonical = $request->url();
            //--seo
        }
        $post_cate = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id',$cate_id)->paginate(10);
        
        return view('pages.bai_viet.danhmucbaiviet')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('post_cate',$post_cate)->with('category_post',$category_post);
    }


    public function bai_viet(Request $request, $post_slug){
        $category_post = CatePost::orderBy('cate_post_id', 'desc')->get();
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'asc')->get();
        $post_by_id = Post::with('cate_post')->where('post_status', 0)->where('post_slug',$post_slug)->take(1)->get();
        foreach ($post_by_id as $key => $p) {
            //seo 
            $meta_desc = $p->post_meta_desc; 
            $meta_keywords = $p->post_meta_keywords;
            $meta_title = $p->post_title;
            $cate_id = $p->cate_post_id;
            $url_canonical = $request->url();
            $cate_post_id = $p->cate_post_id;
            $post_id = $p->post_id;
            //--seo
        }
        //update view bài viết
        $post = Post::where('post_id', $post_id)->first();
        $post->post_views = $post->post_views + 1;
        $post->save();

        // bài viết liên quan
        $related = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_post_id)->whereNotIn('post_slug', [$post_slug])->take(5)->get();
        
        return view('pages.bai_viet.baiviet')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('post_by_id',$post_by_id)->with('category_post',$category_post)->with('related', $related);
    }

    public function search_post(Request $request)
    {
        //seo 
        $meta_desc = "Tìm kiếm"; 
        $meta_keywords = "Tìm kiếm";
        $meta_title = "Tìm kiếm";
        $url_canonical = $request->url();
        //--seo
        $keywords = $request->keywords_submit;
        // $search_post = DB::table('tbl_posts')->where('post_title', 'like','%'.$keywords.'%')->with('cate_post')->get();
        $search_post = Post::with('cate_post')->where('post_title', 'like','%'.$keywords.'%')->get();
       
    
        return view('admin.post.search_post')->with('search_post', $search_post)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

}
