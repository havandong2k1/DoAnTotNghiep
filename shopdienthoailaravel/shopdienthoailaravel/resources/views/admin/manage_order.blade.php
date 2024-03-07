@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ ĐƠN HÀNG
    </div>

    <div class="table-responsive">

    <table class="table table-striped b-t b-light" id="myTable">
      <thead>
        <tr>
          <th>Thứ tự</th>
          <th>Mã đơn hàng</th>
          <th>Thời gian đặt hàng</th>
          <th>Tình trạng đơn hàng</th>
          <th style="width:220px;">Lý do hủy</th>
          <th>Chức năng</th>
        </tr>
      </thead>
      <tbody>
        @foreach($getorder as $i => $ord)
        <tr>
          <td>{{$i + 1}}</td>
          <td>{{( $ord -> order_code)}}</td>
          <td>{{( $ord -> created_at)}}</td>
          <td>@if($ord-> order_status == 1)
              <p style="color:green; font-weight: bold;">Đơn hàng mới</p>
              @elseif($ord-> order_status == 2)
              <p style="color:red; font-weight: bold;">Đã xử lý</p>
              @else
              <p style="color:red; font-weight: bold;">Đơn đã hủy</p>
              @endif
          </td>
          <td>
            {{( $ord -> order_destroy)}}
          </td>
          <td>
            <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <!-----export data---->
    <form action="{{URL::to('export-manage-order')}}" method="POST">
    {{csrf_field()}}
    <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
    </form>
  </div>
  
</div>
</div>


@endsection