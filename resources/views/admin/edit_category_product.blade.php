@extends('admin_layout')<!-- thừa kế từ admin_layout -->
@section('admin_content')<!-- hiển thị ở @yield('admin_content') -->
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa danh mục sản phẩm
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
                                 @foreach($edit_category_product as $key => $edit_pro)
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_pro->category_id)}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$edit_pro->category_name}}" class="form-control" id="exampleInputEmail1" name="category_product_name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none;" rows="5" class="form-control" id="exampleInputPassword1" name="category_product_desc" >{{$edit_pro->category_desc}}</textarea>
                                </div>
                               
                                <button type="submit" name="update-category-product" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection