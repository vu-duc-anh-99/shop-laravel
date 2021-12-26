<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Session;
use DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'category_name', 'category_desc', 'category_status', 'meta_keywords', 'meta_desc'
    ];
    protected $primaryKey = "category_id";
    protected $table = "tbl_category_product";

    public function list_category_product()
    {

        $total_records = DB::table('tbl_category_product')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $current_page = 1;
        $total_page = ceil($total_records_count / $limit);
        $list_category_product = DB::table('tbl_category_product')->skip(0)->take($limit)->get();

        $list_data = array();
        $list_data['list_category_product'] = $list_category_product;
        $list_data['total_page'] = $total_page;
        $list_data['current_page'] = $current_page;
        return $list_data;
    }
    public function page($current_page)
    {
        $total_records = DB::table('tbl_category_product')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $total_page = ceil($total_records_count / $limit);
        $start = ((int)$current_page - 1) * $limit;
        $list_category_product = DB::table('tbl_category_product')->skip($start)->take($limit)->get();

        $list_data = array();
        $list_data['list_category_product'] = $list_category_product;
        $list_data['total_page'] = $total_page;
        $list_data['current_page'] = $current_page;
        return $list_data;
    }

    public function save_category_product($data)
    {

        $this->category_name = $data['category_product_name'];
        $this->category_desc = $data['category_product_desc'];
        $this->meta_keywords = $data['meta_keywords'];
        $this->category_status = $data['category_product_status'];
        $this->save();
        Session::put('message', "Thêm danh mục sản phẩm thành công");
    }

    public function actived_category_product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)
            ->update(['category_status' => 0]);
        
    }

    public function not_actived_category_product($category_product_id)
    {
        DB::table('tbl_category_product')->where('category_id', $category_product_id)
            ->update(['category_status' => 1]);
        
    }

    public function edit_category_product($category_product_id)
    {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();

        return $edit_category_product;
    }

    public function update_category_product($data, $category_product_id)
    {
        $category = Category::find($category_product_id);
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->meta_keywords = $data['meta_keywords'];
        $category->save();
        Session::put('message', "Cập nhật thành công");
    }

    public function delete_category_product($category_product_id)
    {

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', "Xóa thành công");
        
    }

    public function show_category_home($category_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $product_by_category_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->where('tbl_product.category_id', $category_id)
            ->get();
        $category_title =  DB::table('tbl_category_product')->where('category_id', $category_id)->first();

        $list_data = array();
        $list_data['list_category_product'] = $cate_product;
        $list_data['list_brand_product'] = $brand_product;
        $list_data['product_by_catetory'] = $product_by_category_id;
        $list_data['category_title'] = $category_title;
        return $list_data;
        // foreach ($product_by_category_id as $item) {
        //     $meta_desc = $item->category_desc;
        //     $meta_keywords = $item->meta_keywords;
        //     $meta_title = $item->category_name;
        //     $meta_url = $request->url();
        // }

        // return view('pages.category.show_category',["category"=>$cate_product,"brand"=>$brand_product,'list_product'=>$product_by_category_id,"meta_desc"=>$meta_desc,
        //             "meta_keywords"=>$meta_keywords, "meta_title"=>$meta_title, "meta_url"=>$meta_url
        //             ]);  

        
    }
}
