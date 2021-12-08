<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
{
    //Admin
     public function authLogin(){
        $admin_id = session::get('admin_id');
        if ($admin_id){
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->authLogin();
    	return view('admin.add_category_product');
    }
    //Hiển thị dữ liệu được chọn từ database
    public function all_category_product(){
        $this->authLogin();
        $all_category_product = DB::table('tbl_category_product')->get();//lấy dữ liệu từ database
        $manager_category = view('admin.all_category_product')->with('all_category_product', $all_category_product);//gán biến lấy dữ liệu 
    	return view('admin_layout')->with('admin.all_category_product', $manager_category);
    }
    //Lấy dữ liệu nhập vào từ form rồi đưa vào đúng hàng trong database
    public function save_category_product(Request $request){
        $this->authLogin();
    	$data = array();
    	$data['category_name'] = $request->category_product_name;
    	$data['category_desc'] = $request->category_product_desc;
    	$data['category_stt'] = $request->category_product_stt;

    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Thêm danh mục thành công');
    	return Redirect::to('add-category-product');
    }
    //hàm ẩn /hiển thị sản phẩm qua category_id
    public function unactive_category_product($category_id){
        $this->authLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_stt'=>0]);
        Session::put('message','không kích hoạt sản phẩm thành công');
        return Redirect::to('all-category-product');

    }

    public function active_category_product($category_id){
        $this->authLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_stt'=>1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    //sửa
    public function edit_category_product($category_id){
        $this->authLogin();
         $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_id)->get();
        $manager_category = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category);
    }
    //cập nhật
    public function update_category_product(Request $request,$category_id){
        $this->authLogin();
       $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    //xóa 
    public function delete_category_product($category_id){
        $this->authLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
//End for Admin
    public function show_category($category_id){
      $cate_pro = DB::table('tbl_category_product')->where('category_stt','1')->orderby('category_id','desc')->get();
        $brand_pro = DB::table('tbl_brand_product')->where('brand_stt','1')->orderby('brand_id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->where('tbl_product.product_stt','1')->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category',$cate_pro)->with('brand',$brand_pro)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
}
