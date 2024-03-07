@extends('layout')
@section('content')

@foreach($product_details as $key => $value)

<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<ul id="imageGallery" class="gallery list-unstyled">
			@if($value->galleries)
				@foreach($value->galleries as $item)
				    <li data-thumb="{{asset('public/upload/gallery/'.$item->gallery_image)}}" data-src="{{asset('public/upload/gallery/'.$item->gallery_image)}}">
				       <img width="100%" height="100%" src="{{asset('public/upload/gallery/'.$item->gallery_image)}}" />
				    </li>
			    @endforeach
		    @else
				<li data-thumb="{{asset('public/frontend/images/placeholder.jpeg')}}" data-src="{{asset('public/frontend/images/placeholder.jpeg')}}">
		       <img width="100%" height="100%" src="{{asset('public/frontend/images/placeholder.jpeg')}}" />
		    </li>
		    @endif
		</ul>

	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{$value->product_name}}</h2>
			<p>Mã sản phẩm: {{$value->product_id}}</p>
			<img src="images/product-details/rating.png" alt="" />

			<form action="{{URL::to('/save-cart')}}" method="POST">
				{{csrf_field()}}
				<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
				<input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
				<input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
				<input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
				<input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
				<input name="qty" type="hidden" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
				<span>
					<span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>
					<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
				</span>
				<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
			</form>
			<div style="margin-top: 10px">
				<p><b>Tình trạng:</b> Còn hàng</p>
				<p><b>Điều kiện:</b> New</p>
				<p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
				<p><b>Danh mục:</b> {{$value->category_name}}</p>

				<style type="text/css">
					a.tags_style{
						margin: 3px 2px;
						border: 1px solid;
						height: auto;
						background: #428bca;
						color: #ffff;
						padding: 0px;
					}
					a.tags_style:hover{
						background: #000;
					}
				</style>
				<fieldset>
					<legend>Tags</legend>
					<p><i class="fa fa-tag"></i>
						@php
							$tags = $value->product_tags;
							$tags = explode(",", $tags);
						@endphp
						@foreach($tags as $tag)
							<a href="{{URL::to('/tag/'. Str::slug($tag))}}" class="tags_style">{{$tag}}</a>
						@endforeach
					</p>
				</fieldset>
			</div>

		</div>
	</div>
</div>

<div class="category-tab shop-details-tab">
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li><a href="#content" data-toggle="tab">Mô tả sản phẩm</a></li>
			<li><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
			<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade in" id="content" >
			<p>{!!$value->product_content!!}</p>
		</div>
		
		<div class="tab-pane fade" id="details" >
			<p>{!!$value->product_desc!!}</p>
		</div>
		
		<div class="tab-pane fade active in" id="reviews" >
			<div class="col-sm-12">

				<style type="text/css">
					.style_comment{
						border: 1px solid #ddd;
						border-radius: 10px;
						background: #F0F0E9;
						padding: 10px;
						margin: 10px 0;
					}
					
				</style>
				<form>
				{{csrf_field()}}
				<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
				<div id="comment_show"></div>
				
				</form>
				<p><b>Viết đánh giá</b></p>
				
				<form action="#">
					<span>
						<input style="width: 100%;" type="text" class="comment_name" placeholder="Nhập tên"/>
					</span>
					<textarea name="comment" class="comment_content" placeholder="Nội dung bình luận"></textarea>
					
					<button type="button" class="btn btn-default pull-right send-comment">
						Thêm bình luận
					</button>
					<div id="notify_comment"></div>
				</form>
			</div>
		</div>
		
	</div>
</div><!--/category-tab-->

@endforeach

<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Sản phẩm liên quan</h2>
	
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
	
		<div class="carousel-inner">
			@foreach($relate as $key => $lienquan)
			<div class="item active">	
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_slug)}}">
						<div class="single-products">
							<form action="{{URL::to('/save-cart')}}" method="post">
								<div class="productinfo text-center">
									<img src="{{URL::to('public/upload/product/'.$lienquan->product_image)}}" alt="" />
									<h2>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
									<p>{{$lienquan->product_name}}</p>	
								</div>
							</form>

						</div>
						</a>
					</div>
				</div>
				
			</div>
			@endforeach		
		</div>
		
		

	</div>
	
</div><!--/recommended_items-->


@endsection