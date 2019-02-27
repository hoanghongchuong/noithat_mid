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
        <div class="row">
            <h3>Bài viết liên quan</h3>
            <div class="owl-carousel owl-carousel-slider owl-theme">
                @foreach($posts as $post)
                <div class="item">
                    <a href="{{url('thiet-ke/'.$post->alias.'.html')}}" title="{{$post->name}}">
                        <img src="{{asset('upload/news/'.$post->photo)}}" alt="">
                        <p class="name">{{$post->name}}</p>
                    </a>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection