@extends('admin_layout')
@section('admin_content')
<div class="content__main">
    <span class="table__title">Cập nhật thông tin người quản lý</span>
    <div class="content__edit">
        <div class="edit__form">
            @foreach ($admin as $key => $user)
            <form role="form" action="{{URL::to('/update-admin/'.$user->admin_id)}}" method="post">
                @php
                $message = Session::get('message');
                if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message',null);
                }
                @endphp
                {{ csrf_field() }}
                <label for="">Tên người quản lý</label>
                <input type="text" value="{{$user->admin_name}}" name="admin_name" placeholder="Họ tên">
                <label>Email</label>
                <input type="text" value="{{$user->admin_email}}" name="admin_email" placeholder="Họ tên">
                <label>Số điện thoại</label>
                <input type="text" value="{{$user->admin_phone}}" name="admin_phone" placeholder="Họ tên">
                <label>Quyền hạn: </label>
                @foreach ($listRoles as $key=>$role)
                {{ucwords($role->role_name)}}
                <input type="checkbox" name="{{$role->role_name}}" style="margin-right: 10px; width: 3rem;"
                    {{$user->hasRole($role->role_name) ? 'checked' : ''}}>
                @endforeach
                <button name="update_brand_product" type="submit">Thay đổi</button>
            </form>
            @endforeach
        </div>
    </div>
    @endsection