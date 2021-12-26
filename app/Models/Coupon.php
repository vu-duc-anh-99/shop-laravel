<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
class Coupon extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'coupon_code','coupon_times','coupon_number','coupon_type'
    ];
    protected $primaryKey = "coupon_id";
    protected $table = "tbl_coupon";


    public function save_coupon($data)
    {
       
        $coupon = new Coupon();
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_type = $data['coupon_type'];
        $coupon->save();

        Session::put('message',"Thêm mã giảm giá thành công");
      
    }

    public function list_coupon()
    {
        $total_records = DB::table('tbl_coupon')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $current_page = 1;
        $total_page = ceil($total_records_count / $limit);
        $list_coupon = Coupon::orderBy("coupon_id")->skip(0)->take($limit)->get();

        $list_data = array();
        $list_data['list_coupon'] = $list_coupon;
        $list_data['current_page'] = $current_page;
        $list_data['total_page'] = $total_page;
        
        return $list_data;
    }
    public function page($current_page)
    {   
        $total_records = DB::table('tbl_coupon')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $start = ((int)$current_page - 1) * $limit;
        $total_page = ceil($total_records_count / $limit);
        $list_coupon = Coupon::orderBy("coupon_id")->skip($start)->take($limit)->get();
       
        $list_data = array();
        $list_data['list_coupon'] = $list_coupon;
        $list_data['current_page'] = $current_page;
        $list_data['total_page'] = $total_page;
        
        return $list_data;
    }

    public function edit_coupon($data,$couponId)
    {
        $coupon = Coupon::find($couponId);
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_type = $data['coupon_type'];
        $coupon->save();
        Session::put('message',"Sửa mã giảm giá thành công");
        
    }

    public function find_coupon($couponId)
    {
        $coupon = Coupon::where('coupon_id',$couponId)->get();
        return $coupon;
    }

    public function check_coupon($data)
    {
        
        $coupon = Coupon::where('coupon_code',$data)->get();
        if($coupon->count()>0){
            Session::put('coupon',$coupon);
        }
        else{
            Session::put('coupon_message',"Mã giảm giá không hợp lệ");
        }
        
    }

    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id)->delete();
        Session::put('message',"Xóa sản phẩm thành công");
      
    }
}
