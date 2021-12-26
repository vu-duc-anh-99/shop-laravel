<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'category_id',
        'brand_id',
        'product_name',
        'product_desc',
        'product_content',
        'product_price',
        'product_image',
        'product_status',
        'product_quantity'
    ];
    protected $primaryKey = "product_id";
    protected $table = "tbl_product";

    public function add_product()
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id', 'desc')->get();
        $list_data = array();
        $list_data['cate_product'] = $cate_product;
        $list_data['brand_product'] = $brand_product;
        return $list_data;
    }

    public function list_product($current_page)
    {

        $total_records = DB::table('tbl_product')->get();
        $total_records_count = count($total_records);
        $limit = 5;
        $start = ((int)$current_page - 1) * $limit;
        $list_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
            ->orderby('tbl_product.product_id', 'desc')->skip($start)->take($limit)->get();
        // $manager_product = view('admin.list_product')
        //                           -> with('list_product',$list_product);
        // return view('admin_layout')->with('admin.list_product',$manager_product);
        $total_page = ceil($total_records_count / $limit);

        $list_data = array();
        $list_data['list_product'] = $list_product;
        $list_data['current_page'] = $current_page;
        $list_data['total_page'] = $total_page;
        return $list_data;
    }
    public function save_product($data, $get_image)
    {
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->category_id = $data['category_id'];
        $product->product_quantity = $data['product_quantity'];
        $product->brand_id = $data['brand_id'];
        $product->product_content = $data['product_content'];
        $product->product_desc = $data['product_desc'];
        $product->product_status = $data['product_status'];

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();

            //get first string before . 
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();

            $get_image->move("public/uploads/product", $new_image);

            $product->product_image = $new_image;
        }

        $product->save();
        Session::put('message', "Thêm sản phẩm thành công");
    }

    public function actived_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)
            ->update(['product_status' => 0]);
    }

    public function not_actived_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)
            ->update(['product_status' => 1]);
    }

    public function edit_product($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id', 'desc')->get();
        $edit_product = DB::table('tbl_product')->where('tbl_product.product_id', $product_id)->get();

        $list_data = array();
        $list_data['cate_product'] = $cate_product;
        $list_data['brand_product'] = $brand_product;
        $list_data['edit_product'] = $edit_product;
        return $list_data;
    }


    public function update_product($data, $product_id, $get_image)
    {
        $product = Product::find($product_id);
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->category_id = $data['category_id'];
        $product->product_quantity = $data['product_quantity'];
        $product->brand_id = $data['brand_id'];
        $product->product_content = $data['product_content'];
        $product->product_desc = $data['product_desc'];

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();

            //get first string before . 
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();

            $get_image->move("public/uploads/product", $new_image);
            $product->product_image = $new_image;
        }
        $product->save();
        Session::put('message', "Cập nhật sản phẩm thành công");
    }

    public function delete_product($product_id)
    {

        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', "Xóa thành công");
    }

    //Homapage function route
    public function product_detail($data, $product_id)
    {

        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', 1)->take(4)->get();
        $cate_list = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_list = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $product_detail = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->join('tbl_brand_product', 'tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->first();
        $relate_product =  DB::table('tbl_product')->where('category_id', $product_detail->category_id)
            ->where('product_id', "<>", $product_detail->product_id)->skip(0)->take(6)->get();
        $recomment_product =  DB::table('tbl_product')->where('brand_id', $product_detail->brand_id)
            ->where('product_id', "<>", $product_detail->product_id)->skip(0)->take(6)->get();

        $meta_desc = $product_detail->category_desc;
        $meta_keywords = $product_detail->meta_keywords;
        $meta_title = $product_detail->category_name;
     

        $list_data = array();
        $list_data['cate_product'] = $cate_list;
        $list_data['brand_product'] = $brand_list;
        $list_data['slider'] = $slider;
        $list_data['product_detail'] = $product_detail;
        $list_data['meta_desc'] = $meta_desc;
        $list_data['relate_product'] = $relate_product;
        $list_data['recomment_product'] = $recomment_product;
        $list_data['meta_keywords'] = $meta_keywords;
        $list_data['meta_title'] = $meta_title;
        
       
        return $list_data;
    }
}
