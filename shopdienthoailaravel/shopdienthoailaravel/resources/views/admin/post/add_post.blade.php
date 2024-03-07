@extends('admin_layout')
@section('admin_content')

<div class="row">
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            THÊM BÀI VIẾT
        </header>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert alert">'.$message.'</span>';
                Session::put('message', null);
            }
        ?>
        <div class="panel-body">
            <div class="position-center">
                <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputBrandName">Tên bài viết</label>
                    <input type="text" name="post_title" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Slug">
                </div>
                <div class="form-group">
                    <label for="exampleInputBrandDesc">Tóm tắt bài viết</label>
                    <textarea style="resize: none;" rows="5" name="post_desc" class="form-control" placeholder="Mô tả danh mục" id="ckeditor" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputBrandDesc">Nội dung bài viết</label>
                    <textarea style="resize: none;" rows="5" name="post_content" class="form-control" placeholder="Mô tả danh mục" id="ckeditor1" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputBrandDesc">Từ khóa</label>
                    <textarea style="resize: none;" rows="5" name="post_meta_keywords" class="form-control" placeholder="Mô tả danh mục" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputBrandDesc">Meta nội dung</label>
                    <textarea style="resize: none;" rows="5" name="post_meta_desc" class="form-control" placeholder="Mô tả danh mục" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                    <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="exampleInputShow">Danh mục bài viết</label>
                    <select name="cate_post_id" class="form-control input-sm m-bot15">
                        @foreach($cate_post as $key =>$cate)
                        <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputShow">Hiển thị</label>
                    <select name="post_status" class="form-control input-sm m-bot15">
                        <option value="0">Hiển thị</option>
                        <option value="1">Ẩn</option>
                    </select>
                </div>

                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
            </form>
            </div>

        </div>
    </section>

</div>
@endsection