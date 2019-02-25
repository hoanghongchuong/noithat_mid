<?php
    $setting = Cache::get('setting');
    $sliders = DB::table('slider')->where('com','gioi-thieu')->get();
?>
<header id="header" class="">
    <div class="container">
        <div class="row">
            <div class="top_header">
                <div class="col-md-3 col-xs-12">
                    <a href="{{url('')}}" title=""><img src="{{asset('upload/hinhanh/'.$setting->photo)}}" class="logo-img" alt=""></a>
                </div>
                <div class="col-md-9 col-xs-12">
                    <p class="company_name">{{$setting->company}}</p>
                    <div class="box-item-header col-xs-12 col-md-4">
                        <div class="col-md-2 col-xs-2"><img src="{{asset('public/images/add.png')}}" alt=""></div>
                        <div class="col-md-10 col-xs-10">
                            {{$setting->address}}
                        </div>
                    </div>
                    <div class="box-item-header col-xs-12 col-md-4">
                        <div class="col-md-2 col-xs-2"><img src="{{asset('public/images/time.png')}}" alt=""></div>
                        <div class="col-md-10 col-xs-10">
                            8h - 17h30 <br>
                            Hỗ trợ 24/7
                        </div>
                    </div>
                    <div class="box-item-header col-xs-12 col-md-4">
                        <div class="col-md-2 col-xs-2"><img src="{{asset('public/images/phone.png')}}" alt=""></div>
                        <div class="col-md-10 col-xs-10">
                            {{$setting->phone}}<br>
                            {{$setting->hotline}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</header><!-- /header -->
<div class="menu visible-lg visible-md">         
    <div class="container">
        <ul class="navi">
            <li class="@if(@$com == 'index')active @endif"><a href="{{url('')}}">Trang chủ</a></li>
            <li class="@if(@$com == 'thiet-ke')active @endif">
                <a href="{{url('thiet-ke')}}">
                    Thiết kế
                    <i class="fa fa-chevron-down"></i>
                </a>
                <?php $cateDeSign = DB::table('news_categories')->where('com','thiet-ke')->where('status',1)->get(); ?>
                <ul class="vk-menu__child">                                
                    @foreach($cateDeSign as $cateD)
                    <li><a href="{{url('thiet-ke/'.$cateD->alias)}}">{{$cateD->name}}</a></li>
                    @endforeach                       
                </ul>
            </li>
            <li class="@if(@$com == 'cong-trinh')active @endif">
                <a href="{{url('anh-cong-trinh')}}">Ảnh công trình
                    <i class="fa fa-chevron-down"></i>
                </a>
                <?php $cateCongTrinh = DB::table('news_categories')->where('com','cong-trinh')->where('status',1)->get(); ?>
                <ul class="vk-menu__child">
                    @foreach($cateCongTrinh as $ct)
                    <li><a href="{{url('cong-trinh/'.$ct->alias)}}">{{$ct->name}}</a></li>
                    @endforeach                     
                </ul>
            </li>
            <li class="@if(@$com == 'decor')active @endif">
                <a href="{{url('san-pham')}}">Đồ decor</a>                    
            </li>
            
            <li class="@if(@$com == 'tin-tuc')active @endif"><a href="{{url('tin-tuc')}}" title="">Tin tức</a></li>
            <li class="@if(@$com == 'lien-he')active @endif"><a href="{{url('lien-he')}}" title="">Liên hệ</a></li>
        </ul> 
    </div>           
</div>
<div class="visible-xs visible-sm">
    <div class="vk-header__search">
        <div class="container">
            
            <a href="#menuMobile" class="menu_Mobile" data-toggle="collapse" class="_btn d-lg-none menu_title"><i class="fa fa-bars"></i> Menu</a>
        </div>
    </div>
    <nav class="vk-header__menu-mobile">
        <ul class="vk-menu__mobile collapse" id="menuMobile">
            <li><a href="#">Trang chủ</a></li>
            <li>
                <a href="#">Thiết kế</a>
                <a href="#menu2" data-toggle="collapse" class="_arrow-mobile"><i class="_icon fa fa-angle-down"></i></a>
                <ul class="collapse" id="menu2">
                    <li><a href="#">Công trình 1</a></li>
                    <li><a href="#">Công trình 1</a></li>
                    <li><a href="#">Công trình 1</a></li>
                    <li><a href="#">Công trình 1</a></li>
                    <li><a href="#">Công trình 1</a></li>
                    
                </ul>
            </li>
            <li>
                <a href="#">Ảnh công trình</a>
                <a href="#menu1" data-toggle="collapse" class="_arrow-mobile"><i class="_icon fa fa-angle-down"></i></a>
                <ul class="collapse" id="menu1">
                    <li><a href="#">Công trình 1</a></li>
                    <li><a href="#">Công trình 1</a></li>
                    <li><a href="#">Công trình 1</a></li>
                    <li><a href="#">Công trình 1</a></li>
                    <li><a href="#">Công trình 1</a></li>
                    
                </ul>
            </li>
            <li><a href="#">Dự án</a></li>
            <li><a href="#">Decor</a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
    </nav>
    
</div>