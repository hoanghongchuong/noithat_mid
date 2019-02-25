@extends('index')
@section('content')
@include('templates.layout.slider')
<div class="content-box">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12 left hidden-xs">                   
                <ul class="menu-cate">
                    @foreach($cate_pro as $cate)
                    <li class="parent"><a href="{{url('kien-truc/'.$cate->alias)}}">{{$cate->name}}</a></li>
                    <?php $cateChildren = DB::table('news_categories')->where('status',1)->where('parent_id', $cate->id)->get(); ?>
                    @if(count($cateChildren) > 0)
                        @foreach($cateChildren as $child)
                        <li><a href="{{url('kien-truc/'.$child->alias)}}" class="@if($child->id == $tintuc_cate->id)active @endif">{{$child->name}}</a></li>
                        @endforeach
                    @endif
                    @endforeach
                </ul>                    
            </div>
            <div class="col-md-9 col-xs-12">
                <div class="slider-category">
                    <h1>{{$tintuc_cate->name}}</h1>
                    <div class="owl-carousel-category">
                        @foreach($tintuc->chunk(2) as $chunks)
                        <div class="item">
                            @foreach($chunks as $item)
                            <div class="_item">
                                <a href="{{url('kien-truc/'.$item->alias.'.html')}}" title="{{$item->name}}">
                                    <img src="{{asset('upload/news/'.$item->photo)}}" alt="{{$item->name}}" />
                                    <p class="name-project-home">{{$item->name}}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection