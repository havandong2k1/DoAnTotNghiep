@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê Slide
    </div>
  
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên slide</th>
            <th>Ảnh</th>
            <th>Chú thích</th>
            <th style="width: 130px;">Trạng thái</th>
            <th style="width: 130px;">Chức năng</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_slide as $i => $slide)
          <tr>
            <td>{{$i + 1}}</td>
            <td>{{ $slide->slider_name }}</td>
            <td><img src="public/upload/slider/{{ $slide->slider_image }}" height="120" width="500"></td>
            <td>{{ $slide->slider_desc }}</td>
            <td><span class="text-ellipsis">
              <?php
              if($slide->slider_status==0){
                ?>
                <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
              }else{
                ?>  
                <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
              }
              ?>
            </span></td>
            <td>
             
              <a onclick="return confirm('Bạn có chắc là muốn xóa slide này không?')" href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$all_slide->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection