@extends('admin_layout')

@section('admin_content')
@hasRole('admin')
<div class="content__main">
    <div class="table">
        <span class="table__title">Danh sách người quản lý</span>
        <table>
            @php
            $message = Session::get('message');
            if($message){
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
            }
            @endphp
            <thead>
                <tr>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Quyền hạn</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admin as $key=>$admin)
                <tr>
                    <td>{{$admin->admin_name}}</td>
                    <td>{{$admin->admin_email}}</td>
                    <td>{{$admin->admin_phone}}</td>
                    <td>
                        @php
                        $str= "";
                        @endphp
                        @foreach ($listRoles as $role)
                        @php
                        $str .= $admin->hasRole($role->role_name) ? ucwords($role->role_name).", " : "" ;
                        @endphp
                        @endforeach
                        {{trim($str,', ')}}
                    </td>
                    <td>
                        <a href="{{URL::to('/edit-admin/'.$admin->admin_id)}}" style="color: green;">
                            <i class="fa fa-pencil-alt"></i></a>
                        <a href="{{URL::to('/delete-admin/'.$admin->admin_id)}}"
                            onclick="return confirm('Bạn có chắc muốn xóa người quản lý này không?')"
                            style="color: red; margin-top: 2rem;">
                            <i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endhasRole
@endsection