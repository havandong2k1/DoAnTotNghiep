@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ THƯƠNG HIỆU 
    </div>

    <div class="table-responsive">

    <table class="table table-striped b-t b-light" id="myTable">
      <thead>
        <tr>
          <th>Thứ tự</th>
          <th>Tên thương hiệu</th>
          <th>Brand Slug</th>
          <th>Hiển thị</th>
          <th style="width:130px;">Chức năng</th>

        </tr>
      </thead>
      <tbody>
        @foreach($all_brand_product as $i => $brand_pro)
        <tr>
          <td>{{$i+1}}</td>
          <td>{{( $brand_pro -> brand_name)}}</td>
          <td>{{ $brand_pro->brand_slug }}</td>
          <td><span class="text-ellipsis">
            <?php
            if($brand_pro->brand_status==0){
              ?>
              <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
            }else{
              ?>
              <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
            }
            ?>
          </span></td>
          <td>
            <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <!-----import data---->
      <form action="{{URL::to('import-brand')}}" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="file" name="file" accept=".xlsx"><br>
      <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
      </form>
      <!-----export data---->
      <form action="{{URL::to('export-brand')}}" method="POST">
      {{csrf_field()}}
      <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
      </form>
  </div>

</div>
</div>

@endsection