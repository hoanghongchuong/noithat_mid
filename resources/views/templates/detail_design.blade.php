@extends('index')
@section('content')
<div class="content-home-cate">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="crumb">
                    <a href="{{ url('') }}">Trang chủ | </a><a href="{{url('tin-tuc')}}">Tin tức | </a> <a href="javascipt:;" title="">{{$data->name}}</a>
                </div>
                <div class="name_detail">{{$data->name}}</div>
                <div class="description">{!! $data->mota !!}</div>
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="content_detail">
                    {!! $data->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection