@extends('admin_layout')
@section('admin_content')
{{-- @php
$message = Session::get('message');
if($message){
echo '<span class="text-alert">'.$message.'</span>';
Session::put('message',null);
}

@endphp --}}

<div class="content__main">
  <div class="table">
    <span class="table__title">Liệt kê sản phẩm</span>
    <table>
      <thead>
        <tr>
          <th>Tên sản phẩm</th>
          <th>Hình ảnh</th>
          <th>Giá</th>
          <th>Số lượng</th>
          <th>Danh mục</th>
          <th>Thương hiệu</th>
          <th>Hiển thị</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($list_product as $key=>$product)
        <tr>
          <td>{{$product->product_name}}</td>
          <td><img src="{{asset('public/uploads/product/'.$product->product_image)}}">
          </td>
          <td>{{$product->product_price}}</td>
          <td>{{$product->product_quantity}}</td>
          <td>{{$product->category_name}}</td>
          <td>{{$product->brand_name}}</td>
          <td>
            <?php
              if ($product->product_status == 1){
            ?>
            <a href="{{URL::to('/actived-product/'.$product->product_id)}}" style="color: green"> <i
                class="fa fa-thumbs-up"></i></a>
            <?php 
              } else {
            ?>
            <a href="{{URL::to('/not-actived-product/'.$product->product_id)}}" style="color: red"> <i
                class="fa fa-thumbs-down"></i></a>
            <?php 
              }
            ?>
            </span>
          </td>

          <td>
            <a href="{{URL::to('/edit-product/'.$product->product_id)}}" style="color: green">
              <i class="fa fa-pencil-alt"></i>
            </a>
            <a href="{{URL::to('/delete-product/'.$product->product_id)}}"
              onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không')" style="color: red; margin-top: 2rem">
              <i class="fa fa-times"></i>
            </a>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
    <div class="page">
      <ul class="page__list">
        <li class="page__item">
          <a href="{{URL::to('/list-product/'.$current_page-1)}}">
            <i class="fa fa-chevron-left"></i>
          </a>
        </li>
        @for ($i = 1; $i <= $total_page; $i++) <li class="page__item"><a
            href="{{URL::to('/list-product/'.$i)}}">{{$i}}</a></li>
          @endfor
          <li class="page__item">
            <a href="{{URL::to('/list-product/'.$current_page+1)}}">
              <i class="fa fa-chevron-right"></i>
            </a>
          </li>
      </ul>
    </div>
  </div>
</div>
@endsection