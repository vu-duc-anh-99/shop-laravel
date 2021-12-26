@extends('welcome')
@section('content')
<div class="cart">
    <div class="container">
        <div class="cart-form">
            @php
            $message = Session::get('message');
            $total = 0;
            $finalTotal= 0;
            if($message){
            echo '<div class="alert alert-success"><span>'.$message.'</span></div>';
            Session::put('message',null);
            }
            @endphp
            <form action="{{url('/update-cart-ajax')}}" method="POST">
                {{ csrf_field() }}
                <table>
                    <thead>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @if (Session::get('cart'))
                        @foreach (Session::get('cart') as $item)
                        @php
                        $subTotal = $item['product_price']*$item['product_qty'];
                        $finalTotal = $total += $subTotal;
                        @endphp
                        <tr>
                            <td class="cart-product__img">
                                <img src="{{asset('public/uploads/product/'.$item['product_image'])}}" alt=""
                                    class="product__img" />
                            </td>
                            <td class="cart-product__name">
                                <p>{{$item['product_name']}}</p>
                            </td>
                            <td class="cart-product__price">
                                <p>{{number_format($item['product_price'])." VNĐ"}}</p>
                            </td>
                            <td class="cart-product__qty">
                                <input class="cart_quantity_input" type="number" min="1"
                                    name="quantity[{{$item['session_id']}}]" value="{{$item['product_qty']}}"
                                    autocomplete="off" size="2">
                            </td>
                            <td class="cart-product__total">
                                <?php
                                // $subtotal = $item->price * $item->qty;
                                echo number_format($subTotal)." VNĐ";
                            ?>
                            </td>
                            <td class="cart-product__remove">
                                <a class="cart_quantity_delete"
                                    href="{{URL::to('/delete-cart-ajax/'.$item['session_id'])}}"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                <input type="submit" value="Cập nhật giỏ hàng" class="cart-product__update check_out"
                                    name="update_qty" />
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </form>
            <div class="cart__payment">
                <div class="cart__coupon">
                    @php
                    $coupon_mess= Session::get('coupon_message');
                    if($coupon_mess){
                    echo '<div class="alert-warning">'.$coupon_mess.'</div>';
                    Session::put('coupon_message',null);
                    }
                    @endphp
                    <form action="{{url('/check-coupon')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="coupon_code" id="" placeholder="Nhập mã giảm giá"
                            class="cart-coupon__input" />
                        <input type="submit" value="Tính mã giảm giá" name="check_coupon" class="cart-submit" />
                    </form>

                </div>
                <div class="cart__total">
                    <ul>
                        <li>
                            Tổng
                            <p>{{number_format($finalTotal)." VNĐ"}}</p>
                        </li>
                        @if (Session::get('coupon'))
                        @php
                        Session::forget('coupon_message');
                        $coupon2 = Session::get('coupon');
                        @endphp
                        @foreach ($coupon2 as $coupon)
                        @if ($coupon->coupon_type==1)

                        <li>
                            Giảm giá
                            <p>{{number_format($coupon->coupon_number)." %"}}</p>
                        </li>
                        @php
                        $finalTotal = $total - $total * $coupon->coupon_number / 100;
                        @endphp
                        @else
                        <li>
                            Giảm giá
                            <p>{{number_format($coupon->coupon_number)." VNĐ"}}</p>
                        </li>
                        @php
                        $finalTotal = $total - $coupon->coupon_number;
                        @endphp
                        @endif
                        @endforeach
                        @php
                        Session::forget('coupon');
                        @endphp
                        @endif
                        <li>
                            Thành tiền
                            <p>{{number_format($finalTotal)." VNĐ"}}</p>
                            @php
                            Session::put('total',$finalTotal);
                            @endphp
                        </li>
                        <li>
                            @if (Session::get('customer_id'))
                            <a href="{{URL::to('checkout')}}">Thanh toán</a>
                            @else
                            <a href="{{URL::to('login-checkout')}}">Thanh toán</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection