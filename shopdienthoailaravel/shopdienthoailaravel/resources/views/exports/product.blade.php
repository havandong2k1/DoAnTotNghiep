<table>
	<thead>
		<tr>
			
			<th style="width:250px; background: #93ccea;">Tên danh mục</th>
			<th style="width:80px; background: #93ccea;">Số lượng</th>
			<th style="width:230px; background: #93ccea;">Slug</th>
			<th style="width:200px; background: #93ccea;">Giá</th>
			<th style="width:80px; background: #93ccea;">Danh mục</th>
			<th style="width:80px; background: #93ccea;">Thương hiệu</th>
			<th style="width:80px; background: #93ccea;">Trạng thái</th>
		</tr>
	</thead>
	<tbody>
		@foreach($product as $product)
			<tr>
				<td>{{$product->product_name}}</td>
				<td>{{$product->product_quantity}}</td>
				<td>{{$product->product_slug}}</td>
				<td>{{$product->product_price}}</td>
				<td>{{$product->category_id}}</td>
				<td>{{$product->brand_id}}</td>
				<td>
					@if($pro -> product_status==0)
	                	<span style="color: green;">Hoạt động</span>
	             	@else
	                 	<span style="color: red;">Không hoạt động</span>
	              	@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>