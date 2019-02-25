@extends('index')
@section('content')
@include('templates.layout.slider')
<div class="content-box">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12 left hidden-xs">                   
                <ul class="menu-cate">
                    @foreach($cate_pro as $cate)
                    <li class="parent"><a href="{{url('san-pham/'.$cate->alias)}}">{{$cate->name}}</a></li>
                    <?php $cateChildren = DB::table('product_categories')->where('status',1)->where('parent_id', $cate->id)->get(); ?>
                    @if(count($cateChildren) > 0)
                        @foreach($cateChildren as $child)
                        <li><a href="{{url('san-pham/'.$child->alias)}}" class="@if($child->id == $product_cate->id)active @endif">{{$child->name}}</a></li>
                        @endforeach
                    @endif
                    @endforeach
                </ul>                    
            </div>
            <div class="col-md-9 col-xs-12">
                <div class="slider-category">
                    <h1>{{$product_cate->name}}</h1>
                    <div class="owl-carousel-category">
                        @foreach($products->chunk(2) as $chunks)
                        <div class="item">
                            @foreach($chunks as $item)
                            <div class="_item">
                                <a href="{{url('san-pham/'.$item->alias.'.html')}}" title="{{$item->name}}">
                                    <img src="{{asset('upload/product/'.$item->photo)}}" alt="{{$item->name}}" />
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