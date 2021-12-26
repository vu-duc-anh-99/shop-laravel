<!DOCTYPE html>

<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Trang quản lý</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('public/frontend_admin/css/reset.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/frontend_admin/css/style.css')}}" rel='stylesheet' type='text/css' />
</head>

<body>
    <div class="login__dashboard">
        <div class="login__form">
            <h2>Đăng nhập</h2>
            <form action="{{URL::to('/admin-register')}}" method="post">
                {{ csrf_field() }}
                @error('admin_email')
                <span class="text-alert">{{$message}}</span>
                @enderror
                <input type="text" name="admin_email" value="{{old('admin_email')}}" placeholder="Email">
                @error('admin_password')
                <span class="text-alert">{{$message}}</span>
                @enderror
                <input type="password" name="admin_password" placeholder="Password">
                @error('admin_name')
                <span class="text-alert">{{$message}}</span>
                @enderror
                <input type="text" name="admin_name" value="{{old('admin_name')}}" placeholder="Họ Tên">
                @error('admin_phone')
                <span class="text-alert">{{$message}}</span>
                @enderror
                <input type="text" name="admin_phone" value="{{old('admin_phone')}}" placeholder="Số điện thoại">
                <div class="clearfix"></div>
                <input type="submit" value="Đăng ký" name="register" class="button">
            </form>

        </div>
    </div>
</body>

</html>