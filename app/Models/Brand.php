<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Session;
use DB;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'brand_name','brand_desc','brand_status'
    ];
    protected $primaryKey = "brand_id";
    protected $table = "tbl_brand_product";
    
    public function list_brand_product()
    {
        $total_records = DB::table('tbl_brand_product')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $current_page = 1;
        $total_page = ceil($total_records_count / $limit);
        $list_brand_product = DB::table('tbl_brand_product')->skip(0)->take($limit)->get();

        $list_data = array();
        $list_data['list_brand_product']= $list_brand_product;
        $list_data['total_page']= $total_page;
        $list_data['current_page']= $current_page;
        return $list_data;
    }
    public function page($current_page)
    {
        $total_records = DB::table('tbl_brand_product')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $total_page = ceil($total_records_count / $limit);
        $start = ((int)$current_page - 1) * $limit;

        $list_brand_product = DB::table('tbl_brand_product')->skip($start)->take($limit)->get();
        
        $list_data = array();
        $list_data['list_brand_product']= $list_brand_product;
        $list_data['total_page']= $total_page;
        $list_data['current_page']= $current_page;
        return $list_data;
    }
    public function save_brand_product($data)
    {
        $this->brand_name = $data['brand_product_name'];
        $this->brand_desc = $data['brand_product_desc'];
        $this->brand_status = $data['brand_product_status'];
        $this->save();
        Session::put('message',"Thêm thương hiệu sản phẩm thành công");
    }
    public function actived_brand_product($brand_product_id)
    {
        $brand = Brand::find($brand_product_id);
        $brand->brand_status = 0;
        $brand->save();
        
    }
    public function not_actived_brand_product($brand_product_id)
    {
        $brand = Brand::find($brand_product_id);
        $brand->brand_status = 1;
        $brand->save();
    }
    public function edit_brand_product($brand_product_id)
    {
        // $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        $edit_brand_product = Brand::where("brand_id",$brand_product_id)->get();
       return $edit_brand_product;

    }
    public function update_brand_product($data, $brand_product_id)
    {
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->save();
        Session::put('message',"Cập nhật thành công");
       

    }
    public function delete_brand_product($brand_product_id)
    {
        $brand = Brand::find($brand_product_id);
        $brand->delete();
        Session::put('message',"Xóa thành công");
    }

    public function show_brand_home($brand_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product_by_brand_id = DB::table('tbl_product')->where('brand_id',$brand_id)->get();
        $brand_title =  DB::table('tbl_brand_product')->where('brand_id',$brand_id)->first();

        
        $list_data = array();
        $list_data['product_by_brand_id']= $product_by_brand_id;
        $list_data['category']= $cate_product;
        $list_data['brand']= $brand_product;
        $list_data['brand_title']= $brand_title;
        return $list_data;

    }

}
