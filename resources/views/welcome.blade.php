<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>VDAShop</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
		integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />


	<link href="{{asset('public/frontend/css/reset.css')}}" rel='stylesheet' type='text/css' />
	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/style.css')}}" rel='stylesheet' type='text/css' />
</head>

<body>
	<header>
		<div class="container">
			<div class="shop-header">
				<a href="/"><img src="{{asset('public/frontend/logo/logo.png')}}" alt="" class="shop-logo__img" />
				</a>
				<div class="shop-menu">
					@php
					$customer_id = Session::get('customer_id');
					$customer_name = Session::get('customer_name');
					@endphp
					<ul class="shop-menu__list">
						@if($customer_id)
						<li class="shop-menu__item account">
							<a href="{{URL::to('/logout-home')}}">
								<i class="fa fa-caret-down shop-menu__icon"></i>
								{{$customer_name}}
							</a>
							<ul class="account__list">
								<li class="account__item"><a href="{{URL::to('/account')}}">Đổi mật khẩu</a></li>
								<li class="account__item"><a href="{{URL::to('/logout-home')}}">Đăng xuất</a></li>
							</ul>
						</li>
						@else
						<li class="shop-menu__item dangnhap">
							<a href="{{URL::to('/login-checkout')}}">
								<i class=" fa fa-lock shop-menu__icon"></i>
								Đăng nhập
							</a>
						</li>
						@endif
						<li class="shop-menu__item">
							<a href="{{(URL::to('/gio-hang'))}}">
								<i class="fa fa-shopping-bag shop-menu__icon"></i>
								Giỏ hàng
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</header>

	<div class="container">
		<div class="slider">
			@yield('slider')
		</div>

		@yield('search')

		<div class="shop-list">
			@yield('left_side')
			@yield('content')
		</div>
	</div>
	</div>
	<footer class="shop-footer">
		<div class="container">
			<div class="shop-footer__group">
				<ul class="shop-footer__list">
					<h2 class="shop-footer__title">Giới thiệu về cửa hàng</h2>
					<li class="shop-footer__item"><a href="#">Giới thiệu</a>
					</li>
					<li class="shop-footer__item"><a href="#">Thông tin liên hệ</a></li>
					<li class="shop-footer__item"><a href="#">Tuyển dụng</a></li>
					<li class="shop-footer__item"><a href="#">Tin tức</a></li>
				</ul>
				<ul class="shop-footer__list">
					<h2 class="shop-footer__title">Hỗ trợ khách hàng</h2>
					<li class="shop-footer__item"><a href="#">Hướng dẫn mua hàng trực tuyến</a></li>
					<li class="shop-footer__item"><a href="#">Hướng dẫn thanh toán</a></li>
					<li class="shop-footer__item"><a href="#">Hướng dẫn mua hàng trả góp</a></li>
					<li class="shop-footer__item"><a href="#">Góp ý, khiếu nại</a></li>
				</ul>
				<ul class="shop-footer__list">
					<h2 class="shop-footer__title">Chính sách chung</h2>
					<li class="shop-footer__item"><a href="#">Chính sách, quy định chung</a></li>
					<li class="shop-footer__item"><a href="#">Chính sách vận chuyển</a></li>
					<li class="shop-footer__item"><a href="#">Chính sách bảo hành</a></li>
					<li class="shop-footer__item"><a href="#">Chính sách đổi trả, hoàn tiền</a></li>
				</ul>
				<ul class="shop-footer__list">
					<h2 class="shop-footer__title">Thông tin khuyến mãi</h2>
					<li class="shop-footer__item"><a href="#">Thông tin khuyến mãi</a></li>
					<li class="shop-footer__item"><a href="#">Sản phẩm khuyến mãi</a></li>
					<li class="shop-footer__item"><a href="#">Sản phẩm bán chạy</a></li>
					<li class="shop-footer__item"><a href="#">Sản phẩm mới</a></li>
				</ul>
				<ul class="shop-footer__list">
					<h2 class="shop-footer__title">Thông tin khuyến mãi</h2>
					<li class="shop-footer__item"><a href="#">Thông tin khuyến mãi</a></li>
					<li class="shop-footer__item"><a href="#">Sản phẩm khuyến mãi</a></li>
					<li class="shop-footer__item"><a href="#">Sản phẩm bán chạy</a></li>
					<li class="shop-footer__item"><a href="#">Sản phẩm mới</a></li>
				</ul>
			</div>
		</div>
		<div class="shop-footer__author">
			<div class="container">
				<ul class="author__social-list">
					<li class="author__social-item">
						<a href="#">demaon2010@gmail.com</a>
					</li>
					<li class="author__social-item">
						<a href="#">Vũ Đức Anh</a>
					</li>
				</ul>
			</div>
		</div>
	</footer>

	<script src={{asset('public/frontend/js/jquery.js')}}></script>
	<script src={{asset('public/frontend/js/sweetalert.min.js')}}></script>


	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id = $(this).data('product_id');
				var cart_product_id = $('.cart_product_id_'+ id).val();
				var cart_product_name= $('.cart_product_name_'+ id).val();
				var cart_product_image = $('.cart_product_image_'+ id).val();
				var cart_product_price = $('.cart_product_price_'+ id).val();
				var cart_product_qty = $('.cart_product_qty_'+ id).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/add-cart-ajax')}}',
					method: 'POST',
					data: {cart_product_id:cart_product_id,cart_product_name:cart_product_name,
					cart_product_image:cart_product_image,cart_product_price:cart_product_price,
					cart_product_qty:cart_product_qty,_token:_token},
					success:function(data){
						swal({
  							title: "Đã thêm vào giỏ hàng",
  							text: "Mua tiếp hoặc thanh toán",
  							showCancelButton: true,
  							confirmButtonClass: "btn-success",
  							confirmButtonText: "Đi đến giỏ hàng",
							cancelButtonText: "Xem tiếp",
  							closeOnConfirm: false
						},
						function(){
  							window.location.href= "{{url('/gio-hang')}}";
						});
					}
				});
			});
		});
	
	</script>

	{{-- <script type="text/javascript">
		swal("Here's a message!")
	</script> --}}
</body>

</html>