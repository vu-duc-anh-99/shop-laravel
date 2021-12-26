@extends('admin_layout')
@section('admin_content')
  <div class="content__main">
    <div class="table">
      <span class="table__title">Liệt kê danh mục sản phẩm</span>
      <table>
        <thead>
          <tr>
            <th>Tên danh mục</th>
            <th>Hiển thị</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_category_product as $key=>$cate_pro)
          <tr>
            <td>{{$cate_pro->category_name}}</td>
            <td>
              <?php
                  if ($cate_pro->category_status == 1){
                ?>
              <a href="{{URL::to('/actived-category-product/'.$cate_pro->category_id)}}" style="color: green"> <i
                  class="fa fa-thumbs-up"></i></a>
              <?php 
                  } else {
                ?>
              <a href="{{URL::to('/not-actived-category-product/'.$cate_pro->category_id)}}" style="color: red"> <i
                  class="fa fa-thumbs-down"></i></a>
              <?php 
                  }
                ?>
  
            </td>
  
            <td>
              <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" style="color: green">
                <i class="fa fa-pencil-alt"></i>
              </a>
              <a href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}"
                onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không')"
                style="color: red; margin-top: 2rem">
                <i class="fa fa-times"></i>
              </a>
            </td>
          </tr>
  
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <ul class="page__list">
  
          <li class="page__item"><a href="{{URL::to('/list-category-product/page/'.$current_page-1)}}"><i
                class="fa fa-chevron-left"></i></a>
          </li>
  
          @for ($i = 1; $i <= $total_page; $i++) @if ($i==1) <li class="page__item"><a
              href="{{URL::to('/list-category-product')}}">{{$i}}</a>
            </li>
            @else
            <li class="page__item"><a href="{{URL::to('/list-category-product/page/'.$i)}}">{{$i}}</a></li>
            @endif
            @endfor
  
  
            <li class="page__item">
              <a href="{{URL::to('/list-category-product/page/'.$current_page+1)}}"><i class="fa fa-chevron-right"></i></a>
            </li>
  
  
        </ul>
      </div>
    </div>
  </div>
@endsection