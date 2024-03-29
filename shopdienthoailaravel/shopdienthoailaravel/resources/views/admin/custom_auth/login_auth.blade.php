<!DOCTYPE html>
<head>
<title>ĐĂNG NHẬP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>ĐĂNG NHẬP</h2>
	<?php
	$message = Session::get('message');
	if ($message) {
		echo '<span class="text-alert">'.$message.'</span>';
		Session::put('message', null);
	}
	?>
	<form action="{{URL::to('/login')}}" method="post">
		{{ csrf_field() }} <!-- tăng khả năng bảo mật tạo thêm 1 token ngẫu nhiên trong input -->
		@foreach($errors->all() as $val)
		<span style="color: red; font-weight: bold;">{{$val}}</span>
		@endforeach
		<input type="text" class="ggg" name="admin_email" placeholder="E-MAIL" required>
		<input type="password" class="ggg" name="admin_password" placeholder="Điền mật khẩu" required>
		<div class="clearfix"></div>
		<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}" style="margin-top:50px"></div>
		<input type="submit" value="Đăng nhập" name="=Login">
	</form>
		
</div>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>

<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- Thông báo Toastr -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<!-- Thông báo Toastr -->
</body>
</html>
