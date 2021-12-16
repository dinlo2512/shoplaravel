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

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
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
                    <tr>
                        <td class="cart_description"><h4>Tổng tiền</h4></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><p class="cart_total_price">{{Cart::total(0)}}</p></td>
                        <td></td>

                    </tr>
                </tbody>
            </table>
        </div>

        <h4 style="margin: 40px 0; font-size: 20px">Chọn phương thức thanh toán</h4>
        <form action="{{URL::to('/order-place')}}" method="post">
            {{csrf_field()}}
        <div class="payment-options">
            <h4></h4>
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
					</span>
            <span>
						<label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
					</span>
            <input type="submit" name="send_order" class="btn btn-primary btn-sm pull-right" value="Xác nhận">
        </div>
        </form>

    </section> <!--/#cart_items-->


    <script type="text/javascript">
        $('input[type="checkbox"]').on('change',function (){
            $('input[type="checkbox"]').not(this).prop('checked',false);
        });
    </script>
@endsection
