@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
?>
<div class="content-home-cate">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="crumb">
                    <a href="{{ url('') }}">Trang chủ | </a><a href="{{url('tin-tuc')}}">Tin tức | </a> <a href="javascipt:;" title="">{{$news_detail->name}}</a>
                </div>
                <div class="name_detail">{{$news_detail->name}}</div>
                <div class="description">{!! $news_detail->mota !!}</div>
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="content_detail">
                    {!! $news_detail->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection