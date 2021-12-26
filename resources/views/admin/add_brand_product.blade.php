@extends('admin_layout')
@section('admin_content')
<div class="content__main">
    <span class="table__title">Thêm thương hiệu sản phẩm</span>
    <div class="content__edit">
        <div class="edit__form">
            <form action = "{{URL::to('/save-brand-product')}}" method="post">
                {{ csrf_field() }}
                <label for="">Tên thương hiệu</label>
                <input type="text" name="brand_product_name" placeholder="Thêm tên thương hiệu" />
                <label for="">Mô tả</label>
                <textarea name="brand_product_desc" id="" cols="30" rows="10"></textarea>    
                <label for="">Hiển thị</label>
                <select name="brand_product_status" id="">
                    <option value="0">Ẩn</option>
                    <option value="1">Hiển thị</option>
                   
                </select>
                <button  name="add_brand_product" type="submit">Thêm thương hiệu</button>
            </form>
        </div>
    </div>
@endsection