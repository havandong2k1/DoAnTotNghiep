@extends('admin_layout')
@section('admin_content')

<div class="row">
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            THÊM DANH MỤC SẢN PHẨM
        </header>
    
        <div class="panel-body">
            <div class="position-center">
                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                    {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputCategoryName">Tên danh mục</label>
                    <input type="text" name="category_product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục" required>
                </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" name="slug_category_product" class="form-control" id="convert_slug" placeholder="Tên danh mục">
                </div>
                <div class="form-group">
                    <label for="exampleInputCategoryDesc">Mô tả danh mục</label>
                    <textarea style="resize: none;" rows="5" name="category_product_desc" class="form-control" id="" placeholder="Mô tả danh mục" required></textarea>
                </div>
                 <div class="form-group">
                    <label for="exampleInputCategoryDesc">Từ khóa danh mục</label>
                    <textarea style="resize: none;" rows="5" name="category_product_keywords" class="form-control" id="" placeholder="Mô tả danh mục" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputShow">Hiển thị</label>
                    <select name="category_product_status" class="form-control input-sm m-bot15">
                        <option value="0">Hiển thị</option>
                        <option value="1">Ẩn</option>
                    </select>
                </div>

                <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
            </form>
            </div>

        </div>
    </section>

</div>
@endsection