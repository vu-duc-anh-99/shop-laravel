<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;
use App\Models\Product;

class ProductController extends Controller
{
    public function add_product()
    {
        $product = new Product();
        $list_data = $product->add_product();
        $cate_product = $list_data['cate_product'];
        $brand_product = $list_data['brand_product'];
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function list_product($current_page)
    {


        // $manager_product = view('admin.list_product')
        //                           -> with('list_product',$list_product);
        // return view('admin_layout')->with('admin.list_product',$manager_product);

        $product = new Product();
        $list_data = $product->list_product($current_page);
        $list_product = $list_data['list_product'];
        $current_page = $list_data['current_page'];
        $total_page = $list_data['total_page'];
        return view('admin.list_product', ['list_product' => $list_product, "total_page" => $total_page, "current_page" => $current_page]);
    }
    public function save_product(Request $request)
    {
        $data = $request->all();
        $get_image = $request->file('product_image');
        $product = new Product();
        $product->save_product($data, $get_image);

        return Redirect::to('add-product');
    }

    public function actived_product($product_id)
    {
        $product = new Product();
        $product->actived_product();
        return Redirect::to('/list-product');
    }

    public function not_actived_product($product_id)
    {
        $product = new Product();
        $product->not_actived_product();
        return Redirect::to('/list-product');
    }

    public function edit_product($product_id)
    {
        $product = new Product();
        $list_data = $product->edit_product($product_id);
        $cate_product = $list_data['cate_product'];
        $brand_product = $list_data['brand_product'];
        $edit_product = $list_data['edit_product'];

        return view('admin.edit_product')->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $data = $request->all();
        $get_image = $request->file('product_image');

        $product = new Product();
        $product->update_product($data, $product_id, $get_image);
        return Redirect::to('list-product/1');
    }

    public function delete_product($product_id)
    {

        $product = new Product();
        $product->delete_product($product_id);
        return Redirect::to("/list-product/1");
    }

    //Homapage function route
    public function product_detail(Request $request, $product_id)
    {
        $data = $request->all();
        $product = new Product();
        $list_data = $product->product_detail($data, $product_id);

        $cate_list =  $list_data['cate_product'];
        $brand_list = $list_data['brand_product'];
        $slider = $list_data['slider'];
        $product_detail = $list_data['product_detail'];
        $meta_desc = $list_data['meta_desc'];
        $relate_product = $list_data['relate_product'];
        $recomment_product = $list_data['recomment_product'];
        $meta_keywords = $list_data['meta_keywords'];
        $meta_title = $list_data['meta_title'];
       

        return view('pages.product.show_product_detail', [
            "category" => $cate_list, "brand" => $brand_list, "relate_product" => $relate_product, "recomment_product" => $recomment_product, "product_detail" => $product_detail,
            "meta_desc" => $meta_desc, "meta_keywords" => $meta_keywords, "meta_title" => $meta_title, "slider" => $slider
        ]);
    }
}
