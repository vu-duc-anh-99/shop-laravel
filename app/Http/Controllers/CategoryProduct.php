<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;

class CategoryProduct extends Controller
{
    //function admin page
    public function add_category_product()
    {
        return view('admin.add_category_product');
    }

    public function list_category_product()
    {
        $category = new Category();
        $list_data = $category->list_category_product();
        return view('admin.list_category_product', ['list_category_product' => $list_data['list_category_product'], 'total_page' => $list_data['total_page'], 'current_page' => $list_data['current_page']]);
    }
    public function page($current_page)
    {
        $category = new Category();
        $list_data = $category->page($current_page);
        return view('admin.list_category_product', ['list_category_product' => $list_data['list_category_product'], 'total_page' => $list_data['total_page'], 'current_page' => $list_data['current_page']]);
    }
    public function save_category_product(Request $request)
    {
        $data = $request->all();
        $category = new Category();
        $list_data = $category->save_category_product($data);
        return Redirect::to('add-category-product');
    }

    public function actived_category_product($category_product_id)
    {
        $category = new Category();
        $list_data = $category->actived_category_product($category_product_id);
        return Redirect::to('/list-category-product');
    }

    public function not_actived_category_product($category_product_id)
    {
        $category = new Category();
        $list_data = $category->not_actived_category_product($category_product_id);
        return Redirect::to('/list-category-product');
    }

    public function edit_category_product($category_product_id)
    {
        $category = new Category();
        $edit_category_product = $category->edit_category_product($category_product_id);
        return view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
    }

    public function update_category_product(Request $request, $category_product_id)
    {
        $data = $request->all();
        $category = new Category();
        $category->update_category_product($data,$category_product_id);
        return Redirect::to("/list-category-product");
    }

    public function delete_category_product($category_product_id)
    {
        $category = new Category();
        $category->delete_category_product($category_product_id);
        
        return Redirect::to("/list-category-product");
    }

    //End function admin page

    //function homepage
    public function show_category_home(Request $request, $category_id)
    {
       $data = $request->all();
       $category = new Category();
       $list_data = $category->show_category_home($category_id);
        return view('pages.category.show_category', [
            "category" => $list_data['list_category_product'], "brand" => $list_data['list_brand_product'],
            'list_product' => $list_data['product_by_catetory'], 'category_title' => $list_data['category_title']
        ]);
    }
}
