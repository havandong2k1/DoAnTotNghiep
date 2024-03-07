@extends('layout_left')
@section('content')


<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Thanh toán giỏ hàng</li>
			</ol>
		</div>
		<div class="register-req">
			<p>Vui lòng đăng ký tài khoản và thanh toán để dễ dàng truy cập vào lịch sử đặt hàng của bạn và theo dõi đơn hàng</p>
		</div><!--/register-req-->
		<div class="shopper-informations">
			<div class="row">
				<div class="col-sm-12 clearfix">
					<div class="bill-to">
						<p>Điền thông tin gửi hàng</p>
						<div class="form-one">
							<form method="post">
								{{ csrf_field() }}
								<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
								<input type="text" name="shipping_email" class="shipping_email" placeholder="Email">
								<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
								<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
								<textarea name="shipping_notes" class="shipping_notes"  placeholder="Ghi chú đơn hàng" rows="5"></textarea>
								
                                @if(Session::get('fee'))
								<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
								@else 
								<input type="hidden" name="order_fee" class="order_fee" value="25000">
								@endif

								@if(Session::get('coupon'))
								@foreach(Session::get('coupon') as $key => $cou)
								<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
								@endforeach
								@else 
								<input type="hidden" name="order_coupon" class="order_coupon" value="Không có mã giảm giá">
								@endif
                                
								<div class="">
									<div class="form-group">
                                        <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                        <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            <option value="0">Thanh toán online</option>   
                                            <option value="1">Thanh toán tiền mặt</option>   
                                            
                                        </select>
								    </div>
								</div>
								<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
                                
                            </form> 
						</div>
							

						
					</div>
				</div>
				<div class="col-sm-12 clearfix">
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
										<td class="description">Tên sản phẩm</td>
										<td class="price">Giá sản phẩm</td>
										<td class="quantity">Số lượng</td>
										<td class="total">Thành tiền</td>
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
												<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
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
										<td colspan="2">
											@if(Session::get('coupon'))
											<a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa mã khuyến mãi</a>
											@endif
										</td>
										
										<td colspan="4">
											<p>Tổng tiền: <span>{{number_format($total,0,',','.')}} vnđ</span></p>
											@if(Session::get('coupon'))
												@foreach(Session::get('coupon') as $key => $cou)
												@if($cou['coupon_condition']==1)
												Mã giảm: {{$cou['coupon_number']}} %
												<p>
													@php 
													$total_coupon = ($total*$cou['coupon_number'])/100;	
													@endphp
												</p>
												<p>
													@php
													$total_after_coupon = $total - $total_coupon;
													@endphp	
												</p>
												@elseif($cou['coupon_condition']==2)
													Mã giảm: {{number_format($cou['coupon_number'],0,',','.')}} vnđ
												<p>
													@php 
													$total_coupon = $total - $cou['coupon_number'];
												
													@endphp
												</p>
												<p>
													@php
													$total_after_coupon = $total_coupon;
													@endphp	
												</p>
												@endif
												@endforeach
											@endif 
											@if(Session::get('fee'))
												Phí vận chuyển: {{number_format(Session::get('fee'),0,',','.')}} vnđ
												<?php
												$total_after_fee = $total + Session::get('fee');
												?>
											@endif 

											<p style="color: red; font-weight:bold;margin-top: 10px; font-size: 24px;">Tổng:

											@php
												if(Session::get('fee') && !Session::get('coupon')){
													$total_after = $total_after_fee;
													echo number_format($total_after,0,',','.').' vnđ';
												}elseif(!Session::get('fee') && Session::get('coupon')){
													$total_after = $total_after_coupon;
													echo number_format($total_after,0,',','.').' vnđ';

												}elseif(Session::get('fee') && Session::get('coupon')){
													$total_after = $total_after_coupon;
													$total_after = $total_after + Session::get('fee');
													echo number_format($total_after,0,',','.').' vnđ';

												}elseif(!Session::get('fee') && !Session::get('coupon')){
													$total_after = $total;
													echo number_format($total_after,0,',','.').' vnđ';
												}
											@endphp
			 								</p>
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
				@if(Session::get('cart'))
				<tr>
					<td>
						<form method="POST" action="{{URL::to('/check-coupon')}}">
							@csrf
							<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
							<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
						</form>
					</td>
					<td>
						<form action="{{URL::to('/onepay_payment')}}" method="post">
							@csrf
							<input type="hidden" name="total_onepay" value="{{$total_after}}">
							<button type="submit" class="btn btn-default check_out">Thanh toán onepay</button>
						</form>
						<form action="{{URL::to('/vnpay_payment')}}" method="post">
							@csrf
							<input type="hidden" name="total_vnpay" value="{{$total_after}}">
							<button type="submit" name="redirect" class="btn btn-default check_out">Thanh toán vnpay</button>
						</form>
					</td>
				</tr>
				@endif
			</table>
		</div>

		</div>
	</div>
</div>

</section> 

@endsection