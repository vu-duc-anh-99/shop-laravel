<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;
use Session;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    public $timestamps = false;
    protected $fillable = [
        'admin_id', 'admin_email', 'admin_password', 'admin_name', 'admin_phone'
    ];
    protected $primaryKey = "admin_id";
    protected $table = "tbl_admin";

    public function dashboard($admin_email, $admin_password)
    {

        $result = false;
        if (Auth::attempt(['admin_email' => $admin_email, 'admin_password' => $admin_password])) {
            Session::put('admin_name', Auth::user()->admin_name);
            Session::put('admin_id', Auth::user()->admin_id);
            $result = true;
        } else {
            Session::put('message', "Tài khoản hoặc mật khẩu không đúng");
        }
        return $result;
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Roles');
    }

    public function listAdmin()
    {
        $data = Admin::all();
        $listRoles = DB::table('tbl_roles')->get();
        $listData = array();
        $listData['data'] = $data;
        $listData['listRoles'] = $listRoles;
        return $listData;
    }

    public function register($data)
    {
        $admin = new Admin();
        $admin->admin_name =  $data['admin_name'];
        $admin->admin_email =  $data['admin_email'];
        // $admin->admin_password =  md5($data['admin_password']);
        $admin->admin_password = $data['admin_password'];
        $admin->admin_phone =  $data['admin_phone'];
        $admin->save();
        Session::put('message', "Đăng ký thành công");
    }
    public function findById($admin_id)
    {
        $admin = Admin::where("admin_id", $admin_id)->get();
        $listRoles = DB::table('tbl_roles')->get();
        $listData = array();
        $listData['admin'] = $admin;
        $listData['listRoles'] = $listRoles;
        return $listData;
    }
    public function update_user($data, $admin_id)
    {
        $admin = Admin::find($admin_id);

        $admin->roles()->detach();
        if ($data['author']) {
            $admin->roles()->attach(Roles::where('role_name', 'author')->first());
        }
        if ($data['admin']) {
            $admin->roles()->attach(Roles::where('role_name', 'admin')->first());
        }
        $admin->save();
        Session::put('message', 'Cập nhật thành công');
    }
    public function delete_user($admin_id)
    {
        if (Auth::id() == $admin_id) {
            Session::put('message', "Không được phép xóa chính mình");
        } else {
            $admin = Admin::find($admin_id);
            $admin->roles()->detach();
            $admin->delete();
            Session::put('message', "Xóa thành công");
        }
    }
    public function getAuthPassword()
    {
        return $this->admin_password;
    }
    public function hasAnyRoles($role)
    {
        if ($this->roles()->whereIn('role_name', $role)->first()) {
            return true;
        } else
            return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('role_name', $role)->first()) {
            return true;
        } else
            return false;
    }
}
