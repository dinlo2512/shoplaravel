<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();


class CartController extends Controller
{
    public function save_cart(Request $request)
    {

    	$productid = $request->productid_hidden;
    	$slg = $request->slg;
    	$product_info = DB::table('tbl_product')->where('product_id',$productid)->first();

    	// Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    	$data['id'] = $product_info->product_id;
    	$data['qty'] = $slg;
    	$data['name'] = $product_info->product_name;
    	$data['price'] = $product_info->product_prime;
    	$data['weight'] = '123';
    	$data['options']['image'] = $product_info->product_pic;

    	Cart::add($data);


    	return Redirect::to('/show-cart');

    }

    /**
     * add to Cart auto 1
     * @param Request $request
     * @return RedirectResponse
     */
    public function saveCart(Request $request):RedirectResponse
    {

        $productid = $request->productid_hidden;
        $product_info = DB::table('tbl_product')->where('product_id',$productid)->first();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id'] = $product_info->product_id;
        $data['qty'] = 1;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_prime;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_pic;

        Cart::add($data);


        return Redirect::to('/show-cart');

    }

    public function show_cart(){
    	$cate_pro = DB::table('tbl_category_product')->where('category_stt','1')->orderby('category_id','desc')->get();
        $brand_pro = DB::table('tbl_brand_product')->where('brand_stt','1')->orderby('brand_id','desc')->get();
    	return view('pages.show_cart')->with('category',$cate_pro)->with('brand',$brand_pro);
    }
    public function delete_cart($rowId){
    	Cart::update($rowId,0);
    	return Redirect::to('/show-cart');
    }
    public function update_cart(Request $request){
    	$rowId = $request->rowId_cart;
    	$qty = $request->cart_quantity;
    	Cart::update($rowId,$qty);
    	return Redirect::to('/show-cart');
    }


}
