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
			<form action="{{URL::to('/admin-dashboard')}}" method="post">
				{{ csrf_field() }}
				<input type="text" class="ggg" name="admin_email" placeholder="Email" required="">
				<input type="password" class="ggg" name="admin_password" placeholder="Mật khẩu" required="">
				@php
				$message = Session::get('message');
				if($message){
				echo '<span class="text-alert" style="display: block">'.$message.'</span>';
				Session::put('message',null);
				}
				@endphp
				<input type="submit" name="login" value="Đăng nhập" class="button">
			</form>
			<p>Chưa có tài khoản ? <a href="{{asset('/register')}}" style="display: inline;">Đăng ký</a></p>

		</div>
	</div>
</body>

</html>