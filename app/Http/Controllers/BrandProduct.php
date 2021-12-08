<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class BrandProduct extends Controller
{
    public function authLogin(): RedirectResponse
    {
        $admin_id = session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product(): View
    {
        $this->authLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product()
    {
        $this->authLogin();
//        $all_brand_product = DB::table('tbl_brand_product')->get();//lấy dữ liệu từ database
//        $all_brand_product = Brand::orderBy('brand_id','DESC')->get(); //lấy dữ liệu có sắp xếp
        $all_brand_product = Brand::all();                        //lấy toàn bộ dữ liệu
        $manager_category = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);//gán biến lấy dữ liệu
        return view('admin_layout')->with('admin.all_brand_product', $manager_category);
    }

    public function save_brand_product(Request $request)
    {
        $this->authLogin();
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_stt = $data['brand_product_stt'];
        $brand->save();



//        $data = array();
//        $data['brand_name'] = $request->brand_product_name;
//        $data['brand_desc'] = $request->brand_product_desc;
//        $data['brand_stt'] = $request->brand_product_stt;
//        DB::table('tbl_brand_product')->insert($data);
        Session::put('message', 'Thêm thương hiệu thành công');
        return Redirect::to('add-brand-product');
    }

    /**
     * @param int $brand_id
     * @return RedirectResponse
     */

    public function unactive_brand_product(int $brand_id): RedirectResponse
    {
        $this->authLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update(['brand_stt' => 0]);
        Session::put('message', 'không kích hoạt thành công');

        return Redirect::to('all-brand-product');

    }

    public function active_brand_product(int $brand_id): RedirectResponse
    {
        $this->authLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update(['brand_stt' => 1]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_id): View
    {
        $this->authLogin();
//        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id', $brand_id)->get();

        $edit_brand_product = Brand::where('brand_id', $brand_id)->get();  //dùng where sử dụng foreach
//        $edit_brand_product = Brand::find($brand_id);                     //dùng find không sử dung foreach
        $manager_category = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_category);
    }

    //cập nhật
    public function update_brand_product(Request $request, $brand_id): RedirectResponse
    {
        $this->authLogin();
        $data = $request->all();
        $brand = Brand::find($brand_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->save();


//        $data = array();
//        $data['brand_name'] = $request->brand_product_name;
//        $data['brand_desc'] = $request->brand_product_desc;
//        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update($data);
        Session::put('message', 'Cập nhật thành công');
        return Redirect::to('all-brand-product');
    }

    //xóa
    public function delete_brand_product($brand_id): RedirectResponse
    {
        $this->authLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->delete();
        Session::put('message', 'Xóa thành công');
        return Redirect::to('all-brand-product');
    }

//end admin
    public function show_brand($brand_id): View
    {
        $cate_pro = DB::table('tbl_category_product')->where('category_stt', '1')->orderby('category_id', 'desc')->get();
        $brand_pro = DB::table('tbl_brand_product')->where('brand_stt', '1')->orderby('brand_id', 'desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')->where('tbl_product.brand_id', $brand_id)->where('tbl_product.product_stt', '1')->get();
        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category', $cate_pro)->with('brand', $brand_pro)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }
}
