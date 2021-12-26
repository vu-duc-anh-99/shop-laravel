<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function update_order_qty(Request $request)
    {
        $data = $request->all();
        //update order status
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        if ($order->order_status == 2) {
            // 0=> product_id = 2 , 1=> product_id = 5 , ...
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                // 0=> quantity = 2 , 1=> quantity = 5 , ...
                foreach ($data['quantity'] as $key_qty => $quantity) {
                    if ($key == $key_qty) {
                        $product_quantity -= $quantity;
                        $product->product_quantity = $product_quantity;
                        $product->save();
                    }
                }
            }
        } elseif ($order->order_status == 1) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                // 0=> quantity = 2 , 1=> quantity = 5 , ...
                foreach ($data['quantity'] as $key_qty => $quantity) {
                    if ($key == $key_qty) {
                        $product_quantity += $quantity;
                        $product->product_quantity = $product_quantity;
                        $product->save();
                    }
                }
            }
        } elseif ($order->order_status == 3) {
            $payment_id = DB::table('tbl_order')->where('order_id', $data['order_id'])->select('tbl_order.payment_id')->first();
            $shipping_id = DB::table('tbl_order')->where('order_id', $data['order_id'])->select('tbl_order.shipping_id')->first();
            DB::table('tbl_order')->where('order_id', $data['order_id'])->delete();
            DB::table('tbl_order_details')->where('order_id', $data['order_id'])->delete();
            DB::table('tbl_shipping')->where('tbl_shipping.shipping_id', $shipping_id->shipping_id)->delete();
            DB::table('tbl_payment')->where('tbl_payment.payment_id', $payment_id->payment_id)->delete();
        }
    }
}
