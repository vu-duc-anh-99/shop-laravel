<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        //seo meta

        $meta_desc = "Bán Manga";
        $meta_keywords = "ban manga, mua manga, mua truyện, mua truyen";
        $meta_title = "Demaon";
        $meta_url = $request->url();
        //end seo meta
        
        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status',1)->take(4)->get();
        //end slider
        $total_records = DB::table('tbl_product')->get();
        $total_records_count = count($total_records);
        $limit = 9;
        $current_page = 1;
        $total_page = ceil($total_records_count / $limit);

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $list_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->skip(0)->take($limit)->get();
        return view('pages.home',["category"=>$cate_product,"brand"=>$brand_product,"list_product"=>$list_product,"meta_desc"=>$meta_desc,
                                    "meta_keywords"=>$meta_keywords, "meta_title"=>$meta_title, "meta_url"=>$meta_url,"slider"=>$slider,
                                    "total_page"=>$total_page, "current_page"=>$current_page
                                 ]);
    }
    public function page(Request $request,$current_page)
    {
        //seo meta

        $meta_desc = "Bán Manga";
        $meta_keywords = "ban manga, mua manga, mua truyện, mua truyen";
        $meta_title = "Demaon";
        $meta_url = $request->url();
        //end seo meta
        
        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status',1)->take(4)->get();
        //end slider

        $total_records = DB::table('tbl_product')->get();
        $total_records_count = count($total_records);
        $limit = 9;
        $start = ((int)$current_page - 1) * $limit;
        $total_page = ceil($total_records_count / $limit);

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $list_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->skip($start)->take($limit)->get();
        return view('pages.home',["category"=>$cate_product,"brand"=>$brand_product,"list_product"=>$list_product,"meta_desc"=>$meta_desc,
                                    "meta_keywords"=>$meta_keywords, "meta_title"=>$meta_title, "meta_url"=>$meta_url,"slider"=>$slider,
                                    "total_page"=>$total_page, "current_page"=>$current_page
                                 ]);
    }
    public function search_product(Request $request)
    {
        $keyword = $request->search_name_product;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $list_product = DB::table('tbl_product')->where('product_status','1')
                                                ->where('product_name','like','%'.$keyword.'%')
                                                ->orderby('product_id','desc')->limit(6)->get();
        return view('pages.product.search_product',["category"=>$cate_product,"brand"=>$brand_product,"list_product"=>$list_product]);
    }

}
