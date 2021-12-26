@extends('welcome')
@include('pages.left_side.menu_left')
@section('content')
<div class="shop-list__products">
    <h2 class="title">{{$category_title->category_name}}</h2>
    <div class="product__list">
        @foreach ($list_product as $product_value)
        @php
        $url = str_replace(' ',"-",$product_value->product_name);
        @endphp
        <div class="product__item">
            <form action="">
                {{ csrf_field() }}
                <input type="hidden" class="cart_product_id_{{$product_value->product_id}}"
                    value="{{$product_value->product_id}}">
                <input type="hidden" class="cart_product_name_{{$product_value->product_id}}"
                    value="{{$product_value->product_name}}">
                <input type="hidden" class="cart_product_image_{{$product_value->product_id}}"
                    value="{{$product_value->product_image}}">
                <input type="hidden" class="cart_product_qty_{{$product_value->product_id}}" value="1">
                <input type="hidden" class="cart_product_price_{{$product_value->product_id}}"
                    value="{{$product_value->product_price}}">
                <a href="{{URL::to('/chi-tiet-san-pham/'.$product_value->product_id.'/'.$url)}}"
                    style="text-decoration: none;">
                    <img src="{{asset('public/uploads/product/'.$product_value->product_image)}}" alt=""
                        class="product__img">
                    @php
                    $sub_product_name = substr($product_value->product_name,0,35);
                    @endphp
                    <span class="product__name">{{$sub_product_name}}</span>
                    <p class="product__price">{{number_format($product_value->product_price)}} VND</p>
                </a>
                <button type="button" class="button-style add-to-cart" name="add-to-cart"
                    data-product_id="{{$product_value->product_id}}">Thêm vào giỏ hàng</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection