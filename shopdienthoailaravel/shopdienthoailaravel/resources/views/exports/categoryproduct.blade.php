<table>
	<thead>
		<tr>
			<th style="width:300px; background: #93ccea;">Từ khóa</th>
			<th style="width:230px; background: #93ccea;">Tên danh mục</th>
			<th style="width:230px; background: #93ccea;">Slug</th>
			<th style="width:300px; background: #93ccea;">Mô tả</th>
			<th style="width:80px; background: #93ccea;">Trạng thái</th>
		</tr>
	</thead>
	<tbody>
		@foreach($category as $category_p)
			<tr>
				<td>{{$category_p->meta_keywords}}</td>
				<td>{{$category_p->category_name}}</td>
				<td>{{$category_p->slug_category_product}}</td>
				<td>{{$category_p->category_desc}}</td>
				<td>
					@if($category_p->category_status == 0)
	                	<span style="color: green;">Hoạt động</span>
	             	@else
	                 	<span style="color: red;">Không hoạt động</span>
	              	@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>