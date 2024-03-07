@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      THÔNG TIN KHÁCH HÀNG
    </div>
    
    <div class="table-responsive">
     <?php
     $message = Session::get('message');
     if ($message) {
      echo '<span class="text-alert alert">'.$message.'</span>';
      Session::put('message', null);
    }
    ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>         
          <th>Tên khách hàng</th>
          <th>Số điện thoại</th>
          <th>Email</th>

        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$customer->customer_name}}</td>
          <td>{{$customer->customer_phone}}</td>
          <td>{{$customer->customer_email}}</td> 
        </tr>
      </tbody>
    </table>
  </div>

</div>
</div>

<br><br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      THÔNG TIN VẬN CHUYỂN 
    </div>
    
    <div class="table-responsive">
     <?php
     $message = Session::get('message');
     if ($message) {
      echo '<span class="text-alert">'.$message.'</span>';
      Session::put('message', null);
    }
    ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>

          <th style="width: 120px;">Tên người nhận</th>
          <th style="width: 160px;">Địa chỉ</th>
          <th style="width: 100px;">Số điện thoại</th>
          <th style="width: 100px;">Email</th>
          <th style="width: 160px;">Ghi chú</th>
          <th style="width: 160px;">Hình thức thanh toán</th>

        </tr>
      </thead>
      <tbody>

        <tr>
          <td>{{$shipping->shipping_name}}</td>
          <td>{{$shipping->shipping_address}}</td>
          <td>{{$shipping->shipping_phone}}</td> 
          <td>{{$shipping->shipping_email}}</td> 
          <td>{{$shipping->shipping_notes}}</td>        
          <td>@if($shipping->shipping_method == 0)
            Chuyển khoản
            @else
            Tiền mặt
            @endif
          </td>        
        </tr>

      </tbody>
    </table>
  </div>

</div>
</div>

<br><br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ CHI TIẾT ĐƠN HÀNG
    </div>
    
    <div class="table-responsive">
     <?php
     $message = Session::get('message');
     if ($message) {
      echo '<span class="text-alert">'.$message.'</span>';
      Session::put('message', null);
    }
    ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>
          <th style="width:80px">Thứ tự</th>
          <th>Tên sản phẩm</th>
          <th>Mã giảm giá</th>
          <th>Phí Ship</th>
          <th>Số lượng</th>
          <th>Giá sản phẩm</th>
          <th>Tổng tiền</th>
        </tr>
      </thead>
      <tbody>
        @php

        $total = 0;
        @endphp
        @foreach($order_details_p as $i => $details)
        @php

        $subtotal = $details->product_price*$details->product_sales_quantity;
        $total+=$subtotal;
        @endphp
        <tr>
          <td>{{$i+1}}</td>
          <td>{{$details->product_name}}</td>
         
          <td>
            @if($details->product_coupon != 'Không có mã giảm giá')
            {{$details->product_coupon}}
            @else
            Không có mã giảm giá
            @endif
          </td>
          <td>{{number_format($details->product_feeship ,0,',','.')}} vnđ</td>
          <td>
            <input type="hidden" name="product_sales_quantity" value="{{$details->product_sales_quantity}}">
            <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
            {{$details->product_sales_quantity}}

          </td>
          <td>{{number_format($details->product_price ,0,',','.')}} vnđ</td>
          <td>{{number_format( $subtotal,0,',','.')}} vnđ</td>

        </tr>
        @endforeach
        <tr>
          <td colspan="7" style="color:red; font-weight:900; font-size: 20px;">
            @php
              $total_coupon = 0;
            @endphp
              @if($coupon_condition == 1)
            @php
              $total_after_coupon = ($total*$coupon_number)/100;
              echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.'). ' vnđ </br>';
              $total_coupon = $total - $total_after_coupon + $details->product_feeship;
            @endphp
            @else
            @php
              echo 'Tổng giảm: '.number_format($coupon_number,0,',','.'). ' vnđ </br>';
              $total_coupon = $total - $coupon_number + $details->product_feeship;
            @endphp
            @endif

            Phí ship: {{number_format($details->product_feeship,0,',','.')}} vnđ <br>
            Tổng thanh toán: {{number_format($total_coupon,0,',','.')}} vnđ
      </td>
    </tr>
    <tr>
      <td colspan="6">
       @foreach($getorder as $key => $or)
                @if($or->order_status==1)
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @elseif($or->order_status==2)
                <form>
                  @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @else
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}"  value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @endif
                @endforeach
  </td>
</tr>
</tbody>
</table>
<button class="btn btn-default"><a target="_blank" href="{{URL::to('/print-order/'.$details->order_code)}}">In đơn hàng</a></button>

</div>

</div>
</div>
@endsection