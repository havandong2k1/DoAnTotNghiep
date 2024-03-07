@extends('layout')
@section('content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LỊCH SỬ ĐẶT HÀNG
    </div>

    <div class="table-responsive">
     <?php
     $message = Session::get('message');
     if ($message) {
      echo '<span class="text-alert alert">'.$message.'</span>';
      Session::put('message', null);
    }
    ?>
    <table class="table table-striped b-t b-light" id="myTable">
      <thead>
        <tr>
          <th>Thứ tự</th>
          <th>Mã đơn hàng</th>
          <th>Thời gian đặt hàng</th>
          <th>Tình trạng đơn hàng</th>
          <th style="width:130px;">Chức năng</th>
        </tr>
      </thead>
      <tbody>
        @foreach($getorder as $i => $ord)
        <tr>
          <td>{{$i + 1}}</td>
          <td>{{( $ord->order_code)}}</td>
          <td>{{( $ord->created_at)}}</td>
          <td>@if($ord->order_status == 1)
            <p style="color:green; font-weight: bold;">Đơn hàng mới</p>
            @elseif($ord-> order_status == 2)
            <p style="color:red; font-weight: bold;">Đã xử lý</p>
            @else
            <p style="color:red; font-weight: bold;">Đơn đã hủy</p>
            @endif
          </td>
          <td>
            @if($ord->order_status != 3 &&  $ord->order_status != 2)
            <p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon-{{$ord->order_code}}">Hủy đơn hàng</button></p>
            @endif
            <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">Xem đơn hàng</a>
            
          </td>
        </tr>
        <!-- Modal -->
        <div id="huydon-{{$ord->order_code}}" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <form>
              <!-- Modal content-->
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Lý do hủy đơn hàng</h4>
                </div>
                <div class="modal-body">
                  <p><textarea id="lydohuydon-{{$ord->order_code}}" rows="5" placeholder="Lý do hủy đơn..."></textarea></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                  <button type="button" onclick="Huydonhang('{{$ord->order_code}}')" class="btn btn-success">Gửi</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        @endforeach
      </tbody>
    </table>
    
  </div>
  
</div>
</div>
@endsection