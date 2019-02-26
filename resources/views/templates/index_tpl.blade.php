@extends('index')
@section('content')
<?php 
    $setting = Cache::get('setting');
    $banner = DB::table('slider')->where('com','home')->get();
?>
@include('templates.layout.slider')
<div class="content-home">
    <div class="container">
        <div class="row">
            @foreach($slogans as $slogan)
            <div class="col-xs-6 col-md-3">
                <p><img src="{{asset('upload/hinhanh/'.$slogan->photo)}}" alt=""></p>
                <p class="name_slogan">{{$slogan->name}}</p>
                <p class="des_slogan">{{$slogan->content}}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="content-home">
    <div class="container">
        <h2 class="title_home">Thiết kế nội thất</h2>
        <div class="dongke"><span></span></div>
        <p class="pull-right read_more"><a href="{{url('thiet-ke')}}">Xem tất cả <i class="fa fa-chevron-right"></i></a></p>
        <div class="list-item">
            @foreach($design as $item)
            <div class="col-md-3 boxx">
                <div class="box-item-img">
                   <a href="{{url('thiet-ke/'.$item->alias.'.html')}}" title="{{$item->name}}">
                    <img src="{{asset('upload/news/'.$item->photo)}}" alt="{{$item->name}}" class="img-main">
                    <div class="wrap"></div>                       
                    <img src="{{asset('public/images/icon.png')}}" alt="{{$item->name}}" class="iconx">
                    </a>
                </div>
                <div class="item_name"><a href="{{url('thiet-ke/'.$item->alias.'.html')}}">{{$item->name}}</a></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="content-home">
    <div class="container">
        <h2 class="title_home">Khách hàng nói về chúng tôi</h2>
        <div class="dongke"><span></span></div>
        <div class="slider_customer row">                      
            <div id="carousel-id1" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                	@foreach($feedbacks as $k=>$fb)
                    <li data-target="#carousel-id1" data-slide-to="{{$k}}" class="@if($k==0) active @endif"></li>
                    @endforeach
                    
                </ol>
                <div class="carousel-inner">
                    @foreach($feedbacks as $k=>$fb)
                    <div class="item @if($k==0) active @endif">
                        <img src="{{asset('upload/hinhanh/'.$fb->photo)}}">
                        <div class="content_customer">{!! $fb->content !!}</div>
                    </div>
                    @endforeach
                </div>
                <!-- <a class="left carousel-control" href="#carousel-id1" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#carousel-id1" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> -->
            </div>
        </div>
    </div>
</div>
<div class="content-home">
    <div class="container">
        <h2 class="title_home">Video</h2>
        <div class="dongke"><span></span></div>
        <div class="box-video">
            {!! $video->link !!}
        </div>
    </div>
</div>
<div class="content-home">
    <div class="container">
        <h2 class="title_home">Tin tức</h2>
        <div class="dongke"><span></span></div>
        <p class="pull-right read_more"><a href="{{url('tin-tuc')}}">Xem tất cả <i class="fa fa-chevron-right"></i></a></p>
        <div class="list-item">
            @foreach($news as $n)
            <div class="col-md-3 boxx">
                <div class="box-item-img">
                   <a href="" title="">
                    <img src="{{asset('upload/news/'.$n->photo)}}" alt="" class="img-main">
                    <div class="wrap"></div>                       
                    <img src="{{asset('public/images/icon.png')}}" alt="" class="iconx">
                    </a>
                </div>
                <div class="item_name"><a href="">{{$n->name}}</a></div>
                <div class="des_news">
                    {!! $n->mota !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
