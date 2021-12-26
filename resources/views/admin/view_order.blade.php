@extends('admin_layout')
@section('admin_content')

<div class="content__main">
  <div class="table">
    <span class="table__title">Thông tin khách hàng</span>
    <table>
      <thead>
        <tr>
          <th>Tên khách hàng</th>
          <th>Số điện thoại</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$order->customer_name}}</td>
          <td>{{$order->customer_phone}}</td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="table">
    <span class="table__title">Thông tin vận chuyển</span>
    <table>
      <thead>
        <tr>
          <th>Tên người nhận hàng</th>
          <th>Địa chỉ</th>
          <th>Số điện thoại</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$order->shipping_name}}</td>
          <td>{{$order->shipping_address}}</td>
          <td>{{$order->shipping_phone}}</td>
        </tr>
      </tbody>
    </table>
  </div>


  <div class="table">
    <span class="table__title">Chi tiết sản phẩm</span>
    <table>
      <thead>
        <tr>
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
          <th>Số lượng trong kho</th>
          <th>Giá</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($list_product as $item)
        <tr class="color_check_qty_{{$item->product_id}}">
          <td>{{$item->product_name}}</td>
          <td>{{$item->product_quantity}}</td>
          <td>{{$item->product_qty}}</td>
          <input type="hidden" name="product_sales_quantity" class="product_sales_quantity"
            value="{{$item->product_quantity}}">
          <input type="hidden" name="order_product_id" class="order_product_id" value="{{$item->product_id}}">
          <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$item->product_id}}"
            value="{{$item->product_qty}}">
          <td>{{$item->product_price}}</td>
        </tr>
        @endforeach

      </tbody>
    </table>
    <p style="display: block; margin: 2rem; text-align: right"><b>Thành tiền: {{$order->order_total}} VNĐ</b></p>
    <form action="">
      {{ csrf_field() }}
      <select class="form-control order_details">
        <option order-id="{{$item->order_id}}" @if ($item->order_status == 1)
          selected value = "1";
          @else
          value = "1";
          @endif
          >
          Chờ xử lý
        </option>
        <option order-id="{{$item->order_id}}" @if ($item->order_status == 2)
          selected value = "2";
          @else
          value = "2";
          @endif
          >
          Xác nhận giao hàng
        </option>
        <option order-id="{{$item->order_id}}" @if ($item->order_status == 3)
          selected value = "3";
          @else
          value = "3";
          @endif
          >
          Hủy đơn hàng
        </option>
      </select>
      {{-- <button type="submit" name="edit_order" class="btn btn-info">Cập nhật đơn hàng</button> --}}
    </form>
  </div>
</div>

@endsection