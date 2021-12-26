@extends('welcome')

@section('content')
<div class="shop-product__details">
    <h2 class="title">Chi tiết sản phẩm</h2>
    <form action="">
        {{ csrf_field() }}
        <input type="hidden" class="cart_product_id_{{$product_detail->product_id}}"
            value="{{$product_detail->product_id}}">
        <input type="hidden" class="cart_product_name_{{$product_detail->product_id}}"
            value="{{$product_detail->product_name}}">
        <input type="hidden" class="cart_product_image_{{$product_detail->product_id}}"
            value="{{$product_detail->product_image}}">
        <input type="hidden" class="cart_product_qty_{{$product_detail->product_id}}" value="1">
        <input type="hidden" class="cart_product_price_{{$product_detail->product_id}}"
            value="{{$product_detail->product_price}}">
        <div class="product__details">

            <div class="product__details-img">
                <img src="{{asset('public/uploads/product/'.$product_detail->product_image)}}" alt=""
                    class="product__img" />
            </div>
            <div class="product__details-information">
                <span class="product__name">{{$product_detail->product_name}}</span>
                <p class="product__price">{{number_format($product_detail->product_price)}} VND</p>
                <button type="button" class="button-style add-to-cart" name="add-to-cart"
                    data-product_id="{{$product_detail->product_id}}">
                    Thêm vào giỏ hàng
                </button>
                @if ($product_detail->product_quantity > 0)
                <p class=" product__status">Tình trạng: Còn hàng</p>
                @else
                <p class="product__status">Tình trạng: Hết hàng</p>
                @endif
                <p class="product__brand">Thương hiệu {{$product_detail->brand_name}}</p>
            </div>

            @if (count($relate_product)==6)
            <div class="product__similiar">
                <div class="slider">
                    <figure class="similiar-product">
                        <div class="slider__item">
                            @for ($i = 0; $i < 3; $i++) @php $url=str_replace(' ',"-",$relate_product[$i]->product_name); @endphp
                        <a {{asset(' /chi-tiet-san-pham/'.$relate_product[$i]->
                                product_id."/".$url)}}>
                                <img src="{{asset('public/uploads/product/'.$relate_product[$i]->product_image)}}"
                                    alt="" />
                                </a>
                                @endfor
                        </div>
                        <div class="slider__item">
                            @for ($i = 3; $i < 6; $i++) @php $url=str_replace(' ',"-",$relate_product[$i]->product_name); @endphp
                        <a {{asset(' /chi-tiet-san-pham/'.$relate_product[$i]->
                                product_id."/".$url)}}>
                                <img src="{{asset('public/uploads/product/'.$relate_product[$i]->product_image)}}"
                                    alt="" />
                                </a>
                                @endfor
                        </div>
                        <div class="slider__item">
                            @for ($i = 0; $i < 3; $i++) @php $url=str_replace(' ',"-",$relate_product[$i]->product_name); @endphp
                        <a {{asset(' /chi-tiet-san-pham/'.$relate_product[$i]->
                                product_id."/".$url)}}>
                                <img src="{{asset('public/uploads/product/'.$relate_product[$i]->product_image)}}"
                                    alt="" />
                                </a>
                                @endfor
                        </div>
                    </figure>
                </div>
            </div>
            @endif
        </div>
    </form>
    <div class="product__details-group">
        <ul class="product__details-list">
            <li class="product__details-nav">
                <a href="">Mô tả</a>
            </li>
        </ul>
        <div class="product__details-content">
            {!!$product_detail->product_content!!}
        </div>
    </div>
</div>
@endsection

@include(' pages.left_side.menu_left')