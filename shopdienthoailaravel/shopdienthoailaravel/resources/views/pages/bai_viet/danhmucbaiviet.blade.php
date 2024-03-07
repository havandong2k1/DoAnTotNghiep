@extends('layout')
@section('content')

<div class="features_items">
    <h2 class="title text-center">Danh mục bài viết</h2>
    @foreach($post_cate as $key => $p)
    <div class="post-image-wrapper">
        
        <div class="single-posts" style="margin: 10px 0; padding: 2px;">
            <div class="postinfo text-center">
                <img style="float: left; width: 30%; padding: 5px;" src="{{URL::to('public/upload/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" />
                <h4 style="color:#000; padding: 5px">{{$p->post_title}}</h4>
                <p>{!!$p->post_desc!!}</p>
            </div>
        </div>
       
        <div class="choose text-center">
            <a href="{{URL::to('/bai-viet/'.$p->post_slug)}}" class="btn btn-default btn-sm">Xem bài viết</a>
        </div>
    </div>
    <div class="clearfix"></div>           
    @endforeach                   
</div>
<ul class="pagination pagination-sm m-t-none m-b-none">
    {!! $post_cate->links() !!}
</ul>


@endsection