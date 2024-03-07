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
			<h2>Vui lòng điền email để lấy lại mật khẩu</h2>
			<form action="{{URL::to('/recover-pass')}}" method="post">
				{{csrf_field()}}
				<input type="text" name="email_account" placeholder="Nhập email..." />
				<button type="submit" class="btn btn-default">Gửi</button>
			</form>
			</div><!--/login form-->
		</div>
	</div>
</div>
</section><!--/form-->

@endsection