<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use Session;
use Illuminate\Support\Facades\Redirect;

$brand = new Brand();
class BrandProduct extends Controller
{
    public function add_brand_product()
    {
        return view('admin.add_brand_product');
    }

    public function list_brand_product()
    {
        $brand = new Brand();
        $list_data = $brand->list_brand_product();
        return view('admin.list_brand_product',['list_brand_product'=>$list_data["list_brand_product"],'total_page'=>$list_data['total_page'],'current_page'=>$list_data['current_page']]);

    }
    public function page($current_page)
    {
        $brand = new Brand();
        $list_data = $brand->page($current_page);
        return view('admin.list_brand_product',['list_brand_product'=>$list_data["list_brand_product"],'total_page'=>$list_data['total_page'],'current_page'=>$list_data['current_page']]);

    }
    public function save_brand_product(Request $request)
    {
        $data = $request->all();
        $brand = new Brand();
        $brand->save_brand_product($data);
        return Redirect::to('add-brand-product');
    }

    public function actived_brand_product($brand_product_id)
    {
        $brand = new Brand();
        $brand->actived_brand_product($brand_product_id);
        return Redirect::to('/list-brand-product');
    }

    public function not_actived_brand_product($brand_product_id)
    {
        $brand = new Brand();
        $brand->not_actived_brand_product($brand_product_id);
        return Redirect::to('/list-brand-product');
    }

    public function edit_brand_product($brand_product_id)
    {
        // $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        $brand = new Brand();
        $edit_brand_product = $brand->edit_brand_product($brand_product_id);
        return view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

    }

    public function update_brand_product(Request $request, $brand_product_id)
    {
       
        $data = $request->all();
        $brand = new Brand();
        $brand->update_brand_product($data,$brand_product_id);
        return Redirect::to("/list-brand-product");

    }

    public function delete_brand_product($brand_product_id)
    {
        
        $brand = new Brand();
        $brand->delete_brand_product($brand_product_id);
        return Redirect::to("/list-brand-product");

    }

    public function show_brand_home($brand_id)
    {
        $brand = new Brand();
        $list_data = $brand->show_brand_home($brand_id);
        return view('pages.brand.show_brand') ->with('list_product',$list_data['product_by_brand_id'])
                                                    ->with('category', $list_data['category'])
                                                    ->with('brand',$list_data['brand'])
                                                    ->with('brand_title',$list_data['brand_title']);
        
    }
}
