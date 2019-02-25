@extends('index')
@section('content')
<div class="content-home-cate">
    <div class="container">
        <div class="">
            <h1 class="cate_name">Ảnh công trình</h1>
            <div class="list-item">
                @foreach($data as $item)
                <div class="col-md-3 boxx">
                    <div class="box-item-img">
                       <a href="{{url('cong-trinh/'.$item->alias.'.html')}}" title="{{$item->name}}">
                        <img src="{{asset('upload/news/'.$item->photo)}}" alt="{{$item->name}}" class="img-main">
                        <div class="wrap"></div>                       
                        <img src="{{asset('public/images/icon.png')}}" alt="{{$item->name}}" class="iconx">
                        </a>
                    </div>
                    <div class="item_name"><a href="{{url('cong-trinh/'.$item->alias.'.html')}}">{{$item->name}}</a></div>
                </div>
               	@endforeach
            </div>
        </div>
    </div>
</div>
@endsection