@section('left_side')

<div class="shop-list__nav">
    <div class="shop-list__category">
        <h2 class="title category-title">Danh mục</h2>
        <ul class="category-list">
            @foreach ($category as $cat_value)
            <li class="category-item">
                <a href="{{URL::to('/danh-muc/'.$cat_value->category_id)}}">{{$cat_value->category_name}}
            </li>
            @endforeach
        </ul>
    </div>
    <div class="shop-list__brand">
        <h2 class="title brand-title">
            Thương hiệu
        </h2>
        <ul class="brand-list">
            @foreach ($brand as $brand_value)
            <li class="brand-item"><a
                    href="{{URL::to('/thuong-hieu/'.$brand_value->brand_id)}}">{{$brand_value->brand_name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection