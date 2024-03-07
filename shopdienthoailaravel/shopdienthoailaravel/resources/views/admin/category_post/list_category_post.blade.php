@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ DANH MỤC BÀI VIẾT
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
          <th>Tên danh mục bài viết</th>
          <th>Post Slug</th>
          <th>Hiển thị</th>
          <th style="width:130px;">Chức năng</th>

        </tr>
      </thead>
      <tbody>
        @php
        $i=0;
        @endphp
        @foreach($category_post as $key => $cate_post)
        @php
        $i++;
        @endphp
        <tr>
          <td>{{$i}}</td>
          <td>{{( $cate_post->cate_post_name)}}</td>
          <td>{{ $cate_post->cate_post_slug }}</td>
          <td>
          	@if($cate_post->cate_post_status==0)
          	Hiển thị
          	@else
          	Ẩn
          	@endif
          </td>
          <td>
            <a href="{{URL::to('/edit-category-post/'.$cate_post->cate_post_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có muốn xóa không ?')" href="{{URL::to('/delete-category-post/'.$cate_post->cate_post_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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
          {!! $category_post->links()!!}
        </ul>
      </div>
    </div>
  </footer>
</div>
</div>

@endsection