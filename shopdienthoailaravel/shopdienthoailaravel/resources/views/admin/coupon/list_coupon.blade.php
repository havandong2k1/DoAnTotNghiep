@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
    </div>

    <div class="table-responsive">
      <?php
      $message = Session::get('message');
      if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message',null);
      }
      ?>
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>Thứ tự</th>        
            <th>Tên mã giảm giá</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Mã giảm giá</th>
            <th>Số lượng giảm giá</th>
            <th>Điều kiện giảm giá</th>
            <th>Số giảm</th>
            <th>Tình trạng</th>
            <th>Hết hạn</th>
            <th>Chức năng</th>

          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $i => $cou)
          <tr>
            <td>{{$i+1}}</td>
            <td>{{ $cou->coupon_name }}</td>
            <td>{{ $cou->coupon_date_start }}</td>
            <td>{{ $cou->coupon_date_end }}</td>
            <td>{{ $cou->coupon_code }}</td>
            <td>{{ $cou->coupon_time }}</td>
            <td>
              <span class="text-ellipsis">
                <?php
                if($cou->coupon_condition==1){
                  ?>
                  Giảm theo %
                  <?php
                }else{
                  ?>  
                  Giảm theo tiền
                  <?php
                }
                ?>
              </span>
            </td>
            <td><span class="text-ellipsis">
              <?php
              if($cou->coupon_condition==1){
                ?>
                Giảm {{$cou->coupon_number}} %
                <?php
              }else{
                ?>  
                Giảm {{$cou->coupon_number}} vnđ
                <?php
              }
              ?>
            </span></td>
             <td>
              <span class="text-ellipsis">
                <?php
                if($cou->coupon_date_end >= $today){
                  ?>
                  <span style="color: green;">Đang kích hoạt</span>
                  <?php
                }else{
                  ?>  
                  <span style="color: red;">Đã khóa</span>
                  <?php
                }
                ?>
              </span>
            </td>
            <td>
             
                @if($cou->coupon_date_end >= $today)
                  <span style="color: green;">Còn hạn</span>
                @else
                  <span style="color: red;">Hết hạn</span>
                @endif
             
            </td>
            <td>

              <a onclick="return confirm('Bạn có chắc là muốn xóa mã này ko?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
     
      <!-----export data---->
      <form action="{{URL::to('export-list-coupon')}}" method="POST">
      {{csrf_field()}}
      <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
      </form>

    </div>
    <p><a href="{{URL::to('/send-coupon')}}" class="btn btn-success" style="margin: 10px;">Gửi email cho khách hàng</a></p>
  </div>
</div>
@endsection