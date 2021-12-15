@extends('admin_layout')
@section('admin_content')
    <div class="content">
        <form action="" method="" enctype="multipart/form-data">
            <div class="main">
                <div class="row">
                    <div class="col-md-4 mt-1 setting-menu">
                        <a href="{{URL::to('/setting-user-profile')}}"><i class="fa fa-user"></i><h5>Quản lý tài
                                khoản</h5></a>
                        <hr>
                        <a href="{{URL::to('/password-user-profile')}}"><i class="fa fa-lock"></i><h5>Đổi mật khẩu</h5>
                        </a>
                        <hr>
                    </div>
                    <div class="col-md-8 mt-1">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="wapper">
                                    <input class="img-file" type="file">
                                </div>
                                <div class="mt-3">
                                    <h3 class="username">
                                    <?php
                                        $name = Session::get('admin_name');
                                        if ($name) {
                                            echo $name;
                                        }
                                        ?>
                                    </h3>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 ">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Họ và tên: </h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="text" value="{{$admin_profile->admin_name}}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Điện thoại: </h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="text" value="">
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <input type="submit" value="Lưu">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <style>
        .wapper {
            height: 150px;
            width: 150px;
            position: relative;
            border: 5px solid #fff;
            border-radius: 50%;
            left: 41%;
            background-image: url("public/backend/images/2.png");
            background-size: 100% 100%;
            overflow: hidden;
        }

        .img-file {
            position: absolute;
            bottom: 0;
            outline: none;
            color: transparent;
            width: 100%;
            box-sizing: border-box;
            cursor: pointer;
            transition: 0.5s;
            left: 2px;
            background: rgba(0, 0, 0, 0.5);
            padding-left: 43px;
            opacity: 0;
        }

        .img-file:hover {
            opacity: 1;
        }

        .img-file::-webkit-file-upload-button {
            visibility: hidden;
        }

        .img-file::before {
            font-family: "Font Awesome 5 Pro";
            content: "\f030";
            font-size: 50px;
            color: #FFF;
            display: inline-block;
            -webkit-user-select: none;

        }

        input[type='text'] {
            width: 320px;
        }

        input[type='password'] {
            width: 320px;
        }

        input[type='submit'] {
            background: #2091E9;
            width: 72px;
            padding: 8px;
            border-radius: 10px;
            margin-left: 18px;
        }

        .setting-menu a {
            text-decoration: none;
            color: #212529;
            margin: 10px 20px;
        }

        .setting-menu h5 {
            display: inline-block;
            padding-left: 10px;
        }
    </style>
@endsection
