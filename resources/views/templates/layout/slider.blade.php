<?php
	$slider = DB::table('slider')->select()->where('status',1)->where('com','gioi-thieu')->orderBy('created_at','desc')->get();
?>
@if(isset($slider))
<div class="slider">
    <div class="container">
        <div class="row">
            <div id="carousel-id" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($slider as $key=>$item)
                    <li data-target="#carousel-id" data-slide-to="{{$key}}" class="@if($key == 0)active @endif"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach($slider as $key=>$item)
                    <div class="item @if($key == 0) active @endif">
                        <img src="{{asset('upload/hinhanh/'.$item->photo)}}">
                    </div>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
</div>
 @endif