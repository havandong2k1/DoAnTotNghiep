@extends('layout')
@section('content')

<div class="features_items">
    <h2 class="title text-center">{{$meta_title}}</h2>
    @foreach($post_by_id as $key => $post)
    <div class="post-image-wrapper">

        <div class="single-posts">
            {!! $post->post_content !!}
        </div>

    </div>
    <div class="clearfix"></div>           
    @endforeach  

    <h2 class="title text-center">BÀI VIẾT LIÊN QUAN</h2>    
    <style type="text/css">
        ul.post_relate li {
            list-style-type: disc;
            font-size: 16px;
            padding: 6px;
        }
    </style>
    <ul class="post_relate">
        @foreach($related as $key => $post_relate)
        <li><a href="{{URL::to('/bai-viet/'.$post_relate->post_slug)}}">{{$post_relate->post_title}}</a></li>
        @endforeach
    </ul>             
</div>


@endsection