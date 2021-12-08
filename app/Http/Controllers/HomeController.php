<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    /**
     * show new home page product..
     * @return View
     */
    public function index():View
    {
    	$cate_pro = DB::table('tbl_category_product')->where('category_stt','1')->orderby('category_id','desc')->get();
    	$brand_pro = DB::table('tbl_brand_product')->where('brand_stt','1')->orderby('brand_id','desc')->get();
    	$pro = DB::table('tbl_product')->where('product_stt','1')->orderby('product_id','desc')->limit(6)->get();

    	return view('pages.home')->with('category',$cate_pro)->with('brand',$brand_pro)->with('all_product',$pro);
    }

   /**
     * show all home page product...
     * @return View
     */
    public function allProduct():View
    {
        $cate_pro = DB::table('tbl_category_product')->where('category_stt','1')->orderby('category_id','desc')->get();
        $brand_pro = DB::table('tbl_brand_product')->where('brand_stt','1')->orderby('brand_id','desc')->get();
        $pro = DB::table('tbl_product')->where('product_stt','1')->orderby('product_id','desc')->get();

        return view('pages.home_all_product')->with('category',$cate_pro)->with('brand',$brand_pro)->with('all_product',$pro);
    }

    /**
     * login customer return to home
     * @param Request $request
     * @return RedirectResponse
     */
        public function login_customer(Request $request):RedirectResponse
        {
    	$customer_name = $request->login_customer;
    	$customer_password =$request->login_password;

    	$result = DB::table('tbl_customer')->where('customer_name',$customer_name)->where('customer_password',$customer_password)->first();
    	if ($result) {
            Session::put('customer_name',$result->customer_name);
            Session::put('customer_id',$result->customer_id);

            return Redirect::to('/');
        }else {
            Session::put('message','Mật khẩu hoặc Tài khoản không chính xác!');
            return Redirect::to('/login-checkout');
        }
    }

    /**
     * login customer return to show-cart
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginCustomer(Request $request):RedirectResponse
    {
        $customer_name = $request->login_customer;
        $customer_password =$request->login_password;

        $result = DB::table('tbl_customer')->where('customer_name',$customer_name)->where('customer_password',$customer_password)->first();
        if ($result) {
            Session::put('customer_name',$result->customer_name);
            Session::put('customer_id',$result->customer_id);

            return Redirect::to('/show-cart');
        }else {
            Session::put('message','Mật khẩu hoặc Tài khoản không chính xác!');
            return Redirect::to('/login-checkout');
        }
    }


    /**
     * Logout customer
     * @return RedirectResponse
     */
    public function logout():RedirectResponse
    {
        Session::put('customer_name',NULL);
        Session::put('customer_id',NULL);
        Session::put('shipping_id',NULL);
        return Redirect::to('/');
    }

    public function search(Request $request):View
    {
        $keyword = $request->keyword_submit;
        $cate_pro = DB::table('tbl_category_product')->where('category_stt','1')
            ->orderby('category_id','desc')->get();
        $brand_pro = DB::table('tbl_brand_product')->where('brand_stt','1')->orderby('brand_id','desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();

        return view('pages.search')->with('category',$cate_pro)->with('brand',$brand_pro)->with('search_product',$search_product);
    }
}
