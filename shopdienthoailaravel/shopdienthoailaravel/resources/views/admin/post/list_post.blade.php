@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ BÀI VIẾT
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
            <th>STT</th>
            <th>Tên bài viết</th>
            <th>Hình ảnh</th>
            <th>Slug</th>
            <th>Mô tả bài viết</th>
            <th>Từ khóa</th>
            <th>Danh mục</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
          </tr>
        </thead>
        <tbody>
          @php
          $i=0;
          @endphp
          @foreach($all_post as $key => $post)
          @php
          $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{( $post -> post_title)}}</td>
            <td><img src ="{{asset('public/upload/post/'.$post->post_image)}}" height="100" width="100"></td>

            <td>{{  $post -> post_slug }}</td>
            <td>{!! $post -> post_desc !!}</td>
            <td>{{( $post -> post_meta_keywords)}}</td>
            <td>
              @if($post->cate_post)
                {{( $post->cate_post->cate_post_name)}}
              @endif
            </td>
            <td>
                @if($post->post_status == 0)
                Hiển thị
                @else
                Ẩn
                @endif
            </td>
            <td>
              <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
           {!! $all_post->links() !!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection