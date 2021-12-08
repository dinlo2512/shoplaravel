<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;

session_start();


class CheckController extends Controller
{
    public function login_checkout()
    {
        return view('pages.checkout.login_checkout');
    }

    /**
     * login checkout in show-cart
     * @return View
     */
    public function loginCheckout(): View
    {
        return view('pages.checkout.login_checkoutt');
    }

    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addCustomer(Request $request):RedirectResponse
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_password'] = $request->customer_password;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        session::put('customer_id', $customer_id);
        session::put('customer_name', $request->customer_name);


        return Redirect::to('/show-cart');
    }

    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_password'] = $request->customer_password;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        session::put('customer_id', $customer_id);
        session::put('customer_name', $request->customer_name);


        return Redirect('/');
    }

    public function checkout()
    {
        return view('pages.checkout.show_checkout');
    }

    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;


        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        session::put('shipping_id', $shipping_id);


        return Redirect('/payment');
    }

    public function payment(): View
    {
        $cate_pro = DB::table('tbl_category_product')->where('category_stt', '1')->orderby('category_id', 'desc')->get();
        $brand_pro = DB::table('tbl_brand_product')->where('brand_stt', '1')->orderby('brand_id', 'desc')->get();

        return view('pages.checkout.payment');
    }

    public function orderPlace(Request $request)
    {
        //$c = Cart::content();
        //echo $c; lấy thông tin của sản phẩm trong giỏ hàng
        //insert tbl_payment
        $data = array();
        $data['payment_menthod'] = $request->payment_option;
        $data['payment_stt'] = 'Đang chờ thanh toán';
        $payment_id = DB::table('tbl_payment')->insertGetId($data); 

        //insert tbl_order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total(0);
        $order_data['order_stt'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert tbl_order_detail
        $content = Cart::content();
        foreach ($content as $value) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $value->id ;
            $order_d_data['product_name'] = $value->name;
            $order_d_data['product_prime'] = $value->price;
            $order_d_data['product_sales_qty'] = $value->qty;
            DB::table('tbl_order_detail')->insert($order_d_data);
        }
        if($data['payment_menthod'] == 1){
            Cart::destroy();
            echo 'Trả thẻ ATM';



        }
        if ($data['payment_menthod'] == 2) 
        {
            Cart::destroy();
            return Redirect::to('/end');


        }

    }
    public function end(){
         return view('pages.order-place');
    }

}
