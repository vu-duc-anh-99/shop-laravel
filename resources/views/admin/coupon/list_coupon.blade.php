@extends('admin_layout')
@section('admin_content')
  <div class="content__main">
    <div class="table">
      <span class="table__title">Liệt kê mã giảm giá</span>
      <table>
        <thead>
          <tr>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Phân loại</th>
            <th>Mô tả</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_coupon as $key=>$coupon)
          <tr>
            <td>{{$coupon->coupon_code}}</td>
            <td>{{$coupon->coupon_times}}</td>
            <td>
              @php
                  if($coupon->coupon_type == 1){
                    echo "Giảm theo phần trăm";
                  }
                  else {
                    echo "Giảm theo tiền";
                  }
              @endphp
            </td>
            <td>
              @php
              if($coupon->coupon_type == 1){
                echo "Giảm $coupon->coupon_number%";
              }
              else {
                echo "Giảm $coupon->coupon_number VND";
              }
              @endphp
            </td>
            <td>
              <a href="{{URL::to('/find-coupon/'.$coupon->coupon_id)}}" style="color: green">
                <i class="fa fa-pencil-alt"></i>
              </a>
              <a href="{{URL::to('/delete-coupon/'.$coupon->coupon_id)}}"
                onclick="return confirm('Bạn có chắc muốn xóa mã này không')"
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
          <li class="page__item"><a href="{{URL::to('/manage-coupon/page/'.$current_page-1)}}"><i
                class="fa fa-chevron-left"></i></a>
          </li>
          @for ($i = 1; $i <= $total_page; $i++) @if ($i==1) <li class="page__item"><a
              href="{{URL::to('/manage-coupon')}}">{{$i}}</a>
            </li>
            @else
            <li class="page__item"><a href="{{URL::to('/manage-coupon/page/'.$i)}}">{{$i}}</a></li>
            @endif
            @endfor
            <li class="page__item">
              <a href="{{URL::to('/manage-coupon/page/'.$current_page+1)}}"><i
                  class="fa fa-chevron-right"></i></a>
            </li>
  
  
        </ul>
      </div>
    </div>
  </div>
@endsection