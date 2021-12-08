@extends('welcome')
@section('content')
    @foreach($detail_product as $key => $value)
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{URL::to('public/uploads/product/'.$value->product_pic)}}" alt=""/>
                    <h3>ZOOM</h3>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt=""/>
                    <h2>{{($value->product_name)}}</h2>
                    <p>ID:{{($value->product_id)}}</p>
                    <img src="images/product-details/rating.png" alt=""/>
                    <form action="{{URL::to('/save-cart')}}" method="post">
                        {{csrf_field()}}
                        <span>
									<span>{{number_format($value->product_prime)}}</span>
									<label>Số lượng:</label>
									<input type="number" name="slg" min="1" value="1"/>
									<input type="hidden" name="productid_hidden" value="{{$value->product_id}}"/>
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
									Thêm vào giỏ hàng
									</button>
								</span>
                    </form>
                    <p><b>Tình trạng:</b>Còn hàng</p>
                    <p><b>Điều kiện:</b>Hàng mới</p>
                    <p><b>Thương hiệu:</b>{{($value->brand_name)}}</p>
                    <p><b>Danh mục:</b>{{($value->category_name)}}</p>
                    <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt=""/></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->
    @endforeach

    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">recommended items</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach($relate as $key => $relate)
                        <div class="col-sm-4">
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$relate->product_id)}}">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img style="height: 265px" src="{{URL::to('public/uploads/product/'.$relate->product_pic)}}" alt=""/>
                                        <h2>{{$relate->product_prime}}</h2>
                                        <p>{{$relate->product_name}}</p>
                                        <button type="button" class="btn btn-default add-to-cart">Ấn để xem chi tiết
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->
@endsection
