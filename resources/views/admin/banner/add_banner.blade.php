@extends('admin_layout')
@section('admin_content')

<div class="content__main">
    <span class="table__title">Thêm banner</span>
    <div class="content__edit">
        <div class="edit__form">
            <form action = "{{URL::to('/save-banner')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="">Tên banner</label>
                <input type="text" name="slider_name" placeholder="Thêm tên banner" />
                <label for="">Hình ảnh</label>
                <input type="file" name="slider_image">    
                <label for="">Mô tả</label>
                <textarea name="slider_desc" id="" cols="30" rows="10"></textarea>
                <label for="">Hiển thị</label>
                <select name="slider_status" id="">
                    <option value="0">Ẩn</option>
                    <option value="1">Hiển thị</option>
                   
                </select>
               

                <button  name="add_slider" type="submit">Thêm danh mục</button>
            </form>
        </div>
    </div>
@endsection