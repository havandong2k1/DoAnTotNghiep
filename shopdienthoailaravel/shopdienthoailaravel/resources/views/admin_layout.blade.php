<!DOCTYPE html>
<head>
    <title>Trang Quản Trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
    <!-- //bootstrap-css -->

    <!-- Custom CSS -->

    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}" rel="stylesheet"/>
    <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- font-awesome icons -->

    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">

    <!-- //calendar -->

    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>

</head>
<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{URL::to('/dashboard')}}" class="logo">
                    Dashboard
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                  
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/backend/images/2.png')}}">
                            <span class="username">
                                <?php
                                $name = Auth::user()->admin_name;
                                if ($name) {
                                    echo $name;
                                    
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                           
                            <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                    
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="{{URL::to('/manage-slider')}}">
                                <i class="fa fa-picture-o"></i>
                                <span>Quản lý slider</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                                <li><a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Quản lý đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-order')}}">Liệt kê đơn hàng</a></li>   
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-ticket"></i>
                                <span>Quản lý mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                                <li><a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a></li>
                            </ul>
                        </li>
                   
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-files-o"></i>
                                <span>Quản lý danh mục bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
                                <li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>
                            </ul>
                        </li>
                     
                        
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Quản lý bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
                                <li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
                            </ul>
                        </li>
                        
                        
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-comments"></i>
                                <span>Quản lý bình luận</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/comment')}}">Liệt kê bình luận</a></li>
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span>Quản lý tài khoản</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-users')}}">Thêm tài khoản</a></li>
                                <li><a href="{{URL::to('/users')}}">Liệt kê tài khoản</a></li>
                              
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span>Quản lý khách hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/all-customer')}}">Liệt kê khách hàng</a></li>
                              
                            </ul>
                        </li>
                       
                    </ul>   
                </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
    </section>
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="{{asset('public/backend/js/monthly.js')}}"></script> 
<script src="{{asset('public/backend/js/bootstrap-tagsinput.min.js')}}"></script> 
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>


<!-- Thông báo Toastr -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<!-- Thông báo Toastr -->
<script type="text/javascript">
    $(document).ready(function(){

        
        if ($('#donut').length > 0) {
            chart90daysorder();
            var chart = new Morris.Area({
            element: 'chart',
            lineColors: ['#819C79','#fc8710', '#ff6541', '#A4ADD3', '#766856'],
            pointFillColors: ['#fffff'],
            pointStrokeColors: ['black'],
            fillOpacity: 0.3,
            hideHover: 'auto',
            parseTime: false,
            xkey: 'period',
            ykeys: ['order', 'sales', 'profit', 'quantity'],
            behaveLikeLine: true,
            labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']
        });
        }
        

        function chart90daysorder() {
            var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
            $.ajax({
                url: '{{URL::to('/days-order')}}',
                method: 'POST',
                dataType: 'JSON',
                data:{
                    _token:_token
                },
                success:function(data) {
                    chart.setData(data);
                }
            });
        }
        $('.dashboard-filter').change(function(){
            var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
            var dashboard_value = $(this).val();
            $.ajax({
                url: '{{URL::to('/dashboard-filter')}}',
                method: 'POST',
                dataType: 'JSON',
                data:{
                    dashboard_value:dashboard_value,
                    _token:_token
                },
                success:function(data) {
                    chart.setData(data);
                }
            });
        });

        $('#btn-dashboard-filter').click(function(){
            var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
            var from_date = $('#date_picker').val();
            var to_date = $('#date_picker2').val();
            $.ajax({
                url: '{{URL::to('/filter-by-date')}}',
                method: 'POST',
                dataType: 'JSON',
                data:{
                    from_date:from_date,
                    to_date:to_date,
                    _token:_token
                },
                success:function(data) {
                    chart.setData(data);
                }
            });
        });

    });
</script>

<!-- datetimepicker JQuery -->
<script type="text/javascript">
    $(function(){
        $("#date_picker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "dd/mm/yy",
            locale: "vi",
            dayNamesMin:[  "Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
            duration: "slow"
            
        });
        $("#date_picker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "dd/mm/yy",
            locale: "vi",
            dayNamesMin:[  "Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
            duration: "slow"
            
        });
        $("#datepicker_coupon_start").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "dd/mm/yy",
            locale: "vi",
            dayNamesMin:[  "Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
            duration: "slow"
            
        });
        $("#datepicker_coupon_end").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "dd/mm/yy",
            locale: "vi",
            dayNamesMin:[  "Chủ nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
            duration: "slow"
        });
    });

</script>



<!-- Biểu đồ morris donut -->
<script type="text/javascript">
    if ($('#donut').length > 0) {
        var donut = new Morris.Donut({
            element: 'donut',
            resize: true,
            colors: [
                '#ce616a',
                '#61a1ce',
                '#ce8f61',
                '#f5b942',
                '#4842f5'
            ],
            data: [
                { label: 'Sản phẩm', value: <?php echo $app_product ?> },
                { label: 'Bài viết', value: <?php echo $app_post ?> },
                { label: 'Đơn hàng', value: <?php echo $app_order ?> },
                { label: 'Khách hàng', value: <?php echo $app_customer ?> }
              
            ]
        });
    }
    
</script>


