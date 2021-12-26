@section('search')
<div class="shop__search-form">
    <form action="{{URL::to('/tim-kiem')}}" method="POST">
        {{ csrf_field() }}
        <input type="text" name="search_name_product" class="shop__search-input" placeholder="Nhập tên sản phẩm" />
        <button type="submit">
            <i class="fa fa-search shop__search-icon"></i>
        </button>
    </form>
</div>
@endsection