@extends('cart')
@section('content')

<section id="cart_items">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng
				  </li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
				$content = Cart::content();
				// echo "<pre>";
				// print_r($content);
				// echo "<pre>";
				 ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="50px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>ID: {{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price)}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart')}}" method="post">
										{{csrf_field()}}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}">
									<input type="submit" name="update_slg" value="Cập nhật" class="btn btn-default btn-sm">
									<input type="hidden" name="rowId_cart" value="{{$v_content->rowId}}" class="form-control">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
										$subtotal = $v_content->price * $v_content->qty;
										echo number_format($subtotal);
										Cart::setGlobalTax(0);


									 ?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

</section> <!--/#cart_items-->
	<section id="do_action">

			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>

							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>

							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền <span><?php echo Cart::Subtotal(0); ?></span></li>
							<li>Thuế <span>{{Cart::tax(0)}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total(0)}}</span></li>
						</ul>
							<!-- <a class="btn btn-default update" href="">Update</a> -->
							<?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if ($customer_id!=NULL && $shipping_id==NULL){
                            ?>
                                <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                            <?php
                                }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                ?>
                                <a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Thanh toán</a>
                                 <?php }else{ ?>
                                <a class="btn btn-default check_out" href="{{URL::to('/login-checkoutt')}}">Thanh toán</a>
                            <?php } ?>

					</div>
				</div>
			</div>

	</section><!--/#do_action-->



@endsection
