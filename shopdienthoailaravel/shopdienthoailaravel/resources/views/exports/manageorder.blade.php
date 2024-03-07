<table>
	<thead>
		<tr>
			<th style="width:300px; background: #93ccea;">Mã đơn hàng</th>
			<th style="width:230px; background: #93ccea;">Thời gian đặt hàng</th>
			<th style="width:80px; background: #93ccea;">Tình trạng</th>
		</tr>
	</thead>
	<tbody>
		@foreach($order as $order)
			<tr>
				<td>{{$order->order_code}}</td>
				<td>{{$order->created_at}}</td>
				<td>
					@if($order->order_status == 1)
	                	<span style="color: green;">Đơn hàng mới</span>

	             	
	             	@elseif($order->order_status == 2)
	                 	<span style="color: red;">Đã xử lý</span>
	                @else
	                	<span style="color: red;">Đơn đã hủy</span>
	              	@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>