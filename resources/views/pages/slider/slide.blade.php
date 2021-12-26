@section('slider')
<figure class="slider_figure">
    @foreach ($slider as $key=> $slide)
    @php
    if($key == 0){
    $first =$slide;
    }
    @endphp
    <div class="slider__item">
        <div class="slider__content">
            <h1>{{$slide->slider_name}}</h1>
            <p>{{$slide->slider_desc}}</p>
            <a href="{{asset('/search-slider/'.$slide->slider_id)}}">Xem ngay</a>
        </div>
        <img src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" alt="">
    </div>
    @endforeach
    <div class="slider__item">
        <div class="slider__content">
            <h1>{{$first['slider_name']}}</h1>
            <p>{{$first['slider_desc']}}</p>
            <a href="{{asset('/search-slider/'.$first['slider_id'])}}">Xem ngay</a>
        </div>
        <img src="{{asset('public/uploads/slider/'.$first['slider_image'])}}" alt="">
    </div>
</figure>
@endsection