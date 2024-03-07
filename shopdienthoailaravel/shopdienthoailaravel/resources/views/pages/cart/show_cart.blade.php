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
			<div class="table-responsive cart_info">
				<?php
				$content = Cart::content();
				?>
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
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/upload/product/'.$v_content->options->image)}}" width="50" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
					
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'vnd'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">

									<form action="{{URL::to('/update-cart-quantity')}}" method="post">
										{{csrf_field()}}
										<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}">
										<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
										<input type="submit" value="cập nhật" name="update_qty" class="btn btn-fefault btn-sm">
									</form>
									

								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
								<?php
								$subtotal = $v_content->price * $v_content->qty;
								echo number_format($subtotal).' '.'vnđ';
								?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'. $v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
							
						</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>


@endsection