@extends('admin_layout')
@section('admin_content')

<div class="row">
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            CẬP NHẬT DANH MỤC SẢN PHẨM
        </header>
        <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert alert">'.$message.'</span>';
                Session::put('message', null);
            }
        ?>
        <div class="panel-body">
            @foreach($edit_category_product as $key => $edit_value)
            <div class="position-center">
                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                    {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputCategoryName">Tên danh mục</label>
                    <input type="text" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" value="{{$edit_value->slug_category_product}}" name="slug_category_product" class="form-control" id="convert_slug" >
                </div>
                <div class="form-group">
                    <label for="exampleInputCategoryDesc">Mô tả danh mục</label>
                    <textarea style="resize: none;" rows="5"  name="category_product_desc" class="form-control" required>{{$edit_value->category_desc}}</textarea>
                </div>
                    <div class="form-group">
                    <label for="exampleInputCategoryDesc">Từ khóa danh mục</label>
                    <textarea style="resize: none;" rows="5" name="category_product_keywords" class="form-control" placeholder="Mô tả danh mục" required>{{$edit_value->meta_keywords}}</textarea>
                </div>
                

                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật</button>
            </form>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection