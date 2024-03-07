@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ KHÁCH HÀNG
    </div>

    <div class="table-responsive">

    <table class="table table-striped b-t b-light" id="myTable">
      <thead>
        <tr>
          <th>Thứ tự</th>
          <th>Tên khách hàng</th>
          <th>Email</th>
          <th>Điện thoại</th>
          <th style="width:130px;">Chức năng</th>

        </tr>
      </thead>
      <tbody>
        @foreach($all_customer as $i => $cus)
        <tr>
          <td>{{$i+1}}</td>
          <td>{{( $cus->customer_name)}}</td>
          <td>{{ $cus->customer_email }}</td>
          <td>{{ $cus->customer_phone }}</td>
          <td>
            <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{URL::to('/delete-customer/'.$cus->customer_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    
  </div>

</div>
</div>

@endsection