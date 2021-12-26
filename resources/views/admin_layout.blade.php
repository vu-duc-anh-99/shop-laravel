<!DOCTYPE html>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Dashboard</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
		integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="{{asset('public/frontend_admin/css/reset.css')}}" rel='stylesheet' type='text/css' />
	<link href="{{asset('public/frontend_admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend_admin/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend_admin/css/style.css')}}" rel='stylesheet' type='text/css' />
</head>

<body>

	<header>
		<div class="brand">
			<a href="{{URL::to('/dashboard')}}">
				<h1 class="title">ADMIN</h1>
			</a>
		</div>
		<div class="main__nav">
			<ul class="main__nav-list">
				<li class="main__nav-item">
					<a href="{{URL::to('/logout')}}" class="account">
						@php
						$admin_name = Session::get('admin_name');
						if($admin_name){
						echo $admin_name;
						}
						@endphp
						<i class="fa fa-caret-down"></i>

						{{--
				<li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li> --}}
				</a>
				</li>
			</ul>
		</div>
	</header>

	<div class="main__content">
		<div class="main-menu__group">
			<ul class="main-menu__list">
				<li class="main-menu__item">
					<div class="main-menu__item-content">
						<a class="active" href="{{URL::to('/dashboard')}}">
							<i class="fa fa-database menu-icon"></i>
							<span>Tổng quan</span>
						</a>
					</div>
				</li>

				<li class="main-menu__item">
					<div class="main-menu__item-content">
						<i class="fa fa-book menu-icon"></i>
						<span>Danh mục sản phẩm</span>
						<i class="fa fa-caret-down menu__caret"></i>
					</div>
					<ul class="sub-menu__list">
						<li class="sub-menu__item"><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản
								phẩm</a></li>
						<li class="sub-menu__item"><a href="{{URL::to('/list-category-product')}}">Danh sách danh
								mục sản phẩm</a></li>
					</ul>
				</li>
				<li class="main-menu__item">
					<div class="main-menu__item-content">
						<i class="fa fa-book menu-icon"></i>
						<span>Quản lý banner</span>
						<i class="fa fa-caret-down menu__caret"></i>
					</div>
					<ul class="sub-menu__list">
						<li class="sub-menu__item"><a href="{{URL::to('/add-slider')}}">Thêm banner</a></li>
						<li class="sub-menu__item"><a href="{{URL::to('/manage-slider')}}">Danh sách banner</a></li>
					</ul>
				</li>
				<li class="main-menu__item">
					<div class="main-menu__item-content">
						<i class="fa fa-book menu-icon"></i>
						<span>Quản lý đơn hàng</span>
						<i class="fa fa-caret-down menu__caret"></i>
					</div>
					<ul class="sub-menu__list">
						<li class="sub-menu__item"><a href="{{URL::to('/manage-order')}}">Danh sách đơn hàng</a>
						</li>
					</ul>
				</li>
				<li class="main-menu__item">
					<div class="main-menu__item-content">
						<i class="fa fa-book menu-icon"></i>
						<span>Quản lý mã giảm giá</span>
						<i class="fa fa-caret-down menu__caret"></i>
					</div>
					<ul class="sub-menu__list">
						<li class="sub-menu__item"><a href="{{URL::to('/add-coupon')}}">Thêm mã giảm giá</a></li>
						<li class="sub-menu__item"><a href="{{URL::to('/manage-coupon')}}">Danh sách mã giảm giá</a>
						</li>
					</ul>
				</li>
				<li class="main-menu__item">
					<div class="main-menu__item-content">
						<i class="fa fa-book menu-icon"></i>
						<span>Quản lý thương hiệu</span>
						<i class="fa fa-caret-down menu__caret"></i>
					</div>
					<ul class="sub-menu__list">
						<li class="sub-menu__item"><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản
								phẩm</a></li>
						<li class="sub-menu__item"><a href="{{URL::to('/list-brand-product')}}">Danh sách thương
								hiệu sản phẩm</a></li>
					</ul>
				</li>
				<li class="main-menu__item">
					<div class="main-menu__item-content">
						<i class="fa fa-book menu-icon"></i>
						<span>Quản lý sản phẩm</span>
						<i class="fa fa-caret-down menu__caret"></i>
					</div>
					<ul class="sub-menu__list">
						<li class="sub-menu__item"><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li class="sub-menu__item"><a href="{{URL::to('/list-product/1')}}">Danh sách sản phẩm</a>
						</li>
					</ul>
				</li>


			</ul>
		</div>

		<div class="content">
			@yield('admin_content')
			<div class="author">demaon2010@gmail.com - Vũ Đức Anh</div>
		</div>


	</div>

	<script src="{{asset('public/frontend_admin/ckeditor/ckeditor.js')}}"></script>
	<script src={{asset('public/frontend_admin/js/jquery.js')}}></script>
	<script src={{asset('public/frontend_admin/js/sweetalert.min.js')}}></script>
	<script src="{{asset('//cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js')}}"></script>
	<script src="{{asset('//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css')}}">
	</script>

	<script>
		CKEDITOR.replace('ckeditor1');
	CKEDITOR.replace('ckeditor2');
	</script>
	<script>
		$('#form-input').validate({
		rules:{
			product_name: {
				required : true,
			}
		},
		messages : {
			product_name: {
				required: "Yêu cầu nhập tên sản phẩm",
			}
		}
	});
	</script>

	<script type="text/javascript">
		$('.order_details').change(function(){
		var order_status = $(this).val();
		var order_id = $(this).children(":selected").attr("order-id")
		var _token = $('input[name="_token"]').val();

		//get product quantity
		quantity = [];
		//each để nối từng kết quả vào mảng quantity 2,4,5,3
		$("input[name = 'product_sales_quantity']").each(function(){
			quantity.push($(this).val());
		});

		order_product_id = [];
		$("input[name = 'order_product_id']").each(function(){
			order_product_id.push($(this).val());
		});
		
		j = 0;
		if(order_status ==2 ){
			for(i = 0; i < order_product_id.length; i++ ){
			var order_qty_storage = $('.order_qty_storage_'+ order_product_id[i]).val();
			
			if(parseInt(quantity[i])> parseInt(order_qty_storage)){
				j = j + 1;
				// alert ("Số lượng hàng trong kho không đủ");
				$('.color_check_qty_'+ order_product_id[i]).css('background','#000');
			}
		}
		}
		

		 if(j==0){
			$.ajax({
			url : '{{url('/update-order-qty')}}',
			method: 'POST',
			data: {
				_token: _token, 
				order_status:order_status, 
				order_id: order_id,
				quantity: quantity, 
				order_product_id: order_product_id
			},
			success:function(data){
				if(order_status != 3){
					alert("Cập nhật thành công");
					location.reload();
				}
				else {
					alert("Xóa đơn hàng thành công");
					window.location.href= "{{url('/manage-order')}}";
				}
				
			}
			
			
			});
		}else{
			alert ("Số lượng hàng trong kho không đủ");
		}

		
		
	});
	</script>

</body>

</html>