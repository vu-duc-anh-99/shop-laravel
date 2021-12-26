<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Checkout;

class CheckOutController extends Controller
{
    public function login_checkout()
    {
        return view("pages.checkout.login_checkout");
    }

    public function payment_option(Request $request)
    {
        //insert payment method
        $data = $request->all();
        $checkout = new Checkout();
        $checkout->payment_option($data);
        $cart = Session::get('cart');
        if ($cart) {
            return Redirect::to("/payment");
        } else {
            return Redirect::to("/");
        }
    }

    public function manage_order()
    {
        $checkout = new Checkout();
        $list_data = $checkout->manage_order();
        // return view('admin.manage_order')->with(compact('list_orders', 'current_page', 'total_page'));

        return view('admin.manage_order')->with('list_orders', $list_data['list_orders'])->with('current_page', $list_data['current_page'])->with('total_page', $list_data['total_page']);
    }

    public function page($current_page)
    {

        $checkout = new Checkout();
        $list_data = $checkout->page($current_page);

        return view('admin.manage_order')->with('list_orders', $list_data['list_orders'])->with('current_page', $list_data['current_page'])->with('total_page', $list_data['total_page']);
    }

    public function delete_order($order_id)
    {
        $checkout = new Checkout();
        $checkout->delete_order($order_id);
        return Redirect::to("/manage-order");
    }

    public function view_order_detail($order_id)
    {
        $checkout = new Checkout();
        $list_data = $checkout->view_order_detail($order_id);
        return view('admin.view_order')->with('order', $list_data['order_by_id'])->with('list_product', $list_data['list_product_order']);
    }
}
