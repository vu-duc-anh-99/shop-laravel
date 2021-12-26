@extends('admin_layout')
@section('admin_content')
  {{-- @php
  $message = Session::get('message');
    if($message){
    echo '<span class = "text-alert">'.$message.'</span>';
    Session::put('message',null);
    }
  @endphp --}}
  <div class="content__main">
    <div class="table">
      <span class="table__title">Liệt kê đơn hàng</span>
      <table>
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Tổng giá tiền</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Tình trạng</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_orders as $order)
          <tr>
            <td>{{$order->customer_name}}</td>
            <td>{{$order->order_total}}</td>
            <td>{{$order->customer_phone}}</td>
            <td>{{$order->shipping_address}}</td>
            <td>
              @php
                  if($order->order_status == 1){
                    $order->order_status = "Chờ xử lý";
                  }
                  elseif ($order->order_status == 2) {
                    $order->order_status = "Đã xác nhận";
                  }elseif ($order->order_status == 3) {
                    $order->order_status = "Đã hủy";
                  }
              @endphp
              {{$order->order_status}}
            </td>
  
            <td>
              <a href="{{URL::to('/edit-order/'.$order->order_id)}}" style="color: green">
                <i class="fa fa-pencil-alt"></i>
              </a>
              <a href="{{URL::to('/delete-order/'.$order->order_id)}}"
                onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không')"
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
          <li class="page__item"><a href="{{URL::to('/manage-order/page/'.$current_page-1)}}"><i
                class="fa fa-chevron-left"></i></a>
          </li>
          @for ($i = 1; $i <= $total_page; $i++) @if ($i==1) <li class="page__item"><a
              href="{{URL::to('/manage-order')}}">{{$i}}</a>
            </li>
            @else
            <li class="page__item"><a href="{{URL::to('/manage-order/page/'.$i)}}">{{$i}}</a></li>
            @endif
            @endfor
            <li class="page__item">
              <a href="{{URL::to('/manage-order/page/'.$current_page+1)}}"><i
                  class="fa fa-chevron-right"></i></a>
            </li>
  
  
        </ul>
      </div>
    </div>
  </div>
@endsection