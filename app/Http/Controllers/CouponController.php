<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller
{
    public function add_coupon(Request $request)
    {
        return view('admin.coupon.add_coupon');
    }
    public function save_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->save_coupon($data);
        return Redirect::to('/add-coupon');
    }

    public function list_coupon()
    {
        $coupon = new Coupon();
        $list_data = $coupon->list_coupon();
        $list_coupon = $list_data['list_coupon'];
        $current_page = $list_data['current_page'];
        $total_page = $list_data['total_page'];
        return view('admin.coupon.list_coupon')->with(compact('list_coupon', 'current_page', 'total_page'));
    }
    public function page($current_page)
    {
        $coupon = new Coupon();
        $list_data = $coupon->page($current_page);
        $list_coupon = $list_data['list_coupon'];
        $current_page = $list_data['current_page'];
        $total_page = $list_data['total_page'];

        return view('admin.coupon.list_coupon')->with(compact('list_coupon', 'current_page', 'total_page'));
    }

    public function edit_coupon(Request $request, $couponId)
    {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->edit_coupon($data,$couponId);
        return Redirect::to('/manage-coupon');
    }

    public function find_coupon($couponId)
    {
        $coupon = new Coupon();
        $list_data = $coupon->find_coupon($couponId);
        return view('admin.coupon.edit_coupon')->with('coupon', $list_data);
    }

    public function check_coupon(Request $request)
    {
        $data = $request->coupon_code;
        $coupon = new Coupon();
        $coupon->check_coupon($data);
       
        return view('pages.cart.show_cart_ajax');
    }

    public function delete_coupon($coupon_id)
    {
        $coupon = new Coupon();
        $coupon->delete_coupon($coupon_id);
       
        return Redirect::to('/manage-coupon');
    }
}
