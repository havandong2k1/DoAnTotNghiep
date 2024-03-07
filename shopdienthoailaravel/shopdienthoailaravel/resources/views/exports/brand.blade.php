<table>
	<thead>
		<tr>
			<th style="width:230px; background: #93ccea;">Tên thương hiệu</th>
			<th style="width:230px; background: #93ccea;">Slug</th>
			<th style="width:300px; background: #93ccea;">Mô tả</th>
			<th style="width:80px; background: #93ccea;">Trạng thái</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brand as $brand)
			<tr>
				<td>{{$brand->brand_name}}</td>
				<td>{{$brand->brand_slug}}</td>
				<td>{{$brand->brand_desc}}</td>
				<td>
					@if($brand->brand_status == 0)
	                	<span style="color: green;">Hoạt động</span>
	             	@else
	                 	<span style="color: red;">Không hoạt động</span>
	              	@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>