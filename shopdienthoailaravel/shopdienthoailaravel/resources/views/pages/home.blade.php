@extends('layout')
@section('content')

<div class="features_items">
<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @php
            $i=0;
            @endphp

            @foreach($cate_pro_tabs as $key => $cate_tabs)
           
            <li data-id="{{$cate_tabs->category_id}}" class="tabs_pro {{$i==0 ? 'active' : ''}}">
                <a href="#{{$cate_tabs->slug_category_product}}" data-toggle="tab">{{$cate_tabs->category_name}}</a></li>
            @php
            $i++;
            @endphp 
            @endforeach
        </ul>
    </div>
    <div id="tabs_product"></div>
</div><!--/category-tab-->


<h2 class="title text-center">Sản phẩm mới nhất</h2>
@foreach($all_product as $key => $product)
<div class="col-sm-4">
    <form>
    {{csrf_field()}}
    <div class="product-image-wrapper">
        <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
        <div class="single-products">
            <div class="productinfo text-center">
               
                <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}" id="wishlist_productname{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                <input type="hidden"  value="1" class="cart_product_qty_{{$product->product_id}}">
                <img id="wishlist_productimage{{$product->product_id}}" src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" />
                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                <p>{{$product->product_name}}</p>
            </div>
        </div>
        </a>
        <div class="text-center">
            <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
        </div>
        <div class="choose text-center">
            <button type="button" class="btn btn-default button_wishlist" id="{{$product->product_id}}" onclick="add_wishlist(this.id);"><span>Yêu thích</span></button>
            <input type="button" value="Xem nhanh" data-toggle="modal" class="btn btn-default xemnhanh" data-id_product="{{$product->product_id}}" data-target="#xemnhanh">
        </div>
    </div>
    </form>
</div>   
                
@endforeach                   
</div>
<!-- Modal -->
<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title product_quickview_title" id="">
            <span id="product_quickview_title"></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <style type="text/css">
                span#product_quickview_content img,
                span#product_quickview_desc img,
                span#product_quickview_content input,
                span#product_quickview_desc input{
                  width: 100% !important;
                  height: auto !important;
                }


                @media screen and (min-width: 768px){
                    .modal-dialog{
                    width: 700px;
                  }
                  .modal-sm{
                    width: 350px;
                  }
                  span#product_quickview_gallery img{
                   width: 180px !important;
                    height: auto !important;
                  }

                }
                @media screen and (min-width: 992px){
                  .modal-lg{
                    width: 1100px;
                  }
                  span#product_quickview_gallery img{
                    width: 180px !important;
                    height: auto !important;
                  }
                }
            </style>
            <div class="row">
                <div class="col-md-5">
                    <span id="product_quickview_gallery"></span>
                </div>
                <form action="{{URL::to('/save-cart')}}" method="POST">
                    {{csrf_field()}}
                    <div id="product_quickview_value"></div>
                    <div class="col-md-7">
                    <h2><span id="product_quickview_title"></span></h2>
                    <p>Mã sản phẩm: <span id="product_quickview_id"></span></p>
                    <p style="font-size: 20px; color: brown; font-weight: bold;">Giá sản phẩm: <span id="product_quickview_price"></span></p>
                    <input name="qty" type="hidden" min="1" class="cart_product_qty_"  value="1" />


                    <p><span id="product_quickview_desc"></p>
                    <p><span id="product_quickview_content"></p>
                    
                    <div id="product_quickview_button"></div>
                    <div id="beforesend_quickview"></div>
                    </div>
                </form>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-default redirect-cart">Đi tới giỏ hàng</button>
        </div>
    </div>
    </div>
</div>
<!-- Modal -->
<ul class="pagination pagination-sm m-t-none m-b-none">
    {!!$all_product->links()!!}
</ul>

@endsection