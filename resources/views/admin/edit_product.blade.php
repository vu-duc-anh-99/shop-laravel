@extends('admin_layout')
@section('admin_content')

<div class="content__main">
    <span class="table__title">Cập nhật sản phẩm</span>
    <div class="content__edit">
        <div class="edit__form">
            @foreach ($edit_product as $key => $value)
            <form action="{{URL::to('/update-product/'.$value->product_id)}}" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="">Tên sản phẩm</label>
                <input type="text" value="{{$value->product_name}}" name="product_name" placeholder="Thêm tên sản phẩm">
                <label for="">Hình ảnh</label>
                <input type="file" name="product_image">
                <img src="{{asset('public/uploads/product/'.$value->product_image)}}" height="180px" width="180px"
                    style="object-fit: cover; display: block; margin-left: 0">
                <label for="">Mô tả</label>
                <textarea name="product_desc" id="" cols="30" rows="10">{{$value->product_desc}}</textarea>
                <label for="">Số lượng</label>
                <input type="text" name="product_quantity" value="{{$value->product_quantity}}">
                <label for="">Giá</label>
                <input type="text" value="{{$value->product_price}}" name="product_price"
                    placeholder="Thêm giá sản phẩm">
                <label for="">Nội dung</label>
                <textarea name="product_content" id="" cols="30" rows="10">{{$value->product_content}}</textarea>
                <label for="">Danh mục</label>
                <select name="category_id">
                    @foreach ($cate_product as $key => $cate_value)
                    @if ($value->category_id == $cate_value->category_id)
                    <option selected value="{{$cate_value->category_id}}">{{$cate_value->category_name}}
                    </option>
                    @else
                    <option value="{{$cate_value->category_id}}">{{$cate_value->category_name}}</option>
                    @endif

                    @endforeach

                </select>
                <label for="">Thương hiệu</label>
                <select name="brand_id">
                    @foreach ($brand_product as $key => $brand_value)
                    @if ($value->brand_id == $brand_value->brand_id)
                    <option selected value="{{$brand_value->brand_id}}">{{$brand_value->brand_name}}
                    </option>
                    @else
                    <option value="{{$brand_value->brand_id}}">{{$brand_value->brand_name}}</option>
                    @endif

                    @endforeach
                </select>   

                <button name="update_product" type="submit">Thay đổi</button>
            </form>
            @endforeach
        </div>
    </div>
    @endsection