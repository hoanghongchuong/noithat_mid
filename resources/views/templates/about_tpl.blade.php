@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
?>
@include('templates.layout.slider')
<div class="content-home ">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-12 left">
                <div class="content-about">
                {!! $about->content !!}
                </div>
            </div>
            <div class="col-md-3 col-xs-12 right">
                <h2 class="title-about">Về chúng tôi</h2>
                <div class="list-about ">
                    @foreach($partners as $item)
                    <div class="media">
                        <a class="pull-left" href="{{url('thanh-vien/'.$item->url)}}">
                            <img class="media-object" src="{{asset('upload/banner/'.$item->photo)}}" alt="Image">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading name-about">{{$item->name}}</h4>
                            <p>{{$item->position}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

