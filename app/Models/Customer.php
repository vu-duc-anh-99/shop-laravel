<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;


class Customer extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'customer_name', 'customer_email', 'customer_password', 'customer_phone'
    ];
    protected $primaryKey = "customer_id";
    protected $table = "tbl_customer";

    public function register($data)
    {
        $customer = new Customer();
        $customer->customer_name =  $data['customer_name'];
        $customer->customer_email =  $data['customer_email'];
        $customer->customer_password =  md5($data['customer_password']);
        $customer->customer_phone =  $data['customer_phone'];
        $customer->save();
        $customerId = $customer->customer_id;
        Session::put('customer_id', $customerId);
        Session::put('customer_name', $data['customer_name']);
        Session::put('message-register', "Đăng ký thành công");
    }

    public function login($data)
    {
        $customer_email =  $data['customer_email'];
        $customer_password = md5($data['customer_password']);

        $customer = Customer::where('customer_email', $customer_email)->where('customer_password', $customer_password)->first();
        if ($customer) {
            Session::put('customer_id', $customer->customer_id);
            Session::put('customer_name', $customer->customer_name);
            return $customer;
        } else {
            Session::put('message', "Đăng nhập thất bại");
        }
    }

    public function checkout()
    {
        $customerId = Session::get('customer_id');
        $customer = Customer::where('customer_id', $customerId)->get();
        return $customer;
    }

    public function save_checkout_customer($data)
    {
        unset($data['_token']);
        $check = true;
        foreach ($data as $key => $value) {
            if ($value == "" || is_null($value)) {
                Session::put('message', "Vui lòng nhập đủ tất cả các trường");
                $check = false;
                break;
            }
        }
        if ($check == true) {
            $shippingId = DB::table('tbl_shipping')->insertGetId($data);
            $order_data = array();
            $order_data['customer_id'] = Session::get('customer_id');
            $shippingId = DB::table('tbl_shipping')->insertGetId($data);
            Session::put('shipping_id', $shippingId);
            $order_data['shipping_id'] = Session::get('shipping_id');
            $order_data['payment_id'] = 1;
            $order_data['order_total'] = Session::get('total');
            $order_data['order_status'] = "1";
            $order_id = DB::table('tbl_order')->insertGetId($order_data);

            //insert order details method
            $order_details_data = array();
            $content = Session::get('cart');

            foreach ($content as $value) {
                $order_details_data['order_id'] = $order_id;
                $order_details_data['product_id'] = $value['product_id'];
                $order_details_data['product_name'] = $value['product_name'];
                $order_details_data['product_price'] = $value['product_price'];
                $order_details_data['product_quantity'] = $value['product_qty'];
                DB::table('tbl_order_details')->insert($order_details_data);
            }
            Session::forget('cart');
            Session::forget('total');
            Session::forget('coupon');
        }
        return $check;
    }

    public function change_password($data)
    {
        $customer_id = Session::get('customer_id');
        $customer = Customer::find($customer_id);
        $old_password = $data['old_password'];
        $new_password = $data['new_password'];
        $new_password_confirm = $data['new_password_confirm'];
        if ($old_password && $new_password && $new_password_confirm) {
            if ($customer->customer_password == md5($old_password)) {
                if ($new_password == $new_password_confirm) {
                    $customer->customer_password = md5($new_password);
                    $customer->save();
                    Session::put('message', "Cập nhật thành công");
                } else {
                    Session::put('message', "Mật khẩu mới không đồng nhất");
                }
            } else {
                Session::put('message', "Mật khẩu cũ không chính xác");
            }
        } else {
            Session::put('message', "Mời nhập đủ tất cả các trường");
        }
    }
}
