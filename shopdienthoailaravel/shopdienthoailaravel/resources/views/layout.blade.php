<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!---------Seo--------->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="" />
    
    {{--   <meta property="og:image" content="{{$image_og}}" />  
    <meta property="og:site_name" content="http://localhost/shopdienthoailaravel" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" /> --}}
    <!--//-------Seo--------->

    <title>{{$meta_title}}</title>
   
    <!-- CSS -->
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <!-- CSS -->


    <!-- JS -->      
    <link rel="shortcut icon" href="{{asset('public/frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <!-- JS -->      
    
</head><!--/head-->
    
<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="tel:0923199330"><i class="fa fa-phone"></i> 0923199330</a></li>
                                <li><a href="mailto:vinhhoc72@gmail.com"><i class="fa fa-envelope"></i> vinhhoc72@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="https://www.facebook.com/vinhhocc10/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/hoc-nguyen-b24090275/"><i class="fa fa-linkedin"></i></a></li>       
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/trang-chu')}}"><img src="{{asset('public/frontend/images/logo3.jpg')}}" alt="" /></a>
                        </div>
                     
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id!=NULL && $shipping_id==NULL){                                    
                                ?>

                                <li><a href="{{URL::to('/show-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

                                <?php
                                    }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                ?>

                                <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

                                <?php       
                                    }else{

                                ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php   
                                    }
                                ?>

                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng <span class="badges" id="show-cart">0</span></a></li>
                                
                                <!-- Lịch sử mua hàng -->
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>

                                <li><a id="checkout" href="{{URL::to('/history')}}"><i class="fa  fa-archive" aria-hidden="true"></i> Lịch sử mua hàng</a></li>

                                <?php
                                    }
                                ?>
                                
                                <!-- Lịch sử mua hàng -->

                                <!-- Đăng nhập và đăng xuất -->

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>

                                <li><a id="checkout" href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>

                                <?php
                                    }else{
                                ?>
                                <li><a id="checkout" href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>

                                <?php       
                                    }
                               
                                ?>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                    
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm mới<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $key => $danhmuc)
                                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$danhmuc->slug_category_product)}}">{{$danhmuc->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Bài viết<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category_post as $key => $danhmucbaiviet)
                                            <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng</a></li>
                                <li><a href="{{URL::to('/lien-he')}}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <form action="{{URL::to('/tim-kiem')}}" method="post">
                            {{csrf_field()}}
                            <div class="search_box pull-right">
                            <input type="text" name="keywords_submit" placeholder="Nhập tên sản phẩm"/>
                            <input type="submit" name="search_items" style="margin-top: 0; color: #666;" class="btn btn-primary btn-sm" value="Tìm kiếm">
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                            <li data-target="#slider-carousel" data-slide-to="3"></li>
                        </ol>
                        <style type="text/css">
                            img.img.img-responsive.img-slider {
                                height: 400px;
                                width: 100%;
                               
                            }
                        </style>
                         <div class="carousel-inner">
                            @php
                            $i = 0;
                            @endphp
                            @foreach($slider as $key => $slide)
                            @php
                            $i++;
                            @endphp
                            <div class="item {{$i == 1 ? 'active' : ''}}">
                                <div class="col-sm-12">
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/upload/slider/'.$slide->slider_image)}}"  class="img img-responsive img-slider">
                                    
                                </div>
                            </div>
                            @endforeach  
                        </div>
                        
                    
                    </div>
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products"><!--category-productsr-->
                            @foreach($category as $key => $cate)

                            <div class="panel panel-default">
                              
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category_product)}}">
                                            
                                             {{$cate->category_name}}
                                        </a>
                                    </h4>
                                </div>
                               
                            </div>
                           @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_slug)}}">{{$brand->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->

                        <div class="brands_products">
                            <h2>Sản phẩm yêu thích</h2>
                            <div class="brands-name">
                                <div id="row_wishlist" class="row">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content') 
                    
                    <!-- // extend mở rộng bên layout -->
                </div>
            </div>
        </div>

   
    </section>

<!-- Chat messenger -->
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<div class="elfsight-app-f13e37f0-d047-43b8-8303-a6f353e79079"></div>
<!-- Chat messenger -->



<footer id="footer"><!--Footer-->
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="companyinfo">
                    <h2><span>Thanh Tuyển </span> Mobile</h2>
                    <p>Thanh Tuyển Mobile cửa hàng điện thoại uy tín gần đây chuyên mua bán và sửa chữa điện thoại</p>
                </div>
            </div>
            <div class="col-sm-8">
                
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14934.620407517252!2d105.9212257!3d20.6429105!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135c927c1713407%3A0x1a1456c049e09d8c!2sThanh%20Tuy%E1%BB%83n%20Mobile!5e0!3m2!1svi!2s!4v1697423261019!5m2!1svi!2s" width="800" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>    
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <p class="pull-left">Trường đại học Công nghệ giao thông vận tải</p>
            <p class="pull-right">Designed by <span><a target="_blank" href="#">Nguyễn Vinh Học</a></span></p>
        </div>
    </div>
</div>   
</footer><!--/Footer-->




