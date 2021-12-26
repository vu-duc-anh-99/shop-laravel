@extends('admin_layout')
@section('admin_content')

<div class="content__main">
    <span class="table__title">Cập nhật thương hiệu sản phẩm</span>
    <div class="content__edit">
        <div class="edit__form">
            @foreach ($edit_brand_product as $key => $value)
            <form  action = "{{URL::to('/update-brand-product/'.$value->brand_id)}}" method="post">
                {{ csrf_field() }}
                <label for="">Tên thương hiệu</label>
                <input type="text" value="{{$value->brand_name}}"  name="brand_product_name"  placeholder="Thêm tên thương hiệu">
                <label for="">Mô tả</label>
                <textarea name = "brand_product_desc" cols="30" rows="10">{{$value->brand_desc}}</textarea>
                <button name="update_brand_product" type="submit">Thay đổi</button>
            </form>
            @endforeach
        </div>
    </div>
@endsection