<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DB;
use Illuminate\View\View;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function authLogin(): RedirectResponse
    {
        $admin_id = session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin_login');
    }

    public function show_dashboard(): View
    {
        $this->authLogin();
        return view('admin.dashboard');
    }

    // function và điều kiện login, lấy dữ liệu từ database
    public function dashboard(Request $request): RedirectResponse
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Mật khẩu hoặc Tài khoản không chính xác!');
            return Redirect::to('/admin');
        }
    }

    public function logout(): RedirectResponse
    {
        $this->authLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }

    public function manageOrder():View
    {
        $this->authLogin();
        $all_order = DB::table('tbl_order')//lấy dữ liệu từ database
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name')
            ->orderby('tbl_order.order_id', 'desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);//gán biến lấy dữ liệu
        return view('admin_layout')->with('admin.manage_order', $manager_order);

    }

    public function viewOrder($orderId):View
    {
        $this->authLogin();
        $order_by_id = DB::table('tbl_order')//lấy dữ liệu từ database
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->select('tbl_order.*', 'tbl_customer.*','tbl_shipping.*')
            ->first();

        $order_detail = DB::table('tbl_order')//lấy dữ liệu từ database
        ->join('tbl_order_detail', 'tbl_order.order_id', '=', 'tbl_order_detail.order_id')
            ->select('tbl_order.*','tbl_order_detail.*')
            ->orderby('tbl_order.order_id','desc')->get();
        $manager_order_id = view('admin.view_order')->with('order_by_id', $order_by_id)->with('order_detail',$order_detail);

        return view('admin_layout')->with('admin.view_order',$manager_order_id);
    }
}
