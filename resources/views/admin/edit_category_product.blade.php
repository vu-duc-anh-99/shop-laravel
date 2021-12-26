@extends('admin_layout')
@section('admin_content')

{{-- 
 @php
    $message = Session::get('message');
                                if($message){
                                    echo '<span class = "text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                 }
                            @endphp    
--}}
<div class="content__main">
    <span class="table__title">Cập nhật danh mục sản phẩm</span>
    <div class="content__edit">
        <div class="edit__form">
            @foreach ($edit_category_product as $key => $value)
            <form action="{{URL::to('/update-category-product/'.$value->category_id)}}"
                method="post">
                {{ csrf_field() }}
                <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$value->category_name}}" class="form-control"
                                name="category_product_name" id="exampleInputEmail1" placeholder="Thêm tên danh mục">
                <label for="">Từ khóa</label>
                <textarea name="meta_keywords" id="" cols="30" rows="10">{{$value->meta_keywords}}</textarea>
                <label for="">Mô tả</label>
                <textarea name="category_product_desc" id="" cols="30" rows="10">{{$value->category_desc}}</textarea>
                <button name="update_category_product" type="submit">Thay đổi</button>
            </form>
            @endforeach
        </div>
    </div>
    @endsection