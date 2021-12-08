    @extends('admin_layout')<!-- thừa kế từ admin_layout -->
@section('admin_content')<!-- hiển thị ở @yield('admin_content') -->
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        <div class="panel-body">
                            <?php 
                            $message = Session::get('message');
                            if ($message) {
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                            ?>
                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="product_name" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="product_prime" value="{{$pro->product_prime}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="product_pic">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_pic)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none;" rows="5" class="form-control" id="exampleInputPassword1" name="product_desc">{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none;" rows="5" class="form-control" id="exampleInputPassword1" name="product_content">{{$pro->product_content}}</textarea>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select name="brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_pro as $key => $brand )
                                            @if($brand->brand_id == $pro->brand_id)
                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                    <select name="category" class="form-control input-sm m-bot15">
                                        @foreach($cate_pro as $key => $cate )
                                            @if($cate->category_id == $pro->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach
                                        
                                    </select>
                                </div>
                               
                              
                            
                                <button type="submit" name="add-product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection