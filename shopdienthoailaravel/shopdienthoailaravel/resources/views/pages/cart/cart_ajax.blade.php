@extends('layout_left')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Giỏ hàng của bạn</li>
			</ol>
		</div>
		@if(session()->has('message'))
		<div class="alert alert-success">
			{{ session()->get('message') }}
		</div>
		@elseif(session()->has('error'))
		<div class="alert alert-danger">
			{{ session()->get('error') }}
		</div>
		@endif
		<div class="table-responsive cart_info">

			<form action="{{URL::to('/update-cart')}}" method="POST">
				{{csrf_field()}}
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td style="width: 230px;" class="description">Tên sản phẩm</td>
							<td style="width: 180px;" class="price">Giá sản phẩm</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart')==true)
							@php
							$total = 0;
							@endphp
							
							@foreach(Session::get('cart') as $key => $cart)
							@php
							$subtotal = $cart['product_price']*$cart['product_qty'];
							$total+=$subtotal;
							@endphp

						<tr>
							<td class="cart_product">
								<img src="{{asset('public/upload/product/'.$cart['product_image'])}}" width="90" />
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_name']}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}} vnđ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{number_format($subtotal,0,',','.')}} vnđ
								</p>
							</td>
							<td class="cart_delete" style="">
								<a class="cart_quantity_delete" href="{{URL::to('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>

						@endforeach
						<tr>
							<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
							<td><a class="btn btn-default check_out" href="{{URL::to('/del-all-product')}}">Xóa tất cả</a></td>
							<td>
								@if(Session::get('coupon'))
								<a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa mã khuyến mãi</a>
								@endif
							</td>
							<td>
								<?php
                                $customer_id = Session::get('customer_id');
                                if($customer_id!=NULL){                                    
	                            ?>

	                            <a class="btn btn-default check_out" href="{{URL::to('/show-checkout')}}">Thanh toán</a>

	                            <?php
	                                }else{
	                            ?>

	                            <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>

	                            <?php       
	                                }
	                            ?>
							</td>


							
						</tr>
						@else 
						<tr>
							<td colspan="5"><center>
								@php 
								echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
								@endphp
							</center></td>
						</tr>
						@endif
					</tbody>
				</form>
				
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->



@endsection