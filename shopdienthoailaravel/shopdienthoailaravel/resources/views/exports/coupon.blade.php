<table>
	<thead>
		<tr>
	
			<th style="width:250px; background: #93ccea;">Tên mã giảm giá</th>
			<th style="width:100px; background: #93ccea;">Mã giảm giá</th>
			<th style="width:80px; background: #93ccea;">Số lượng</th>
			<th style="width:150px; background: #93ccea;">Điều kiện giảm giá</th>
			<th style="width:100px; background: #93ccea;">Số giảm</th>

		</tr>
	</thead>
	<tbody>
		@foreach($coupon as $coupon)
			<tr>
				<td>{{$coupon->coupon_name}}</td>
				<td>{{$coupon->coupon_code}}</td>
				<td>{{$coupon->coupon_time}}</td>
				<td>
					@if($coupon->coupon_condition == 1)
	                	<span style="color: green;">Giảm giá theo %</span>
	             	@else
	                 	<span style="color: red;">Giảm giá theo tiền</span>
	              	@endif
				</td>
				<td>
					@if($coupon->coupon_condition == 1)
	                	<span style="color: green;">{{$coupon->coupon_number }} %</span>
	             	@else
	                 	<span style="color: red;">{{$coupon->coupon_number }} vnđ</span>
	              	@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>