@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        @php
            $message = Session::get('message');
                if($message){
                    echo '<div class = "alert alert-warning"><span>'.$message.'</span></div>';
                    Session::put('message',null);
                }
        @endphp
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       $content = Session::get('cart');
                       $total = 0;
                       $finalTotal = 0;    
                    ?>
                    @foreach ($content as $item)
                    <tr>
                        <td class="cart_product">
                            <img src="public/uploads/product/{{$item['product_image']}}" width="60px" />
                        </td>
                        <td class="cart_description">
                            <h4><a href=""></a></h4>
                            <p>{{$item['product_name']}}</p>
                        </td>
                        
                        <td class="cart_price">
                            <p>{{number_format($item['product_price'])." VNĐ"}}</p>
                        </td>
                        <td class="cart_price">   
                                {{-- <a class="cart_quantity_up" href=""> + </a>
                                <a class="cart_quantity_down" href=""> - </a> --}}
                                <p>{{$item['product_qty']}}</p>
                        </td>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $item['product_price'] * $item['product_qty'];
                                    $total += $subtotal;
                                    echo number_format($subtotal)." VNĐ";
                                ?>
                            </p>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total_area">
                <div class="col-sm-5">
                    <ul>
                        <li>Tổng <span><p>{{number_format($total)." VNĐ"}}</p></span></li>
                        @php
                            $coupon2 = Session::get('coupon');
                        @endphp
                        @if ($coupon2)
                            @foreach ($coupon2 as $coupon)                     
                                @if ($coupon->coupon_type==1)
                                    <li>Giảm giá <span><p>{{number_format($coupon->coupon_number)." %"}}</span></li>
                                    @php
                                        $finalTotal = $total - $total * $coupon->coupon_number / 100;
                                    @endphp
                                @else
                                    <li>Giảm giá <span><p>{{number_format($coupon->coupon_number)." VNĐ"}}</span></li>
                                    @php
                                        $finalTotal = $total - $coupon->coupon_number;
                                    @endphp
                                @endif
                            @endforeach
                        @else
                        @php
                            $finalTotal = $total;
                        @endphp
                        <li>Thành tiền <span><p>{{number_format($finalTotal)." VNĐ"}}</p></span></li>
                        @endif
                            @php
                                Session::put('total',$finalTotal);
                            @endphp
                            <div class="payment-options">
                                <form action="{{URL::to('/payment-option')}}" method="post">
                                    {{ csrf_field() }}
                                    <span>
                                        <label><input name="payment_option" value="1" type="checkbox"> Thẻ ATM</label>
                                    </span>
                                    <span>
                                        <label><input name="payment_option" value="2" type="checkbox"> Trả tiền mặt</label>
                                    </span>
                                    <input type="submit" value="Xác nhận" name = "send_order" class="btn btn-primary">
                                </form>
                            </div> 
                        
                    </ul>
                        
                </div>
            </div>
            
        </div>
       
    </div>
</section> <!--/#cart_items-->
@endsection