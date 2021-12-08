@extends('admin_layout')<!-- thừa kế từ admin_layout -->
@section('admin_content')<!-- hiển thị ở @yield('admin_content') -->
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="product_name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="product_prime">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="product_pic">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none;" rows="5" class="form-control" id="exampleInputPassword1" name="product_desc"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none;" rows="5" class="form-control" id="exampleInputPassword1" name="product_content"></textarea>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                    <select name="brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_pro as $key => $brand )
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                    <select name="category" class="form-control input-sm m-bot15">
                                        @foreach($cate_pro as $key => $cate )
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select name="product_stt" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn danh mục</option>
                                        <option value="1">Hiển thị danh mục</option>
                                        
                                    </select>
                                </div>
                              
                            
                                <button type="submit" name="add-product" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection