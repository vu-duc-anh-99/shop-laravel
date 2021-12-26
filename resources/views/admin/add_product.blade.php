@extends('admin_layout')
@section('admin_content')
<div class="content__main">
    <span class="table__title">Thêm sản phẩm</span>
    <div class="content__edit">
        <div class="edit__form">
            <form action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="">Tên sản phẩm</label>
                <input type="text" name="product_name" placeholder="Thêm tên sản phẩm">
                <label for="">Hình ảnh</label>
                <input type="file" class="form-control" name="product_image" id="">
                <label for="">Mô tả</label>
                <textarea name="product_desc" cols="30" rows="10" id="ckeditor1"></textarea>
                <label for="">Số lượng</label>
                <input type="text" class="form-control" name="product_quantity" id="">
                <label for="">Giá</label>
                <input type="text" class="form-control" name="product_price" id=""
                    placeholder="Thêm giá sản phẩm">
                <label for="">Nội dung</label>
                <textarea name="product_content" cols="30" rows="10" id="ckeditor2"></textarea>
                <label for="">Danh mục</label>
                <select name="category_id" class="form-control input-m m-bot15">
                    @foreach ($cate_product as $key => $cate_value)
                    <option value="{{$cate_value->category_id}}">{{$cate_value->category_name}}</option>
                    @endforeach
                </select>
                <label for="">Thương hiệu</label>
                <select name="brand_id" class="form-control input-m m-bot15">
                    @foreach ($brand_product as $key=>$brand_value)
                    <option value="{{$brand_value->brand_id}}">{{$brand_value->brand_name}}</option>
                    @endforeach
                </select>
                <label for="">Hiển thị</label>
                <select name="product_status" id="">
                    <option value="0">Ẩn</option>
                    <option value="1">Hiển thị</option>
                </select>


                <button name="add_product" type="submit">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
    @endsection