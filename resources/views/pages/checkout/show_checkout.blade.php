@extends('home_login')
@section('content')
<section id="cart_items">
		<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng
				  </li>
				</ol>
			</div>
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Thông tin gửi hàng</p>
							<div class="form-one" >
								<form action="{{URL::to('/save-checkout-customer')}}" method="post">
									{{csrf_field()}}
									<input type="text" name="shipping_email" placeholder="Email*" required>
									<input type="text" name="shipping_name" placeholder="Họ tên *" required>
									<input type="text" name="shipping_address" placeholder="Địa chỉ *" required>
									<input type="text" name="shipping_phone" placeholder="Số điện thoại" required>

									<textarea name="shipping_notes"  placeholder="Ghi chú đơn hàng cho shipper của bạn" rows="16"></textarea>
									<input type="submit" name="send_order" class="btn btn-primary btn-sm" value="Gửi">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>


			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->



@endsection
