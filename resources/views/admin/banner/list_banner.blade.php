@extends('admin_layout')
@section('admin_content')


<div class="content__main">
  <div class="table">
    <span class="table__title">Liệt kê banner</span>
    <table>
      <thead>
        <tr>
          <th>Tên banner</th>
          <th>Hình ảnh</th>
          <th>Mô tả</th>
          <th>Hiển thị</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($slider as $key=>$value)
        <tr>
          <td>{{$value->slider_name}}</td>
          <td><img src={{asset("public/uploads/slider/".$value->slider_image)}}></td>
          <td>{{$value->slider_desc}}</td>
          <td>
            <?php
                  if ($value->slider_status == 1){
                ?>
            <a href="{{URL::to('/inactive-slider/'.$value->slider_id)}}" style="color: green"> <i
                class="fa fa-thumbs-up"></i></a>
            <?php 
                  } else {
                ?>
            <a href="{{URL::to('/active-slider/'.$value->slider_id)}}" style="color: red"> <i
                class="fa fa-thumbs-down"></i></a>
            <?php 
                  }
                ?>

          </td>

          <td>
            <a href="{{URL::to('/edit-slider/'.$value->slider_id)}}" style="color: green">
              <i class="fa fa-pencil-alt"></i>
            </a>
            <a href="{{URL::to('/delete-slider/'.$value->slider_id)}}"
              onclick="return confirm('Bạn có chắc muốn xóa banner này không')"
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
        <li class="page__item"><a href="{{URL::to('/manage-slider/page/'.$current_page-1)}}"><i
              class="fa fa-chevron-left"></i></a>
        </li>
        @for ($i = 1; $i <= $total_page; $i++) @if ($i==1) <li class="page__item"><a
            href="{{URL::to('/manage-slider')}}">{{$i}}</a>
          </li>
          @else
          <li class="page__item"><a href="{{URL::to('/manage-slider/page/'.$i)}}">{{$i}}</a></li>
          @endif
          @endfor
          <li class="page__item">
            <a href="{{URL::to('/manage-slider/page/'.$current_page+1)}}"><i
                class="fa fa-chevron-right"></i></a>
          </li>


      </ul>
    </div>
  </div>
</div>
@endsection