<!-- Rep comment -->
<script type="text/javascript">
    $('.btn-reply-comment').click(function(){
        
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_'+comment_id).val();
        var comment_product_id = $(this).data('product_id');
       
        $.ajax({
            url : '{{URL::to('/reply-comment')}}',
            method: 'POST',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                comment_id:comment_id,
                comment:comment,
                comment_product_id:comment_product_id

            },
           
            success:function(data){
               $('.reply_comment_'+comment_id).val('');
               $('#notify_comment').html('<span class="text-danger">Trả lời bình luận thành công</span>');
            }
        });

    });

</script>
<!-- Rep comment -->

<!-- Tạo tbl tìm kiếm -->
<script type="text/javascript">
    let table = new DataTable('#myTable');
</script>

<!-- Trạng thái đơn hàng -->
<script type="text/javascript">
$('.order_details').change(function(){
    var order_status = $(this).val();
    var order_id = $(this).children(":selected").attr("id");
    var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';

    // lấy số lượng sản phẩm
    quantity = [];
    $("input[name='product_sales_quantity']").each(function(){
        quantity.push($(this).val());
    });

    // lấy IDs sản phẩm
    order_product_id = [];
    $("input[name='order_product_id']").each(function(){
        order_product_id.push($(this).val());
    });

    // Send AJAX request
    $.ajax({
        url: '{{url('/update-order-qty')}}',
        method: 'POST',
        data: {
            _token: _token,
            order_status: order_status,
            order_id: order_id,
            quantity: quantity,
            order_product_id: order_product_id
        },
        success: function(data){

            alert('Thay đổi tình trạng đơn hàng thành công');
            window.location.href = "{{URL::to('/manage-order')}}";
        }
    });
});

</script>
<!-- Trạng thái đơn hàng -->

<!-- Gallery -->
<script type="text/javascript">
$(document).ready(function() {
    load_gallery();
    function load_gallery() {
        var pro_id = $('.pro_id').val();
        var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
      
        $.ajax({
            url: "{{ url('/select-gallery') }}",
            method: 'POST',
            data: {
                pro_id:pro_id,
                _token:_token
            },
            success:function(data) {
                $('#gallery_load').html(data);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status, error);
            }
        });
    }
    //error message

    $('#files').change(function(){
        var error = '';
        var files = $('#files')[0].files;

        if (files.length > 5) {
            error += '<p>Bạn chỉ được chọn tối đa 5 ảnh</p>';
        }
        else if(files.length ==''){
            error += '<p>Bạn không được bỏ trống ảnh</p>';
        }else if (files.size > 5000000) {
            error += '<p>File ảnh không được lớn hơn 5MB</p>';

        }

        if (error == '') {

        } else{
            $('#files').val('');
            $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
            return false;
        }


    });


    // Delete gallery image
    $(document).on('click','.delete_gallery', function() {
        var gal_id = $(this).data('gal_id');
        var _token = $('input[name="_token"]').length > 0 ? $('input[name="_token"]').val() : '{{ csrf_token() }}';
        if(confirm('Bạn có muốn xóa hình ảnh không ?')){
             $.ajax({
                url : '{{url('/delete-gallery')}}',
                method: 'POST',
                data:{
                    gal_id:gal_id,
                    _token:_token
                },
                success:function(data){
                   load_gallery();
                   $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                }
            });
        }
       
    });

    //Change picture
    $(document).on('change','.file_image', function() {
        var gal_id = $(this).data('gal_id');
        var image = document.getElementById('file-'+gal_id).files[0];
        var form_data = new FormData();

        form_data.append("file", document.getElementById('file-'+gal_id).files[0]); 
        form_data.append("gal_id", gal_id);

        $.ajax({
            url : '{{url('/update-gallery')}}',
            method: 'POST',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:form_data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
               load_gallery();
               $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
            }
        });
        
       
    });

});

</script>
<!-- Gallery -->

<!-- Slug -->
<script type="text/javascript">

    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
         
</script>
<!-- Slug -->




<script type="text/javascript">
    
// <!-- CKEDITOR -->  
    if ($('#ckeditor').length > 0) {
        CKEDITOR.replace('ckeditor');
    }

    if ($('#ckeditor1').length > 0) {
        CKEDITOR.replace('ckeditor1');
    }
    // CKEDITOR.replace('ckeditor');
    // CKEDITOR.replace('ckeditor1');

</script>


<script type="text/javascript">
    $(document).ready(function() {
        if ($('.btn__assign_role').length > 0) {
            $('.btn__assign_role').on('click', function() {
                let roleList = $(this).closest('.user-item').find('input[name="roles[]"]:checked');
                let roles = [];
                
                roleList.each(function(index, item) {
                    roles.push($(item).val());
                });

                let form_data = {
                    admin_id: $(this).closest('.user-item').find('input[name="admin_id"]').val(),
                    roles: roles,
                };

                $.ajax({
                    url : '{{url("/assign-roles")}}',
                    method: 'POST',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    success:function(res) {
                        if (res && res.status == 1) {
                            toastr.success('Phân quyền thành công!', 'Thông báo');
                        } else {
                            toastr.danger('Phân quyền thất bại. Vui lòng thử lại!', 'Thông báo');
                        }
                        
                    }
                });
            });
        }
    });
</script>


</body>
</html>
