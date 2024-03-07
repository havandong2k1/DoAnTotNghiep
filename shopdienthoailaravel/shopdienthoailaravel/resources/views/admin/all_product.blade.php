@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ SẢN PHẨM
    </div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>STT</th>
            <th style="width: 180px;">Tên sản phẩm</th>
            <th>SL</th>
            <th style="width: 180px;">Slug</th>
            <th>Gallery</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th style="width: 100px;">Danh mục</th>
            <th style="width: 100px;">Thương hiệu</th>
            <th>Status</th>
            <th style="width:70px;">Chức năng</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $i => $pro)
          <tr>
            <td>{{$i + 1}}</td>
            <td>{{( $pro -> product_name)}}</td>
            <td>{{  $pro -> product_quantity }}</td>
            <td>{{  $pro -> product_slug }}</td>
            <td><a href="{{URL::to('add-gallery/'.$pro->product_id)}}">Thêm</a></td>
            <td>{{( $pro -> product_price)}}</td>
            <td><img src ="public/upload/product/{{( $pro -> product_image)}}" height="100" width="100"></td>
            <td>{{( $pro -> category_name)}}</td>
            <td>{{( $pro -> brand_name)}}</td>
           
            <td><span class="text-ellipsis">
              @if($pro -> product_status==0)
                <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              @else
                 <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              @endif
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
      
    </div>
   
  </div>
</div>

@endsection