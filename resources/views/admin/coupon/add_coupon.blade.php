@extends('admin_layout')
@section('admin_content')
<div class="content__main">
    <span class="table__title">Thêm mã giảm giá</span>
    <div class="content__edit">
        <div class="edit__form">
            <form action = "{{URL::to('/save-coupon')}}" method="post">
                {{ csrf_field() }}
                <label for="">Mã giảm giá</label>
                <input type="text" name="coupon_code" placeholder="Thêm tên danh mục" />
                <label for="">Số lượng</label>
                <input type="text" name="coupon_times" placeholder="Số lượng" />   
                <label for="">Mô tả</label>
                <textarea name="category_product_desc" id="" cols="30" rows="10"></textarea>
                <label for="">Phân loại</label>
                <select name="coupon_type" id="">
                    <option value="0">Chọn</option>
                    <option value="1">Giảm theo phần trăm</option>
                    <option value="2">Giảm theo tiền</option>
                </select>
                <label for="">Nhập số tiền giảm hoặc số phần trăm</label>
                <input type="text"name="coupon_number">

                <button  name="add_coupon" type="submit">Thêm danh mục</button>
            </form>
        </div>
    </div>
@endsection