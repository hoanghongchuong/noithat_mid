@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $cateProducts = Cache::get('cateProducts');
?>

<div class="content-box content-box-page">
    <nav aria-label="breadcrumb" class="nav-breadcrumb">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item">Tìm kiếm</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$search}}</li>
                </ol>
            </div>
        </div>
    </nav>
    <div class="list-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="list-item">
                        @foreach($data as $item)
                        <div class="col-xs-6 col-md-3 col-large-3 content" >
                            <div class="images">
                                <a href="{{url('san-pham/'.$item->alias.'.html')}}"><img src="{{asset('upload/product/'.$item->photo)}}" alt="{{$item->name}}"></a>
                            </div>
                            <div class="title">
                                <h4><a href="{{url('san-pham/'.$item->alias.'.html')}}" title="">{{$item->name}}</a></h4>
                                <p>Giá: <strong>{{number_format($item->price)}}</strong> vnđ</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>


@endsection
