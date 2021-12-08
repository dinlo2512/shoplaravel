@extends('home_login')
@section('content')
<section id="form"><!--form-->
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<?php 
						$message = Session::get('message');
						if ($message) {
							echo '<span class="text-alert">',$message,'</span>';
							Session::put('message',null);
						}
						 ?>
							<form action="{{URL::to('/trang-chu')}}" method="post">
							{{csrf_field()}}
							<input type="text" name="login_customer" placeholder="Tên đăng nhập" />
							<input type="password"name="login_password" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Nhớ tài khoản
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí tài khoản!</h2>
						<form action="{{URL::to('/add-customer')}}" method="post">
							{{csrf_field()}}
							<input type="text" placeholder="Tên đăng nhập" name="customer_name" />
							<input type="email" placeholder="Email" name="customer_email"/>
							<input type="password" placeholder="Password" name="customer_password"/>
							<input type="text" placeholder="Điện thoại" name="customer_phone"/>
							<button type="submit" class="btn btn-default">Đăng kí</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
	</section><!--/form-->


@endsection