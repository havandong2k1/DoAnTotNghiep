@extends('admin_layout')
@section('admin_content')

<style type="text/css">
		p.title_thongke{
			text-align: center;
			font-size: 22px;
			font-weight: bold;
			margin-bottom: 10px;
		}
</style>

<div class="row">
	<p class="title_thongke">THỐNG KÊ TỔNG DOANH THU</p>
	<form autocomplete="off">
		@csrf
		<div class="col-md-2">
			<p>Từ ngày: <input type="text" id="date_picker" class="form-control"></p>
			
		</div>
		<div class="col-md-2">
			<p>Đến ngày: <input type="text" id="date_picker2" class="form-control"></p>

		</div>
		<div class="col-md-2">
			<p>
				Lọc theo:
				<select class="dashboard-filter form-control"> 
					<option>---- Chọn ----</option>
					<option value="7ngay">7 ngày qua</option>
					<option value="thangtruoc">Tháng trước</option>
					<option value="thangnay">Tháng này</option>
					<option value="365ngayqua">365 ngày qua</option>
				</select>
			</p>
		</div>
		<div class="col-md-2">
			<br>
			<input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
		</div>
	</form>
	<div class="col-md-12">
		<div id="chart" style="height: 250px;"></div>
	</div>
</div>
<br>

<div class="row">
	<p class="title_thongke">THỐNG KÊ TỔNG SẢN PHẨM - BÀI VIẾT - ĐƠN HÀNG</p>
	<div class="col-md-12">
		
		<div id="donut" class="morris-donut-inverse"></div>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-12">
		<div class="col-md-6">
		<h3>Bài viết xem nhiều</h3>
		<ul class="list_views">
			@foreach($post_views as $key => $post)
			<li>
				<a target="_blank" href="{{URL::to('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}} | <span style="color:blue;">{{$post->post_views}}</span></a>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="col-md-6">
		<style type="text/css">
			ul.list_views{
				margin: 10px 0;
				color: #fff;
			}
			ul.list_views a{
				color: #000;
				font-weight: 400;
			}
		</style>
		<h3>Sản phẩm xem nhiều</h3>
		<ul class="list_views">
			@foreach($product_views as $key => $pro)
			<li>
				<a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_slug)}}" target="_blank">{{$pro->product_name}} | <span style="color:blue;">{{$pro->product_views}}</span></a>
			</li>
			@endforeach
		</ul>
	</div>
	</div>
</div>
@endsection