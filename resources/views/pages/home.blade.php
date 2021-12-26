@extends('welcome')
@include('pages.slider.slide')
@include('pages.left_side.menu_left')
@include('pages.search.search_product')
@section('content')
<div class="shop-list__products">
    <h2 class="title">Sản phẩm mới nhất</h2>
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
        <div class="page">
            <ul class="page__list">
                @if ($current_page == 2)
                <li class="page__item"><a href="{{URL::to('/')}}"><i class="fa fa-chevron-left"></i></a></li>
                @else
                <li class="page__item"><a href="{{URL::to('/page/'.$current_page-1)}}"><i
                            class="fa fa-chevron-left"></i></a></li>
                @endif

                @for ($i = 1; $i <= $total_page; $i++) @if ($i==1) <li class="page__item"><a
                        href="{{URL::to('/')}}">{{$i}}</a></li>
                    @else
                    <li class="page__item"><a href="{{URL::to('/page/'.$i)}}">{{$i}}</a></li>
                    @endif
                    @endfor
                    @if ($current_page < $total_page) <li class="page__item">
                        <a href="{{URL::to('/page/'.$current_page+1)}}">
                            <i class="fa fa-chevron-right"></i></a>
                        </li>
                        @else
                        <li class="page__item">
                            <a href="{{URL::to('/page/'.$total_page)}}"><i class="fa fa-chevron-right"></i></a>
                        </li>
                        @endif

            </ul>
        </div>
    </div>
</div>
@endsection







{{-- <footer>
    <div class="row">

        <div class="col-sm-5 text-center">

        </div>
        <div class="col-sm-7 text-right text-center-xs">
            <ul class="pagination pagination-sm m-t-none m-b-none">
                @if ($current_page == 2)
                <li><a href="{{URL::to('/')}}"><i class="fa fa-chevron-left"></i></a></li>
                @else
                <li><a href="{{URL::to('/page/'.$current_page-1)}}"><i class="fa fa-chevron-left"></i></a></li>
                @endif

                @for ($i = 1; $i <= $total_page; $i++) @if ($i==1) <li><a href="{{URL::to('/')}}">{{$i}}</a></li>
                    @else
                    <li><a href="{{URL::to('/page/'.$i)}}">{{$i}}</a></li>
                    @endif
                    @endfor

                    @if ($current_page < $total_page) <li><a href="{{URL::to('/page/'.$current_page+1)}}"><i
                                class="fa fa-chevron-right"></i></a></li>
                        @else
                        <li><a href="{{URL::to('/page/'.$total_page)}}"><i class="fa fa-chevron-right"></i></a></li>
                        @endif

            </ul>
        </div>
    </div>
</footer> --}}