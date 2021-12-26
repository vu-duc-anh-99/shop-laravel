@extends('welcome');
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $content = Cart::content();    
                    ?>
                    @foreach ($content as $item)
                    <tr>
                        <td class="cart_product">
                            <img src="public/uploads/product/{{$item->options->image}}" width="60px" />
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->name}}</a></h4>
                            <p>ID: {{$item->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($item->price)." VNĐ"}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                {{-- <a class="cart_quantity_up" href=""> + </a>
                                <a class="cart_quantity_down" href=""> - </a> --}}
                                <form action="{{URL::to('/update-cart')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2">
                                    <input type="hidden" value="{{$item->rowId}}" name="rowId_cart" class="form-control">
                                    <input type="submit" value="Cập nhật" name = "update_qty" class="btn btn-default btn-sm">  
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $item->price * $item->qty;
                                    echo number_format($subtotal)." VNĐ";
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$item->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::subtotal(). " VNĐ"}}</span></li>
                        <li>Thuế <span>{{Cart::tax(). " VNĐ"}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::total(). " VNĐ"}}</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        @if (Session::get('customer_id'))
                            <a class="btn btn-default check_out" href="{{URL::to('checkout')}}">Thanh toán</a>
                        @else
                            <a class="btn btn-default check_out" href="{{URL::to('login-checkout')}}">Thanh toán</a>
                        @endif
                        
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection