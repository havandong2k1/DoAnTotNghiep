@extends('admin_layout')
@section('admin_content')

<div class="row">
<div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                CẬP NHẬT SẢN PHẨM
            </header>

            <div class="panel-body">
                <div class="position-center">
                    @foreach($edit_product as $key => $pro)
                    <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputProductName">Tên sản phẩm</label>
                        <input type="text" name="product_name" class="form-control" id="slug" onkeyup="ChangeToSlug();" value="{{$pro->product_name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProductName">Số lượng sản phẩm</label>
                        <input type="number" name="product_quantity" class="form-control" id="exampleInputEmail1" value="{{$pro->product_quantity}}">
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="product_slug" class="form-control" id="convert_slug" value="{{$pro->product_slug}}">
                    </div>
                     <div class="form-group">
                        <label for="exampleInputProductName">Giá sản phẩm</label>
                        <input type="number" value="{{$pro->product_price}}" name="product_price" class="form-control" id="exampleInputProductName">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProductName">Hình ảnh sản phẩm</label>
                        <input type="file" name="product_image" class="form-control" id="exampleInputProductName">
                        <img src ="{{URL::to('public/upload/product/'.$pro -> product_image)}}" height="100" width="100">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProductDesc">Mô tả sản phẩm</label>
                        <textarea style="resize: none;" rows="5" name="product_desc" class="form-control" id="ckeditor">{{$pro->product_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProductDesc">Nội dung sản phẩm</label>
                        <textarea style="resize: none;" rows="5" name="product_content" class="form-control" id="ckeditor1">{{$pro->product_content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tags sản phẩm</label>
                        <input type="text" class="form-control" name="product_tags" data-role="tagsinput" value="{{$pro->product_tags}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputShow">Danh mục sản phẩm</label>
                        <select name="product_cate" class="form-control input-sm m-bot15">
                            @foreach($cate_product as $key => $cate)
                                @if($cate->category_id ==$pro->category_id)
                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @else
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputShow">Thương hiệu</label>
                        <select name="product_brand" class="form-control input-sm m-bot15">
                            @foreach($brand_product as $key => $brand)
                                @if($brand->brand_id ==$pro->brand_id)
                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                 @else
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                 @endif

                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputShow">Hiển thị</label>
                        <select name="product_status" class="form-control input-sm m-bot15">
                            <option value="0">Hiển thị</option>
                            <option value="1">Ẩn</option>
                        </select>
                    </div>

                    <button type="submit" name="edit_product" class="btn btn-info">Cập nhật</button>
                </form>
                @endforeach
                </div>

            </div>
        </section>

</div>
@endsection