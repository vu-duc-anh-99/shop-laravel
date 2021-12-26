<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function checkLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            Redirect::to("/dashboard");
        } else {
            Redirect::to("/admin")->send();
        }
    }
    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard()
    {
        $admin = new Admin();
        $listData = $admin->listAdmin();
        return view('admin.dashboard')->with(['admin' => $listData['data'], 'listRoles' => $listData['listRoles']]);
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $admin = new Admin();
        $result = $admin->dashboard($admin_email, $admin_password);
        if ($result) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    public function register_view()
    {
        return view('admin_register');
    }
    public function edit_form($admin_id)
    {
        $admin = new Admin();
        $data = $admin->findById($admin_id);
        return view('admin.edit_admin')->with(['admin' => $data['admin'], 'listRoles' => $data['listRoles']]);
    }
    public function update_user(Request $request, $admin_id)
    {
        $data = $request->all();
        $data['author'] = $request->author;
        $data['admin'] = $request->admin;
        $admin = new Admin();
        $admin->update_user($data, $admin_id);
        return Redirect::to('/dashboard');
    }
    public function register(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|max:255',
            'admin_password' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_phone' => 'required|max:255'
        ]);
        $data = $request->all();
        $admin = new Admin();
        $admin->register($data);
        return redirect('/register');
    }
    public function delete_user($admin_id)
    {
        $admin = new Admin();
        $admin->delete_user($admin_id);
        return redirect()->back();
    }
}
