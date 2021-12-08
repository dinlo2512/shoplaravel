@extends('welcome')<!-- thừa kế từ welcome -->
@section('content')<!-- hiển thị ở @yield('content') -->
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach($search_product as $key => $product)

        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img style="height: 265px"  src="{{URL::to('public/uploads/product/'.$product->product_pic)}}" alt="" />
                    <!-- <h2>{{number_format((float)$product->product_prime)}}</h2>chỉnh giá tiền có ngăn cách bởi dấu , -->
                        <h2>{{$product->product_prime}}</h2>
                        <p>{{$product->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
                <a style="font-family: 'Roboto', sans-serif;font-size: 15px;margin-left: 60px;color: #696763;text-align: center;"
                   href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">>>Chi tiết sản phẩm<<</a>
            </div>
        </div>
    @endforeach




@endsection