<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/frontend/js/main.js')}}"></script>
<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
<script src="{{asset('public/frontend/js/lightslider.min.js')}}"></script>
<script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=2339123679735877&autoLogAppEvents=1"></script>
<!-- Hủy đơn hàng -->

<script type="text/javascript">
    function Huydonhang(id) {
        var order_code = id;
        var lydo = $('#lydohuydon-' + order_code).val(); // Use a more specific selector
        var order_status = 3;
        var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
        $.ajax({
            url: '{{URL::to('/huy-don-hang')}}',
            method: 'POST',
            data: {
                order_code: order_code,
                lydo: lydo,
                _token: _token
            },
            success: function (data) {
                alert('Hủy đơn hàng thành công');
                location.reload();
            }
        });
    }
</script>
<!-- Hủy đơn hàng -->


<!-- Tìm kiếm sản phẩm theo tên, giá tiền -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#sort').on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });
    });
</script>
<!-- Tìm kiếm sản phẩm theo tên, giá tiền -->

<!-- // Thêm sản phẩm yêu thích -->
<script type="text/javascript">
    var old_data = []; // Khai báo old_data
    // Hiển thị sản phẩm yêu thích
    function view() {
        if(localStorage.getItem('data') != null){
            old_data = JSON.parse(localStorage.getItem('data'));
            old_data.reverse();
            document.getElementById('row_wishlist').style.overflow = 'scroll';
            document.getElementById('row_wishlist').style.height = '600px';

            for(i = 0; i < old_data.length; i++){
                var name = old_data[i].name;
                var image = old_data[i].image;
                var url = old_data[i].url;
                var id = old_data[i].id;
                $("#row_wishlist").append('<div class="row" style="margin:10px 0;"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><a href="'+url+'">Xem chi tiết</a><button style="margin:0 10px;" onclick="removeFromWishlist('+id+')">Xóa</button></div></div>');
            }
        }
    }

    view();
    // thêm sản phẩm yêu thích
    function add_wishlist(clicked_id) {
        var id = clicked_id;
        var name = document.getElementById('wishlist_productname'+id).value;   
        var image = document.getElementById('wishlist_productimage'+id).src;
        var url = document.getElementById('wishlist_producturl'+id).href;
        var newItem = {
            'id': id,
            'name': name,
            'image': image,
            'url': url
        }
    
        if(localStorage.getItem('data') == null) {
            localStorage.setItem('data', '[]');
        }
        old_data = JSON.parse(localStorage.getItem('data'));

        var matches = $.grep(old_data, function(obj){
            return obj.id == id;
        });

        if(matches.length) {
            swal("Thông báo", "Sản phẩm đã được thêm vào yêu thích");
            
        } else {
            old_data.push(newItem);
            localStorage.setItem('data', JSON.stringify(old_data));
            updateWishlistDisplay(); // Update view
        }

    }

    // Xóa sản phẩm yêu thích
    function removeFromWishlist(itemId) {
        var indexToRemove = -1;
        $.each(old_data, function(index, obj) {
            if (obj.id == itemId) {
                indexToRemove = index;
                return false;
            }
        });

        if (indexToRemove !== -1) {
            old_data.splice(indexToRemove, 1);
            localStorage.setItem('data', JSON.stringify(old_data));
            updateWishlistDisplay(); // Update view 
            
        }
    }

    // Update sản phẩm ở View
    function updateWishlistDisplay() {
        $("#row_wishlist").empty(); // Xóa mọi thứ
        for(i = 0; i < old_data.length; i++){
            var name = old_data[i].name;
            var image = old_data[i].image;
            var url = old_data[i].url;
            var id = old_data[i].id;
            $("#row_wishlist").append('<div class="row" style="margin:10px 0;"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><a href="'+url+'">Xem chi tiết</a><button style="margin:0 10px;" onclick="removeFromWishlist('+id+')">Xóa</button></div></div>');
        }
    }
</script>
<!-- Thêm sản phẩm yêu thích -->


<!-- Thanh tab danh mục sản phẩm -->
<script type="text/javascript">
    $(document).ready(function(){
        var cate_id = $('.tabs_pro').data('id');
        var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
        $.ajax({
            url: '{{URL::to('/product-tabs')}}',
            method: 'POST',
            data: {
                cate_id:cate_id,
                _token:_token
            },
            success:function(data){
                $('#tabs_product').html(data);
            }
        });

    });
    $('.tabs_pro').click(function() {
        var cate_id = $(this).data('id');
        var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
        $.ajax({
            url: '{{URL::to('/product-tabs')}}',
            method: 'POST',
            data: {
                cate_id:cate_id,
                _token:_token
            },
            success:function(data){
                $('#tabs_product').html(data);
            }
        });

    });
</script>
<!-- Thanh tab danh mục sản phẩm -->

<!-- Load comment -->
<script type="text/javascript">
    $(document).ready(function() {
      
        load_comment();
        function load_comment(){
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
            $.ajax({
            
            url: '{{URL::to('/load-comment')}}',
            method: 'POST',
            data: {
                product_id:product_id,
               
                _token:_token
            },
            success:function(data){
                
                $('#comment_show').html(data);
            }
            });
        }
        $('.send-comment').click(function(){
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';

            $.ajax({
            
            url: '{{URL::to('/send-comment')}}',
            method: 'POST',
            data: {
                product_id:product_id,
                comment_name:comment_name,
                comment_content:comment_content,
                _token:_token
            },
            success:function(data){
                
                
                load_comment();
                
                $('.comment_name').val('');
                $('.comment_content').val('');
            }
            });
        });
    });
</script>
<!-- Load comment -->

<!-- Xem nhanh sản phẩm -->
<script type="text/javascript">
    $('.xemnhanh').click(function(){
        var product_id = $(this).data('id_product');
        var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
        $.ajax({
            url: '{{URL::to('/quickview')}}',
            method: 'POST',
            dataType:'JSON',
            data:{
                product_id:product_id,
                _token:_token
            },
            success:function(data){
                $('#product_quickview_title').html(data.product_name);
                $('#product_quickview_id').html(data.product_id);
                $('#product_quickview_price').html(data.product_price);
                $('#product_quickview_image').html(data.product_image);
                $('#product_quickview_gallery').html(data.product_gallery);
                $('#product_quickview_desc').html(data.product_desc);
                $('#product_quickview_content').html(data.product_content);
                $('#product_quickview_value').html(data.product_quickview_value);
                $('#product_quickview_button').html(data.product_button);
            }
        });

    });  
</script>
<!-- Xem nhanh sản phẩm -->

<!-- Thêm giỏ hàng trong xem nhanh -->
<script type="text/javascript">
    show_cart_menu();
    //Hiển thị số lượng sản phẩm trong giỏ hàng
    function show_cart_menu(){
        $.ajax({
            url: '{{URL::to('/show-cart')}}',
            method: 'GET',
            success: function (response) {
                // Update the cart count in the #show-cart element
                $('#show-cart').html(response);
            }
        });
    }
    $(document).on('click', '.add-to-cart-quickview',  function(){

        var id = $(this).data('id_product');
        // alert(id);
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_quantity = $('.cart_product_quantity_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
        if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
            alert('Số lượng trong kho chỉ còn lại ' + cart_product_quantity +'. Quý khách vui lòng đặt lại số lượng sản phẩm');
        }else{

            $.ajax({
                url: '{{URL::to('/add-cart-ajax')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                beforeSend:function(){
                    $("#beforesend_quickview").html("Đang thêm sản phẩm vào giỏ hàng");
                },
                success:function(){
                    $("#beforesend_quickview").html("Sản phẩm đã được thêm vào giỏ hàng thành công");
                    

                }

            });
            show_cart_menu();
        }

        
    });
    $(document).on('click','.redirect-cart',function(){
        window.location.href="{{URL::to('/gio-hang')}}";
    });
  
</script>
<!-- Thêm giỏ hàng trong xem nhanh -->

<!-- Thanh toán ajax -->
<script type="text/javascript">
    $(document).ready(function(){
        show_cart_menu();
        //Hiển thị số lượng sản phẩm trong giỏ hàng
        function show_cart_menu(){
            $.ajax({
                url: '{{URL::to('/show-cart')}}',
                method: 'GET',
                success: function (response) {
                    // Update the cart count in the #show-cart element
                    $('#show-cart').html(response);
                }
            });
        }


        $('.add-to-cart').click(function(){

            var id = $(this).data('id_product');
            // alert(id);
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
            if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                alert('Số lượng trong kho chỉ còn lại ' + cart_product_quantity +'. Quý khách vui lòng đặt lại số lượng sản phẩm');
            }else{

                $.ajax({
                    url: '{{URL::to('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                    success:function(){

                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{URL::to('/gio-hang')}}";
                            });

                        show_cart_menu();

                    }

                });
            }

            
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
    $('.send_order').click(function(){
        swal({
            title: "Xác nhận đơn hàng",
            text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Cảm ơn, Mua hàng",

            cancelButtonText: "Đóng,chưa mua",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
        if (isConfirm) {
        var shipping_email = $('.shipping_email').val();
        var shipping_name = $('.shipping_name').val();
        var shipping_address = $('.shipping_address').val();
        var shipping_phone = $('.shipping_phone').val();
        var shipping_notes = $('.shipping_notes').val();
        var shipping_method = $('.payment_select').val();
        var order_fee = $('.order_fee').val();
        var order_coupon = $('.order_coupon').val();
        var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';

        $.ajax({
            url: '{{URL::to('/confirm-order')}}',
            method: 'POST',
            data:{
                shipping_email:shipping_email,
                shipping_name:shipping_name,
                shipping_address:shipping_address,
                shipping_phone:shipping_phone,
                shipping_notes:shipping_notes,
                _token:_token,
                order_fee:order_fee,
                order_coupon:order_coupon,
                shipping_method:shipping_method
            },
            success:function(){
                swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
            }
        });
        window.setTimeout(function(){ 
            location.reload();
        },3000);

        } else {
            swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

        }

    });

});
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
    });
</script>
<script type="text/javascript">
    $('#checkout').get(0).scrollIntoView({ behavior: 'smooth' });
</script>

</html>