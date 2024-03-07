@extends('layout_login')
@section('content')
<section style="margin: 20px 0;"><!--form-->
<div class="container">
	<div class="row">	
		<div class="login-form"><!--login form-->
			
			<form action="{{URL::to('/login-customer')}}" method="post">
				{{csrf_field()}}
				<input type="text" name="email_account" placeholder="Name" />
				<input type="password" name="password_account" placeholder="Mật khẩu" />
				<span>
					<a href="{{URL::to('/quen-mat-khau')}}">Quên mật khẩu</a>
				</span>
				<button type="submit" class="btn btn-default">Đăng nhập</button>
			</form>
		</div><!--/login form-->
		<h2 class="or">Hoặc</h2>

		<div class="signup-form"><!--sign up form-->
			<h2>Đăng ký</h2>
			<form action="{{URL::to('/add-customer')}}" method="post">
				{{ csrf_field() }}
				<input type="text" name="customer_name" placeholder="Họ và tên"/>
				<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
				<input type="text" name="customer_phone" placeholder="Số điện thoại"/>
				<input type="password" name="customer_password" placeholder="Mật khẩu"/>
				<button type="submit" class="btn btn-default">Đăng ký</button>
			</form>
		</div><!--/sign up form-->
	</div>
</div>
</section><!--/form-->

@endsection
