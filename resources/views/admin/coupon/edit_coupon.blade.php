@extends('admin_layout')
@section('admin_content')

<div class="content__main">
    <span class="table__title">Cập nhật mã giảm giá</span>
    <div class="content__edit">
        <div class="edit__form">
            @foreach ($coupon as $key => $value)
            <form action="{{URL::to('/edit-coupon/'.$value->coupon_id)}}" method="POST">
                {{ csrf_field() }}
                <label for="">Mã giảm giá</label>
                <input type="text" value="{{$value->coupon_code}}" name="coupon_code">
                <label for="">Số lượng</label>
                <input type="text" value="{{$value->coupon_times}}" name="coupon_times">
                <label for="">Phân loại</label>
                <select name="coupon_type">
                    @if ($value->coupon_type==1)
                    <option selected value="1">Giảm theo phần trăm</option>
                    <option value="2">Giảm theo tiền</option>
                    @endif
                    @if ($value->coupon_type==2)
                    <option value="1">Giảm theo phần trăm</option>
                    <option selected value="2">Giảm theo tiền</option>
                    @endif
                </select>
                <label for="">Nhập số tiền giảm hoặc phần trăm</label>
                @if ($value->coupon_type==1)
                <input type="text" value="{{$value->coupon_number}}" name="coupon_number">
                @else
                <input type="text" value="{{$value->coupon_number}}" name="coupon_number">
                @endif

                <button name="edit-coupon" type="submit">Thay đổi</button>
            </form>
            @endforeach
        </div>
    </div>
    @endsection