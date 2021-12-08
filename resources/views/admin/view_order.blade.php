@extends('admin_layout')<!-- thừa kế từ admin_layout -->
@section('admin_content')<!-- hiển thị ở @yield('admin_content') -->
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin người mua
        </div>

        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th>Tên người mua</th>
                    <th>Số điện thoại</th>

                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$order_by_id->customer_name}}</td>
                        <td>{{$order_by_id->customer_phone}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển
        </div>

        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>

                    <th>Tên người nhận</th>
                    <th>Điện thoại liên lạc</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th>Tổng tiền</th>
                    <th>Ghi chú đơn hàng</th>



                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$order_by_id->shipping_name}}</td>
                    <td>{{$order_by_id->shipping_phone}}</td>
                    <td>{{$order_by_id->shipping_address}}</td>
                    <td>{{$order_by_id->order_total}}</td>
                    <td>{{$order_by_id->shipping_notes}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Chi tiết đơn hàng
        </div>

        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                <tr>
                    <th style="width:20px;">
                        <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                        </label>
                    </th>
                    <th>Tên sản phẩm </th>
                    <th>Số lượng </th>
                    <th>Giá</th>
                    <th>Thành tiền</th>

                </tr>
                </thead>
                <tbody>
                @foreach($order_detail as $order)
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{$order->product_name}}</td>
                    <td>{{$order->product_sales_qty}}</td>
                    <td>{{$order->product_prime}}</td>
                    <td>{{$order->product_prime*$order->product_sales_qty}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection
