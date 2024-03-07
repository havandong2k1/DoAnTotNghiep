@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ BÌNH LUẬN
    </div>
    <div id="notify_comment"></div>
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
            <th>STT</th>
            <th>Tên người gửi</th>
            <th style="width:260px">Bình luận</th>
            <th>Ngày gửi</th>
            <th>Sản phẩm</th>
            <th style="width:70px;">Chức năng</th>
          </tr>
        </thead>
        <tbody>
          @foreach($comment as $i => $cmt)
          <tr>
            <td>{{$i + 1}}</td>
            <td>{{( $cmt->comment_name)}}</td>
            <td>
              {{ $cmt->comment }}
              <style type="text/css">
                ul.list_rep li {
                  list-style-type: decimal;
                  color: blue;
                  margin: 5px 40px;
                }
              </style>
              <ul class="list_rep">
                Trả lời: 
              @foreach($comment_rep as $key => $comm_reply)
              @if($comm_reply->comment_parent == $cmt->comment_id)
                <li>
                  {{$comm_reply->comment}}
                </li>
              @endif
              @endforeach
              </ul>
              @if($cmt->comment_status == 0)
              <textarea class="form-control reply_comment_{{$cmt->comment_id}}" rows="5"></textarea>
              <button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{$cmt->comment_product_id}}"  data-comment_id="{{$cmt->comment_id}}">Trả lời</button>
              @endif
            </td>
            <td>{{  $cmt->comment_date }}</td>
            <td><a href="{{URL::to('/chi-tiet-san-pham/'.$cmt->product->product_slug)}}"  target="_blank">{{( $cmt->product->product_name)}}</a></td>
            <td style="text-align:center;">
              <a onclick="return confirm('Bạn có muốn xóa bình luận này không ?')" href="{{URL::to('/delete-comment/'.$cmt->comment_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
      
    </div>
   
  </div>
</div>

@endsection