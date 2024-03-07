@extends('layout')
@section('content')

<div class="features_items">
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
@if($no_product_message)
    <p style="text-align: center; font-style: italic; font-size: 16px; color: red;">{{ $no_product_message }}</p>
@else
    @foreach($search_product as $key => $product)
    <div class="col-sm-4">
        <form>
            {{csrf_field()}}
            <div class="product-image-wrapper">
                <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                            <img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" />
                            <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                            <p>{{$product->product_name}}</p>
                        </div>
                    </div>
                </a>
                <div class="choose text-center">
                    <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                </div>
            </div>
        </form>
    </div>
    @endforeach 
@endif
     
</div>


@endsection