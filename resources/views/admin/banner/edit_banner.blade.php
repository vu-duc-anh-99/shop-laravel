@extends('admin_layout')
@section('admin_content')

<div class="content__main">
    <span class="table__title">Cập nhật banner</span>
    <div class="content__edit">
        <div class="edit__form">
            
            <form  action = "{{URL::to('/update-banner/'.$slider->slider_id)}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="">Tên banner</label>
                <input type="text" value="{{$slider->slider_name}}" name="slider_name" placeholder="Tên banner">
                <label for="">Hình ảnh</label>
                <input type="file"name="slider_image" >
                <img src="{{asset('public/uploads/slider/'.$slider->slider_image)}}" height="180px" width="180px" style="object-fit: cover; display: block; margin-left: 0">
                <label for="">Mô tả</label>
                <textarea name="slider_desc" id="" cols="30" rows="10">{{$slider->slider_desc}}</textarea>
                <button name="update_banner" type="submit">Thay đổi</button>
            </form>
            
        </div>
    </div>
@endsection