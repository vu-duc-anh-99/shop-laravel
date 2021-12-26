<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function list_banner()
    {
        $total_records_count = Slider::count();
        $limit = 5;
        $current_page = 1;
        $total_page = ceil($total_records_count / $limit);
        $slider = Slider::orderBy('slider_id')->skip(0)->take($limit)->get();
        return view('admin.banner.list_banner')->with(compact('slider','current_page','total_page'));
    }
    public function page($current_page)
    {
        $total_records_count = Slider::count();
        $limit = 5;
        $start = ((int)$current_page - 1) * $limit;
        $total_page = ceil($total_records_count / $limit);
        $slider = Slider::orderBy('slider_id')->skip($start)->take($limit)->get();
        return view('admin.banner.list_banner')->with(compact('slider','current_page','total_page'));
    }
    public function add_slider()
    {
        return view('admin.banner.add_banner');
    }
    public function save_banner(Request $request)
    {
        $data = $request->all();
        $slider = new Slider();
        $slider->slider_name = $data['slider_name'];
        $slider->slider_desc = $data['slider_desc'];
        $slider->slider_status = $data['slider_status'];

        $get_image = $request->file('slider_image');
        $get_name_image = $get_image->getClientOriginalName();
        $get_image->move("public/uploads/slider",$get_name_image);
        $slider->slider_image = $get_name_image;

        $slider->save();
        Session::put('message',"Thêm banner thành công");
        return Redirect::to('add-slider');
        
    }
    public function active_banner($slider_id)
    {
        $slider = Slider::find($slider_id);
        $slider->slider_status = 1;
        $slider->save();
        return Redirect::to('/manage-slider'); 
    }

    public function inactive_banner($slider_id)
    {
        $slider = Slider::find($slider_id);
        $slider->slider_status = 0;
        $slider->save();
        return Redirect::to('/manage-slider');
    }

    public function edit_banner($slider_id)
    {
        $slider= Slider::find($slider_id);
        return view('admin.banner.edit_banner')->with(compact('slider'));
    }

    public function update_banner(Request $request,$slider_id)
    {
        $data = $request->all();
        $slider = Slider::find($slider_id);
        $slider->slider_name = $data['slider_name'];
        $slider->slider_desc = $data['slider_desc'];

        if ($request->file('slider_image')) {
            $get_image = $request->file('slider_image'); 
            $get_name_image = $get_image->getClientOriginalName();
        }
        else{
            $get_name_image = $slider->slider_image;
        }
        if($slider->slider_image != $get_name_image){
            File::delete("public/uploads/slider/".$slider->slider_image);
            $get_image->move("public/uploads/slider",$get_name_image);
            $slider->slider_image = $get_name_image;
        }
        $slider->save();
        Session::put('message',"Cập nhật thành công");
        return Redirect::to("/manage-slider");

    }

    public function delete_banner($slider_id)
    {
        
    }
    public function search_slider($slider_id)
    {
        $slider = Slider::find($slider_id);
        $product = Product::where('product_name',$slider->slider_name)->first();
        $url = str_replace(' ',"-",$product->product_name);
        return Redirect::to("/chi-tiet-san-pham/".$product->product_id."/".$url);
    }
}
