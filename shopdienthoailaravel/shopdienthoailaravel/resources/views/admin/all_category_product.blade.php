@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ DANH MỤC SẢN PHẨM
    </div>
    <div class="table-responsive">

      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>Thứ tự</th>
            <th>Tên danh mục</th>
            <th>Slug</th>
            <th>Hiển thị</th>
            <th style="width:130px;">Chức năng</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_category_product as $i => $cate_pro)
          <tr>
            <td>{{$i + 1}}</td>
            <td>{{( $cate_pro -> category_name)}}</td>
            <td>{{ $cate_pro->slug_category_product }}</td>
            <td><span class="text-ellipsis">
              <?php
                if($cate_pro -> category_status==0){
              ?>
                <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
                }else{
              ?>
                 <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
                }
              ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
      <!-----import data---->
      <form action="{{URL::to('import-csv')}}" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="file" name="file" accept=".xlsx"><br>
      <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
      </form>
      <!-----export data---->
      <form action="{{URL::to('export-csv')}}" method="POST">
      {{csrf_field()}}
      <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
      </form>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$all_category_product->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection