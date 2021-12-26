@extends('welcome')
@section('content')
<div class="shop__login-form">
    <div class="container">
        <div class="shop-account__form">
            <div class="shop-account__login">
                <span class="shop-account__form-title">Đăng nhập</span>
                <form action="{{(URL::to('/login'))}}" method="POST">
                    {{ csrf_field() }}
                    <input type="text" name="customer_email" placeholder="Email" />
                    <input type="password" name="customer_password" placeholder="Mật khẩu" />
                    <button type="submit" class="button-style">Đăng nhập</button>
                </form>
                @php
                $message = Session::get('message');
                if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message',null);
                }
                @endphp
            </div>
            <div class="shop-account__icon">
                <span class="shop-account__form-title">Hoặc</span>
            </div>
            <div class="shop-account__register">
                <span class="shop-account__form-title">Đăng ký</span>
                <form action="{{URL::to('/customer-register')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="text" name="customer_name" placeholder="Họ tên" />
                    <input type="email" name="customer_email" placeholder="Địa chỉ Email" />
                    <input type="password" name="customer_password" placeholder="Mật khẩu" />
                    <input type="text" name="customer_phone" placeholder="Số điện thoại" />
                    @php
                    $message = Session::get('message-register');
                    if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                    }
                    @endphp
                    <button type="submit" class="button-style">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection