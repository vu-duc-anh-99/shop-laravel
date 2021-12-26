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
    <span class="table__title">Thêm danh mục sản phẩm</span>
    <div class="content__edit">
        <div class="edit__form">
            <form action="{{URL::to('/save-category-product')}}" method="post">
                {{ csrf_field() }}
                <label for="">Tên danh mục</label>
                <input type="text" name="category_product_name" placeholder="Thêm tên danh mục" />
                <label for="">Từ khóa</label>
                <textarea name="meta_keywords" id="" cols="30" rows="10"></textarea>    
                <label for="">Mô tả</label>
                <textarea name="category_product_desc" id="" cols="30" rows="10"></textarea>
                <label for="">Hiển thị</label>
                <select name="category_product_status" id="">
                    <option value="0">Ẩn</option>
                    <option value="1">Hiển thị</option>
                   
                </select>
               

                <button  name="add_category_product" type="submit">Thêm danh mục</button>
            </form>
        </div>
    </div>
    @endsection