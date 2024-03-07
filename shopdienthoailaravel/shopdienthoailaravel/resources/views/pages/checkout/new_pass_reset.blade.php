@extends('layout_login')
@section('content')
<section style="margin: 20px 0;"><!--form-->
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
			@elseif(session()->has('error'))
			<div class="alert alert-danger">
				{{ session()->get('error') }}
			</div>
			@endif
			<div class="login-form"><!--login form-->
			@php
				$token = $_GET['token'];
				$email = $_GET['email'];
			@endphp

			<h2>Nhập mật khẩu mới</h2>
			<form action="{{URL::to('/reset-new-pass')}}" method="post">
				{{csrf_field()}}
				<input type="hidden" name="token" value="{{$token}}" />
				<input type="hidden" name="email" value="{{$email}}" />
				<input type="password" name="password_account" placeholder="Nhập mật khẩu"/>
				<button type="submit" class="btn btn-default">Gửi</button>
			</form>
			</div><!--/login form-->
		</div>
	</div>
</div>
</section><!--/form-->

@endsection