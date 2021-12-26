@extends('admin_layout')
@section('admin_content')

{{--  @php
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
          <th>Tên thương hiệu</th>
          <th>Hiển thị</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($list_brand_product as $key=>$bran_pro)
        <tr>
          <td>{{$bran_pro->brand_name}}</td>
          <td>
            <?php
                if ($bran_pro->brand_status == 1){
              ?>
            <a href="{{URL::to('/actived-brand-product/'.$bran_pro->brand_id)}}" style="color: green"> <i
                class="fa fa-thumbs-up"></i></a>
            <?php 
                } else {
              ?>
            <a href="{{URL::to('/not-actived-brand-product/'.$bran_pro->brand_id)}}" style="color: red"> <i
                class="fa fa-thumbs-down"></i></a>
            <?php 
                }
              ?>

          </td>

          <td>
            <a href="{{URL::to('/edit-brand-product/'.$bran_pro->brand_id)}}" style="color: green">
              <i class="fa fa-pencil-alt"></i>
            </a>
            <a href="{{URL::to('/delete-brand-product/'.$bran_pro->brand_id)}}"
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

        <li class="page__item"><a href="{{URL::to('/list-brand-product/page/'.$current_page-1)}}"><i
              class="fa fa-chevron-left"></i></a>
        </li>

        @for ($i = 1; $i <= $total_page; $i++) @if ($i==1) <li class="page__item"><a
            href="{{URL::to('/list-brand-product')}}">{{$i}}</a>
          </li>
          @else
          <li class="page__item"><a href="{{URL::to('/list-brand-product/page/'.$i)}}">{{$i}}</a></li>
          @endif
          @endfor


          <li class="page__item">
            <a href="{{URL::to('/list-brand-product/page/'.$current_page+1)}}"><i class="fa fa-chevron-right"></i></a>
          </li>


      </ul>
    </div>
  </div>
</div>
@endsection