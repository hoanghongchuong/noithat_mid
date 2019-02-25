@extends('index')
@section('content')
<div class="content-home decor">
    <div class="container">
        <h2 class="title_home">Decor</h2>
        <div class="dongke"><span></span></div>
        
        <div class="list-item-product">
            @foreach($products as $item)
            <div class="col-xs-12 col-md-3 col-large-3" >
                <div class="content">
                    <div class="images">
                        <a href="{{ url('san-pham/'.$item->alias.'.html') }}"><img src="{{asset('upload/product/'.$item->photo)}}" alt="{{$item->name}}"></a>
                    </div>
                    <div class="info-product">
                        <h4><a href="{{ url('san-pham/'.$item->alias.'.html') }}" title="{{$item->name}}">{{$item->name}}</a></h4>
                        <p class="price">Giá: <strong>{{number_format($item->price)}}</strong> vnđ</p>
                    </div>
                </div>                    
            </div>
            @endforeach
            <div class="pagination" style="width: 100%; float: left;">{!! $products->links() !!}</div>
        </div>
    </div>
</div>
@endsection