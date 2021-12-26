<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        $customer = new Customer();
        $customer->register($data);
        return Redirect::to('/login-checkout');
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $customer = new Customer();
        $list_data = $customer->login($data);
        if ($list_data) {
            return Redirect::to('/');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    public function checkout()
    {
        $customer = new Customer();
        $list_data = $customer->checkout();
        return view("pages.checkout.checkout")->with(compact('list_data'));
    }

    public function save_checkout_customer(Request $request)
    {
        $data = $request->all();
        $customer = new Customer();
        $check = $customer->save_checkout_customer($data);

        if ($check == true) {
            return Redirect::to("/");
        } else {
            return Redirect::to("/checkout");
        }
    }

    public function logout()
    {
        Session::flush();
        return Redirect::to('/');
    }

    public function payment()
    {
        return view("pages.checkout.payment");
    }
    public function account()
    {

        return view("pages.customer.account");
    }
    public function change_password(Request $request)
    {

        $data = $request->all();
        $customer = new Customer();
        $customer->change_password($data);
        return view("pages.customer.account");
    }
}
