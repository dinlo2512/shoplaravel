<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class Product extends Controller
{
    public function authLogin(){
        $admin_id = session::get('admin_id');
        if ($admin_id){
            return Redirect::to('dashboard');
        }else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
         $this->authLogin();
    	$cate_pro = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    	$brand_pro = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

    	return view('admin.add_product')->with('cate_pro',$cate_pro)->with('brand_pro',$brand_pro);
    }
    public function save_product(Request $request){
         $this->authLogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_prime'] = $request->product_prime;
    	$data['product_desc'] = $request->product_desc;
    	$data['product_content'] = $request->product_content;
    	$data['category_id'] = $request->category;
    	$data['brand_id'] = $request->brand;
    	$data['product_stt'] = $request->product_stt;

    	$get_img = $request->file('product_pic');
    	if($get_img) {
    		$get_name_img = $get_img->getClientOriginalName();//hàm lấy tên gốc của ảnh
    		$name_img = current(explode('.',$get_name_img));//hàm phân tách chuỗi từ dấu . 
    		$new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();//hàm lấy đuôi mở rộng 
    		$get_img->move('public/uploads/product',$new_img);//di chuyển ảnh uploads vào folder
    		$data['product_pic'] = $new_img;
    		DB::table('tbl_product')->insert($data);
	    	Session::put('message','Thêm sản phẩm thành công');
	    	return Redirect::to('add-product');
    	}
    	$data['product_pic'] = '';
    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('add-product');
    }
    public function edit_product($product_id){
         $this->authLogin();
        $cate_pro = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_pro = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
         $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_category = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_pro',$cate_pro)
        ->with('brand_pro',$brand_pro);
        return view('admin_layout')->with('admin.edit_product', $manager_category);
    }
      public function all_product(){
         $this->authLogin();
        $all_product = DB::table('tbl_product')//lấy dữ liệu từ database
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')//lấy category_id từ bảng category
        ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_category = view('admin.all_product')->with('all_product', $all_product);//gán biến lấy dữ liệu 
    	return view('admin_layout')->with('admin.all_brand_product', $manager_category);
    }
    public function unactive_product($product_id){
         $this->authLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_stt'=>0]);
        Session::put('message','không kích hoạt thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
         $this->authLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_stt'=>1]);
        Session::put('message','Kích hoạt thành công');
        return Redirect::to('all-product');
    }

     public function update_product(Request $request,$product_id){
         $this->authLogin();
       $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_prime'] = $request->product_prime;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;
       

       $get_img = $request->file('product_pic');
        if($get_img) {
            $get_name_img = $get_img->getClientOriginalName();//hàm lấy tên gốc của ảnh
            $name_img = current(explode('.',$get_name_img));//hàm phân tách chuỗi từ dấu . 
            $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();//hàm lấy đuôi mở rộng 
            $get_img->move('public/uploads/product',$new_img);//di chuyển ảnh uploads vào folder
            $data['product_pic'] = $new_img;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật phẩm thành công');
            return Redirect::to('all-product');
        }
        
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
         $this->authLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-product');
    }
//End admin
    public function detail_product($product_id){
         $cate_pro = DB::table('tbl_category_product')->where('category_stt','1')->orderby('category_id','desc')->get();
        $brand_pro = DB::table('tbl_brand_product')->where('brand_stt','1')->orderby('brand_id','desc')->get();

        $detail_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach ($detail_product as $key => $value) {
            $category_id = $value->category_id;
        }

         $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id', '=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->where('tbl_product.product_stt','1')->whereNotIn('tbl_product.product_id',[$product_id])->get();//Lấy ra các sản phẩm liên quan cùng một danh mục,trừ chính sản phẩm đang được chọn

        return view('pages.show_detail')->with('category',$cate_pro)->with('brand',$brand_pro)->with('detail_product',$detail_product)->with('relate',$related_product);
    }
}
