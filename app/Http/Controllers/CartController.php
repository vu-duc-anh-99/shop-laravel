<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
        $product_id = $request->product_id;
        $amount = $request->amount;
        $product_info = DB::table('tbl_product')->where("product_id",$product_id)->first();

        // $cate_list = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        // $brand_list = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id'] = $product_id;
        $data['qty'] = $amount;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = 0;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to("/show-cart");
        
    }

    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach ($cart as $key => $value) {
                if($value['product_id']== $data['cart_product_id']){
                    $is_avaiable++;
                }
                    
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id'=> $session_id,
                    'product_name'=>$data['cart_product_name'],
                    'product_id'=>$data['cart_product_id'],
                    'product_image'=>$data['cart_product_image'],
                    'product_qty'=>$data['cart_product_qty'],
                    'product_price'=>$data['cart_product_price']
                );
            }
            Session::put('cart',$cart);
        }else{
            $cart[] = array(
                'session_id'=> $session_id,
                'product_name'=>$data['cart_product_name'],
                'product_id'=>$data['cart_product_id'],
                'product_image'=>$data['cart_product_image'],
                'product_qty'=>$data['cart_product_qty'],
                'product_price'=>$data['cart_product_price']
            );
        }
        Session::put('cart',$cart);
        Session::save();
    }

    public function delete_cart_ajax($sessionId)
    {
        $cart = Session::get('cart');
        if($cart){
            foreach ($cart as $key => $value) {
                if($value['session_id'] == $sessionId){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return Redirect::to("/gio-hang")->with('message','Xóa sản phẩm thành công');
        }
        
    }
    public function delete_cart($product_id)
    {
        Cart::update($rowId,0);
        return Redirect::to("/show-cart");
    }
    public function show_cart()
    {
       return view("pages.cart.show_cart");
    }
    public function show_cart_ajax()
    {
       return view("pages.cart.show_cart_ajax");
    }
    public function update_cart(Request $request)
    {
        $qty = $request->quantity;
        $rowId = $request ->rowId_cart;
        Cart::update($rowId,$qty);
        return Redirect::to("/show-cart");
    }

    public function update_cart_ajax(Request $request)
    {
       $data = $request->all();
       $cart = Session::get('cart');
       if($cart){
           foreach ($data['quantity'] as $key => $qty) {
               foreach ($cart as $session_id => $value) {
                    if($value['session_id'] == $key){
                        $cart[$session_id]['product_qty']= $qty;
                    }
               }
           }
           Session::put('cart',$cart);
           return Redirect::to("/gio-hang")->with('message','Cập nhật thành công'); 
       }
    }
    public function check_coupon(Request $request)
    {
        # code...
    }
    
}
