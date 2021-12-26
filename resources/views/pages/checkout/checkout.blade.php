@extends('welcome')
@section('content')
<div class="checkout-form">
    <span class="checkout__title"> Thông tin người nhận </span>
    <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
        {{ csrf_field() }}
        @php
        $message = Session::get('message');

        if($message){
        echo '<div class="alert alert-warning"><span>'.$message.'</span></div>';
        Session::put('message',null);
        }
        $customer_id = Session::get('customer_id');
        @endphp
        @foreach ($list_data as $cus)
        <input type="hidden" name="customer_id" value="{{$customer_id}}">
        <input type="email" name="shipping_email" placeholder="Email" value="{{$cus->customer_email}}">
        <input type="text" name="shipping_name" placeholder="Họ tên *" value="{{$cus->customer_name}}">
        <input type="text" name="shipping_address" placeholder="Địa chỉ gửi hàng *">
        <input type="text" name="shipping_phone" placeholder="Số điện thoại *" value="{{$cus->customer_phone}}">
        @endforeach
        <span class="checkout__title"> Ghi Chú </span>
        <textarea name="shipping_note" placeholder="Ghi chú đơn hàng" rows="16"></textarea>
        <input type="submit" class="checkout__submit" value="Xác nhận">
    </form>
</div>
@endsection