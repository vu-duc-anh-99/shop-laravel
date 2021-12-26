<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Session;
use DB;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    public function payment_option($request)
    {
        //insert payment method
        $data = array();
        $data['payment_option'] = $request['payment_option'];
       
        if ($data['payment_option']) {
            $data['payment_status'] =  "1";
            $payment_id = DB::table('tbl_payment')->insertGetId($data);

            //insert order method
            $order_data = array();
            $order_data['customer_id'] = Session::get('customer_id');
            $order_data['shipping_id'] = Session::get('shipping_id');
            $order_data['payment_id'] = $payment_id;
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
           
        } else {
            Session::put('message', "Vui lòng chọn hình thức thanh toán");
        }
    }

    public function manage_order()
    {
        $total_records = DB::table('tbl_order')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $current_page = 1;
        $total_page = ceil($total_records_count / $limit);
        $list_orders = DB::table('tbl_order')->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*')
            ->orderby('tbl_order.order_id', 'desc')->skip(0)->take($limit)->get();
        $list_data = array();
        $list_data['list_orders'] = $list_orders;
        $list_data['current_page'] = $current_page;
        $list_data['total_page'] = $total_page;
        return $list_data;
    }

    public function page($current_page)
    {
        $total_records = DB::table('tbl_order')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $start = ((int)$current_page - 1) * $limit;
        $total_page = ceil($total_records_count / $limit);
        $list_orders = DB::table('tbl_order')->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*')
            ->orderby('tbl_order.order_id', 'desc')->skip($start)->take($limit)->get();

        $list_data = array();
        $list_data['list_orders'] = $list_orders;
        $list_data['current_page'] = $current_page;
        $list_data['total_page'] = $total_page;
        return $list_data;
    }

    public function delete_order($order_id)
    {
        $payment_id = DB::table('tbl_order')->where('order_id', $order_id)->select('tbl_order.payment_id')->first();
        $shipping_id = DB::table('tbl_order')->where('order_id', $order_id)->select('tbl_order.shipping_id')->first();
        DB::table('tbl_order')->where('order_id', $order_id)->delete();
        DB::table('tbl_order_details')->where('order_id', $order_id)->delete();
        DB::table('tbl_shipping')->where('tbl_shipping.shipping_id', $shipping_id->shipping_id)->delete();
        DB::table('tbl_payment')->where('tbl_payment.payment_id', $payment_id->payment_id)->delete();
    }

    public function view_order_detail($order_id)
    {
        
        $order_by_id = DB::table('tbl_order')->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*')
            ->where('tbl_order.order_id', $order_id)->first();
        $list_product_order = DB::table('tbl_order_details')->join('tbl_order', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
            ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
            ->select('tbl_order.*', 'tbl_order_details.*', 'tbl_product.product_id', DB::raw('tbl_product.product_quantity as product_qty'))
            ->where('tbl_order_details.order_id', $order_id)->get();

        $list_data = array();
       
        $list_data['order_by_id'] = $order_by_id;
        $list_data['list_product_order'] = $list_product_order;
        return $list_data;
    }
}
