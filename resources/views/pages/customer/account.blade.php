@extends('welcome')
@section('content')
<div class="shop-account__change">
    <span class="shop-account__form-title">Đổi mật khẩu</span>

    <form action="{{URL::to('/change-password')}}" method="POST">
        @php
        $message = Session::get('message');

        if($message){
        echo '<div class="alert alert-warning"><span>'.$message.'</span></div>';
        Session::put('message',null);
        }
        @endphp
        {{ csrf_field() }}
        @php
        $customer_id = Session::get('customer_id');
        @endphp
        <input type="hidden" name="customer_id" value="{{$customer_id}}" />
        <input type="password" name="old_password" placeholder="Mật khẩu cũ" />
        <input type="password" name="new_password" placeholder="Mật khẩu mới" />
        <input type="password" name="new_password_confirm" placeholder="Xác nhận mật khẩu mới" />
        <input type="submit" value="Cập nhật" id="submit_change_password" />
    </form>
</div>
@endsection